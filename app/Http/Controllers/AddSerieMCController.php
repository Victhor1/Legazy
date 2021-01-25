<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Serie;
use App\Genre;
use Redirect;
use App\Capitulo;
use App\Video;
use App\Http\Requests\SerieCreateRequest;

class AddSerieMCController extends Controller
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
        return view('serie.monoschinos.create',compact('genre'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SerieCreateRequest $request)
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

        preg_match_all('|<h1 class="Title">(.*)</h1>|siU', $result, $nombre);
        $nombreClean = trim(str_replace('Sub Español', '', $nombre[1][0]));
        $nameSlug = str_slug($nombreClean);
        preg_match_all('|<p>(.*)</p>|siU', $result, $description);

        preg_match_all('|<figure><img src="(.*)" class="img-fluid" alt="(.*)" itemprop="image"></figure>|siU', $result, $img);
        preg_match_all('|<div class="Banner"><img src="(.*)" alt="Background"><div class="filtr"></div></div>|siU', $result, $banner);

        $extensionCover = explode('.', $img[1][0]);
        $extensionBanner = explode('.', $banner[1][0]);
        $dirCover = public_path().'/images/covers';
        $dirBanner = public_path().'/images/banners';
        $sourceCover = @file_get_contents($img[1][0]);
        $sourceBanner = @file_get_contents($banner[1][0]);
        

        preg_match_all('|<i class="fa fa-podcast"></i> (.*)|', $result, $status);
        preg_match_all('|<div class="after-title mb-2">(.*)</div>(.*)</div>|siU', $result, $fecha);
        $fecha2 = explode('|', $fecha[2][0]);

        preg_match_all('|<a class="item" href="(.*)"><i class="fa fa-play-circle"></i> (.*) <div class="AAIco-play_circle_outline ClA"></div></a>|siU', $result, $caps);
        $numeroCap = array_reverse($caps[1]);

        $serie = new Serie();
        $serie->url = $request->input('url');
        $serie->name = $nombreClean;
        $serie->published = trim($fecha2[0]);
        $serie->slug = $nameSlug;
        $serie->method = 2;
        $serie->counterView = 0;
        $serie->keyswords = 'void';
        $serie->video = 'void';
        $serie->description = $description[1][0];
        $serie->hidden = 0;
        $serie->languaje = 0;

        if($sourceCover === false){
            $serie->cover = 'default.png';
        }else{
            file_put_contents($dirCover.'/'.$nameSlug.'.'.$extensionCover[count($extensionCover)-1], $sourceCover);
            $serie->cover = $nameSlug.'.'.$extensionCover[count($extensionCover)-1];
        }

        if ($sourceBanner === false){
            $serie->banner = 'default.png';
        }else{
            file_put_contents($dirBanner.'/'.$nameSlug.'.'.$extensionBanner[count($extensionBanner)-1], $sourceBanner);
            $serie->banner = $nameSlug.'.'.$extensionBanner[count($extensionBanner)-1];
        }
        

        if(trim($fecha2[1]) == 'Anime'){
            $serie->type = 0;
        }elseif(trim($fecha2[1]) == 'Pelicula'){
            $serie->type = 1;
        }elseif(trim($fecha2[1]) == 'Especial'){
            $serie->type = 2;
        }elseif(trim($fecha2[1]) == 'Ova'){
            $serie->type = 3;
        }elseif(trim($fecha2[1]) == 'Ona'){
            $serie->type = 4;
        }elseif(trim($fecha2[1]) == 'Corto'){
            $serie->type = 5;
        }elseif(trim($fecha2[1]) == 'Donghua'){
            $serie->type = 6;
        }

        if(trim($status[1][0]) == 'Finalizado'){
            $serie->status = 0;
        }elseif(trim($status[1][0]) == 'Estreno'){
            $serie->status = 1;
        }

        $serie->save();
        $serie->genres()->sync($request->genres);

        for ($i=1; $i <= count($numeroCap) ; $i++){
            $capitulo = new Capitulo();
            $capitulo->name = $nombreClean;
            $capitulo->number = $i;
            $capitulo->counterView = 0;
            $capitulo->method = 2;
            $capitulo->picture = $serie->banner;
            $capitulo->slug = $nameSlug.'-'.$i;
            $capitulo->url = $numeroCap[$i-1];
            $capitulo->status = 0;
            $capitulo->AnimeStatus = $serie->status;
            $capitulo->serie_id = $serie->id;

            $capitulo->save();
        }

        return redirect('/anime'.'/'.$serie->slug)->with('success','Anime Registrado correctamente');
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
