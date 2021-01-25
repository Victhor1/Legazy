<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Serie;
use App\Genre;
use Redirect;
use App\Capitulo;
use App\Video;

class AddSerieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('serie.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genre = Genre::orderBy('name', 'asc')->pluck('name','id');
        return view('serie.create',compact('genre'));
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
        $urlMobile = str_replace('https://', 'https://m.' , $url);
        $head = array(
            'Accept-Language: es-us,en;q=0.5',
            'Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7',
            'Keep-Alive: 300',
            'Connection: keep-alive'
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $head);
        curl_setopt($curl, CURLOPT_URL, $urlMobile);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl);
        curl_close($curl);

        preg_match_all('|<h1 class="Title">(.*)</h1>|siU', $result, $nombre);
        $nameSlug = str_slug($nombre[1][0]);

        preg_match_all('|<p><strong>Sinopsis:</strong>(.*)</p>|siU', $result, $descripcion);

        preg_match_all('|<strong class="Anm-On">(.*)</strong>|', $result, $emision);
        preg_match_all('|<strong class="Anm-Off">(.*)</strong>|', $result, $finalizado);
        
        preg_match_all('|<span class="Type A">(.*)</span>|', $result, $tipo);

        preg_match_all('|<li class="Episode"><a href="(.*)">(.*)</a></li>|siU', $result, $capitulo);
        $numeroCap = count($capitulo[0], COUNT_RECURSIVE);
        $identificador = explode('-', $capitulo[1][0]);
        $identifiacdorCap = end($identificador);

        $dirCover = public_path().'/images/covers';
        $dirBanner = public_path().'/images/banners';
        $urlPicture = "https://animeflv.net/uploads/animes/";
        preg_match_all('|<img src="/uploads/animes/covers/(.*)" alt="">|', $result, $portada);
        $extension = explode('.', $portada[1][0]);
        $sourceCover = file_get_contents($urlPicture.'covers/'.$portada[1][0]);
        $sourceBanner = file_get_contents($urlPicture.'banners/'.$portada[1][0]);
        file_put_contents($dirCover.'/'.$nameSlug.'.'.$extension[count($extension)-1], $sourceCover);
        file_put_contents($dirBanner.'/'.$nameSlug.'.'.$extension[count($extension)-1], $sourceBanner);

        $serie = new Serie();
        $serie->url = $request->input('url');
        $serie->published = $request->input('date');
        $serie->name = $nombre[1][0];
        $serie->slug = $nameSlug;
        $serie->method = 0;
        $serie->counterView = 0;
        $serie->keywords = 'void';
        $serie->videdo = 'void';
        $serie->description = $descripcion[1][0];
        $serie->cover = $nameSlug.'.'.$extension[count($extension)-1];
        $serie->banner = $nameSlug.'.'.$extension[count($extension)-1];
        $serie->hidden = 0;
        $serie->languaje = 0;

        if(!empty($emision[1][0])) {
            $serie->status = 1;
        }elseif (!empty($finalizado[1][0])) {
            $serie->status = 0;
        }

        if($tipo[1][0] == 'Anime'){
            $serie->type = 0;
        }elseif($tipo[1][0] == 'Película'){
            $serie->type = 1;
        }elseif($tipo[1][0] == 'Especial'){
            $serie->type = 2;
        }elseif($tipo[1][0] == 'OVA'){
            $serie->type = 3;
        }

        $serie->save();
        $serie->genres()->sync($request->genres);

        if($identifiacdorCap == 1){
            for($i=1; $i <=$numeroCap ; $i++){
                $capitulo = new Capitulo();
                $capitulo->name = $nombre[1][0];
                $capitulo->number = $i;
                $capitulo->counterView = 0;
                $capitulo->method = 0;

                $curl = curl_init();
                $urlSlugCap = explode('/', $url);
                $urlCap = 'https://m.animeflv.net/ver/'.end($urlSlugCap).'-'.$i;

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
                $result = curl_exec($curl);
                curl_close($curl);

                preg_match_all('|<meta property="og:image" content="(.*)" />|siU', $result, $capImg);
                $dirCap = public_path().'/images/caps';
                $extensionCap = explode('.', $capImg[1][0]);
                $sourceCap = @file_get_contents($capImg[1][0]);
                $npci = explode('/', $capImg[1][0]);
	            $nameCapImg1 = end($npci);
	            $nameCapImg2 = time().$nameCapImg1;
                file_put_contents($dirCap.'/'.$nameCapImg2, $sourceCap);

                if($sourceCap === false){
                    $capitulo->picture = 'default.png';
                }else{
                    $capitulo->picture = $nameCapImg2;
                }

                $capitulo->slug = $nameSlug.'-'.$i;
                $capitulo->url = 'https://animeflv.net/ver/'.end($urlSlugCap).'-'.$i;
                $capitulo->status = 0;
                $capitulo->AnimeStatus = $serie->status;
                $capitulo->serie_id = $serie->id;

                $capitulo->save();

                /*$curlvid = curl_init();
                $urlvid = 'https://animeflv.net/ver/'.end($urlSlugCap).'-'.$i;
                $urlMobilevid = str_replace('https://', 'https://m.' , $urlvid);
                $headvid = array(
                    'Accept-Language: es-us,en;q=0.5',
                    'Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7',
                    'Keep-Alive: 300',
                    'Connection: keep-alive'
                );
                curl_setopt($curlvid, CURLOPT_HTTPHEADER, $headvid);
                curl_setopt($curlvid, CURLOPT_URL, $urlMobilevid);
                curl_setopt($curlvid, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($curlvid, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($curlvid, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curlvid, CURLOPT_RETURNTRANSFER, true);
                $resultvid = curl_exec($curlvid);
                curl_close($curlvid);

                preg_match_all('|{"server":"(.*)","title":"(.*)","allow_mobile":true,"code":"(.*)"}|siU', $resultvid, $videoss);
                $videoCode = $videoss[3];
                $videoName = $videoss[1];

                for ($i3=0; $i3 < count($videoName) ; $i3++) { 
                    for ($i4=0; $i4 < count($videoName) ; $i4++) {
                        $video = new Video();
                        $video->name = $videoName[$i3];
                        $video->code = str_replace('\\', '', $videoCode[$i4]);
                        $video->capitulo_id = $capitulo->id;
                        $video->slug = $capitulo->slug.'-'.$videoName[$i3];
                        $video->status = 1;

                        $video->save();
                    }
                }*/

            }
        }elseif($identifiacdorCap == 0){
            for($i=0; $i < $numeroCap ; $i++){
                $capitulo = new Capitulo();
                $capitulo->name = $nombre[1][0];
                $capitulo->number = $i;
                $capitulo->counterView = 0;
                $capitulo->method = 0;

                $curl = curl_init();
                $urlSlugCap = explode('/', $url);
                $urlCap = 'https://m.animeflv.net/ver/'.end($urlSlugCap).'-'.$i;

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
                $result = curl_exec($curl);
                curl_close($curl);

                preg_match_all('|<meta property="og:image" content="(.*)" />|siU', $result, $capImg);
                $dirCap = public_path().'/images/caps';
                $extensionCap = explode('.', $capImg[1][0]);
                $sourceCap = file_get_contents($capImg[1][0]);
                $npci = explode('/', $capImg[1][0]);
	            $nameCapImg1 = end($npci);
	            $nameCapImg2 = time().$nameCapImg1;
                file_put_contents($dirCap.'/'.$nameCapImg2, $sourceCap);

                $capitulo->picture = $nameCapImg2;
                $capitulo->slug = $nameSlug.'-'.$i;
                $capitulo->url = 'https://animeflv.net/ver/'.end($urlSlugCap).'-'.$i;
                $capitulo->status = 0;
                $capitulo->AnimeStatus = $serie->status;
                $capitulo->serie_id = $serie->id;

                $capitulo->save();
            }
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
    public function edit(Serie $serie)
    {
        $genre = Genre::orderBy('name', 'asc')->pluck('name','id');
        return view('serie.edit', compact('serie','genre'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Serie $serie)
    {
        $serie->fill($request->except('cover','banner'));

        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/covers/', $name);
            $serie->cover = $name;
        }

        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/banners/', $name);
            $serie->banner = $name;
        }

        $serie->name = $request->input('name');
        $serie->description = $request->input('description');
        $serie->published = $request->input('published');
        $serie->type = $request->input('type');
        $serie->status = $request->input('status');
        $serie->video = $request->input('video');
        $serie->hidden = $request->input('hidden');
        $serie->languaje = $request->input('languaje');

        $serie->save();
        $serie->genres()->sync($request->genres);

        return redirect('anime/'.$serie->slug)->with('success','Anime editado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Serie $serie)
    {
        $cover = public_path().'/images/covers/'.$serie->cover;

        \File::delete($cover);

        $serie->delete();
        return redirect('/home')->with('success','Anime eliminado correctamente');
    }
}
