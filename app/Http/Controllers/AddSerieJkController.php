<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Serie;
use App\Genre;
use Redirect;
use App\Capitulo;
use App\Video;

class AddSerieJkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genre = Genre::orderBy('name', 'asc')->pluck('name','id');
        return view('serie.jk.create',compact('genre'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        set_time_limit(3600);
        
        $curl = curl_init();
        $url = $request->input('url');

        $head = array(

            'Accept-Language: es-us,en;q=0.5',
            'Accept-Charset: ISO-8859-1, utf-8;q=0.7,*;q=0.7',
            'Accept: txt/xml,aplication/xml,aplication/html+xml,text/html;q=0.9,image/png'

        );

        curl_setopt($curl, CURLOPT_HTTPHEADER, $head);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Linux; U; Android 4.0; en-us; GT-I9300 Build/IMM76D)");

        $result = curl_exec($curl);
        curl_close($curl);

        //print_r($result);

        preg_match_all('|<h2>(.*)</h2>|siU', $result, $nombre);
        $nameSlug = str_slug($nombre[1][0]);
        preg_match_all('|<meta property="og:url"  content="(.*)"/>|siU', $result, $jkUrl);

        preg_match_all('|<img src="https://cdn.jkanime.net/assets/images/animes/image/(.*)" alt="(.*)" />|siU', $result, $cover);

        $dirCover = public_path().'/images/covers';
        $dirBanner = public_path().'/images/banners';
        $urlPicture = "https://cdn.jkanime.net/assets/images/animes/image/";
        $extension = explode('.', $cover[1][0]);
        $sourceCover = file_get_contents($urlPicture.$cover[1][0]);
        file_put_contents($dirCover.'/'.$nameSlug.'.'.$extension[count($extension)-1], $sourceCover);
        preg_match_all('|<span class="info-value finished"><b>(.*)</b></span>|siU', $result, $statusFinished);
        preg_match_all('|<span class="info-value currently"><b>(.*)</b></span>|siU', $result, $status);
        preg_match_all('|<span class="info-value">(.*)</span>|siU', $result, $type);
        preg_match_all('|<p><strong>Sinopsis: </strong>(.*)</p>|siU', $result, $decription);
        $contador = $type[1][3];
        $contador2 = $request->input('caps');

        $serie = new Serie();
        $serie->url = $request->input('url');
        $serie->name = $nombre[1][0];
        $serie->published = $request->input('date');
        $serie->slug = $nameSlug;
        $serie->method = 1;
        $serie->counterView = 0;
        $serie->description = $decription[1][0];
        $serie->cover = $nameSlug.'.'.$extension[count($extension)-1];
        $serie->banner = $nameSlug.'.'.$extension[count($extension)-1];
        $serie->hidden = 0;
        $serie->languaje = 0;

        if($type[1][0] == 'Serie'){
            $serie->type = 0;
        }elseif($type[1][0] == 'Pelicula'){
            $serie->type = 1;
        }elseif($type[1][0] == 'Especial'){
            $serie->type = 2;
        }elseif($type[1][0] == 'OVA'){
            $serie->type = 3;
        }elseif($type[1][0] == 'ONA'){
            $serie->type = 4;
        }

        if (!empty($statusFinished[1][0])) {
            $serie->status = 0;
        }elseif (!empty($status[1][0])) {
            $serie->status = 1;
        }

        $serie->save();
        $serie->genres()->sync($request->genres);

        for($i=1; $i <=$contador2 ; $i++){
            $capitulo = new Capitulo();
            $capitulo->name = $nombre[1][0];
            $capitulo->number = $i;
            $capitulo->counterView = 0;
            $capitulo->method = 1;

            $curl = curl_init();
            $urlSlugCap = explode('/', $url);
            $urlCap = $url.$i.'/';

            $head = array(
                'Accept-Language: es-us,en;q=0.5',
                'Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7',
                'Keep-Alive: 300',
                'Connection: keep-alive'
            );
            curl_setopt($curl, CURLOPT_HTTPHEADER, $head);
            curl_setopt($curl, CURLOPT_URL, $urlCap);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Linux; U; Android 4.0; en-us; GT-I9300 Build/IMM76D)");
            $result = curl_exec($curl);
            curl_close($curl);
            preg_match_all('|<meta property="og:image" content="(.*)"/>|siU', $result, $capImg);
            $dirCap = public_path().'/images/caps';
            $extensionCap = explode('.', $capImg[1][0]);
            $sourceCap = file_get_contents($capImg[1][0]);
            $npci = explode('/', $capImg[1][0]);
            $nameCapImg1 = end($npci);
	        $nameCapImg2 = $i.'-'.time().$nameCapImg1;
            file_put_contents($dirCap.'/'.$nameCapImg2, $sourceCap);

            $capitulo->picture = $nameCapImg2;
            $capitulo->slug = $nameSlug.'-'.$i;
            $capitulo->url = $request->input('url').$i.'/';
            $capitulo->status = 0;
            $capitulo->AnimeStatus = $serie->status;
            $capitulo->serie_id = $serie->id;

            $capitulo->save();
        }

        return Redirect::to('/anime'.'/'.$serie->slug);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
