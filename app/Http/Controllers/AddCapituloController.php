<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Serie;
use App\Video;
use App\Download;
use App\Capitulo;
use Redirect;

class AddCapituloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total = Capitulo::contadorbd();
        $totalView = Capitulo::contadorbdView();
        $totalNoView = Capitulo::contadorbdNoView();
        $totalNoStatus = Capitulo::contadorbdNoStatus();

        $noViews = Capitulo::where('status','=',0)->limit(30)->get();

        return view('capitulo.index',compact('total','totalView','totalNoView','noViews','totalNoStatus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $curl = curl_init();
        $url = $request->input('urlcap');
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

        preg_match_all('|<li class="(.*)" data-tplayernv="(.*)" data-toggle="tooltip" title="(.*)"><span>(.*)</span></li>|siU', $result, $nombre);
        $videoName = $nombre[3];

        preg_match_all('|url=(.*)&id=(.*)&quot|siU', $result, $code);
        $videoCode = $code[1];

        preg_match_all('|<td><a class="btnWeb" href="(.*)" target="_blank"><i class="fa fa-download"></i> </a></td>|siU', $result, $download);
        $downloadUrl = $download[1];

        $capitulo = new Capitulo();
        $capitulo->url = $request->input('urlcap');
        $capitulo->name = $request->input('name');
        $capitulo->slug = $request->input('slug').'-'.$request->input('number');
        $capitulo->number = $request->input('number');
        $capitulo->status = 1;
        $capitulo->AnimeStatus = $request->input('status');
        $capitulo->picture = $request->input('banner');
        $capitulo->counterView = 0;
        $capitulo->method = 2;
        $capitulo->serie_id = $request->input('id');

        $capitulo->save();

        for ($i=0; $i < count($videoName) ; $i++) { 
            for ($i=0; $i < count($videoCode) ; $i++) {
                $video = new Video();
                $video->name = $videoName[$i];
                if(urldecode($videoCode[$i]) == null){
                    $video->code = 'https://reproductor.monoschinos.com/';
                }else{
                    $video->code = urldecode($videoCode[$i]);
                }
                $video->capitulo_id = $capitulo->id;
                $video->slug = $capitulo->slug.'-'.$videoName[$i];
                $video->status = 1;

                $video->save();
            }
        }

        for ($i2=0; $i2 < count($downloadUrl) ; $i2++){
            $download = new Download();
            $download->name = explode('/',$downloadUrl[$i2])[2];
            $download->code = $downloadUrl[$i2];
            $download->capitulo_id = $capitulo->id;
            $download->slug = $capitulo->slug.'-'.'download'.$i2;
            $download->status = 1;

            $download->save();
        }
        

        return redirect('view/'.$capitulo->slug)->with('success','Capítulo registrado correctamente');
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
    public function edit(Capitulo $capitulo)
    {
        return view('capitulo.edit', compact('capitulo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Capitulo $capitulo)
    {
        $capitulo->name = $request->input('name');
        $capitulo->number = $request->input('number');
        $capitulo->status = $request->input('status');
        $capitulo->AnimeStatus = $request->input('AnimeStatus');
        $capitulo->method = $request->input('method');
        $capitulo->url = $request->input('url');

        $capitulo->save();
        return redirect('view/'.$capitulo->slug)->with('success','Capítulo editado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Capitulo $capitulo)
    {

        $capitulo->delete();
        $serie = Serie::where('id','=',$capitulo->serie_id)->firstOrFail();

        return redirect('anime/'.$serie->slug)->with('success','Capitulo eliminado correctamente');
    }

    public function register(){
        set_time_limit(3600);
        $totalNoViews = Capitulo::where('status','=',0)->get();

        foreach($totalNoViews as $totalNoView){
            $curl = curl_init();
            $url = $totalNoView->url;

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

            preg_match_all('|<li class="(.*)" data-tplayernv="(.*)" data-toggle="tooltip" title="(.*)"><span>(.*)</span></li>|siU', $result, $nombre);
            $videoName = $nombre[3];

            preg_match_all('|url=(.*)&id=(.*)&quot|siU', $result, $code);
            $videoCode = $code[1];

            preg_match_all('|<td><a class="btnWeb" href="(.*)" target="_blank"><i class="fa fa-download"></i> </a></td>|siU', $result, $download);
            $downloadUrl = $download[1];

            for ($i=0; $i < count($videoName) ; $i++) { 
                for ($i=0; $i < count($videoCode) ; $i++) {
                    $video = new Video();
                    $video->name = $videoName[$i];
                    if(urldecode($videoCode[$i]) == null){
                        $video->code = 'https://reproductor.monoschinos.com/';
                    }else{
                        $video->code = urldecode($videoCode[$i]);
                    }
                    $video->capitulo_id = $totalNoView->id;
                    $video->slug = $totalNoView->slug.'-'.$videoName[$i];
                    $video->status = 1;

                    $video->save();
                }
            }

            for ($i2=0; $i2 < count($downloadUrl) ; $i2++){
                $download = new Download();
                $download->name = explode('/',$downloadUrl[$i2])[2];
                $download->code = $downloadUrl[$i2];
                $download->capitulo_id = $totalNoView->id;
                $download->slug = $totalNoView->slug.'-'.'download'.$i2;
                $download->status = 1;

                $download->save();
            }

            $totalNoView->status++;
            $totalNoView->save();
        }

        return back()->with('success','Capítulos registrados correctamente');
    }
}
