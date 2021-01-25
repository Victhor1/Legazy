<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Serie;
use App\Download;
use App\Video;
use App\Capitulo;
use App\Genre;
use App\Relacion;
use Cache;
use DB;

class FrontController extends Controller
{
    public function index(){

        $series = Serie::where('hidden','!=', 1)
            ->orderBy('id','desc')
            ->limit(18)
            ->get();

        $capitulos = Capitulo::where('AnimeStatus', '=', '1')
            ->orderBy('id','desc')
            ->limit(32)
            ->get();

        $recomens = Serie::where('hidden','!=', 1)
            ->orderBy('counterView','desc')
            ->limit(23)
            ->get();
        
        $tops = Serie::where('hidden','!=', 1)
            ->orderBy('counterView','desc')
            ->limit(5)
            ->get();

        return view('front.index',compact('series','capitulos','recomens','tops'));
    }

    public function animes(){

        $series = Serie::where('hidden','!=', 1)->orderBy('published','desc')->paginate(36);

        return view('front.animes',compact('series'));
    }

    public function emision(){

        $series = Serie::where('hidden','!=', 1)->where('status','=',1)->orderBy('published','desc')->paginate(36);

        return view('front.emision',compact('series'));
    }

    public function show($slug){

        $anime = Serie::where('slug','=', $slug)
            ->firstOrFail();
        //$capitulos = $anime->capitulos->sortByDesc('number');

        $series = Serie::where('hidden','!=', 1)
            ->where('slug', '!=', $slug)
            ->inRandomOrder()->take(50)
            ->limit(8)
            ->get();

        /*$verificar = $anime->relaciones;

        if(count($verificar) != 0){
            $relacion = Relacion::select('*')->where('serie_id','=',$anime->id)->get()->toArray();

            $tipo = Arr::get($relacion,'type');
            dd($relacion);
            exit();

            $relaciones = Serie::where('id','=',$relacion->relacion_id)->get();

            return view('front.show',compact('anime','series','relaciones'));
        }else{
            return view('front.show',compact('anime','series'));
        }*/
        return view('front.show',compact('anime','series'));
        
    }

    public function genreshow($slug){

        $genre = Genre::where('slug','=', $slug)
            ->firstOrFail();

        $series = $genre->series()->where('hidden','!=', 1)->orderBy('published','desc')->paginate(28);

        return view('front.genre',compact('genre','series'));
    }

    public function type($type){

        $series = Serie::where('hidden','!=', 1)
            ->where('type','=', $type)
            ->orderBy('published','desc')
            ->paginate(24);
        
        $series2 = Serie::where('hidden','!=', 1)
            ->where('type','=', $type)
            ->first();

        return view('front.type',compact('series','series2'));
    }

    public function view($slug){

        set_time_limit(3600);

        $capitulo = Capitulo::where('slug','=', $slug)
            ->firstOrFail();
        
        $url = 'https://legazy.net/view/'.$capitulo->slug;

        $serie = Serie::where('id','=', $capitulo->serie_id)->firstOrFail();

        if($capitulo->status != 1){

            if($capitulo->method == 0){

                set_time_limit(3600);

                $curl = curl_init();
                $url = $capitulo->url;
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

                preg_match_all('|{"server":"(.*)","title":"(.*)","allow_mobile":true,"code":"(.*)"}|siU', $result, $video);
                $videoCode = $video[3];
                $videoName = $video[1];

                for ($i=0; $i < count($videoName) ; $i++) { 
                    for ($i=0; $i < count($videoCode) ; $i++) {
                        $video = new Video();
                        $video->name = $videoName[$i];
                        $video->code = str_replace('\\', '', $videoCode[$i]);
                        $video->capitulo_id = $capitulo->id;
                        $video->slug = $capitulo->slug.'-'.$videoName[$i];
                        $video->status = 1;

                        $video->save();
                    }
                }

                $capitulo->status++;
                $capitulo->save();

            }elseif($capitulo->method == 1){

                $curl = curl_init();
                $url = $capitulo->url;
                $head = array(
                    'Accept-Language: es-us,en;q=0.5',
                    'Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7',
                    'Keep-Alive: 300',
                    'Connection: keep-alive'
                );
                curl_setopt($curl, CURLOPT_HTTPHEADER, $head);
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Linux; U; Android 4.0; en-us; GT-I9300 Build/IMM76D)");
                $result = curl_exec($curl);
                curl_close($curl);

                preg_match_all('|<iframe class="player_conte" src="(.*)" width="565" height="318" scrolling="no" frameborder="0" allowFullScreen="true"></iframe>|siU', $result, $video);
                preg_match_all('|<li role="presentation" data-id="(.*)"><a id="(.*)" class="btn-show lg_1 mode_normal"  rev="(.*)"  rel="(.*)" href="(.*)">(.*)</a></li>|siU', $result, $name);
                $videoName = $name[6];
                $videoCode = $video[1];

                for ($i=0; $i < count($videoName) ; $i++) {
                    for($i=0; $i < count($videoCode) ; $i++){
                        $fembed = str_replace('https://jkanime.net/jkfembed.php?u=', 'https://fembed.com/v/', $videoCode[$i]);

                        $video = new Video();
                        $video->name = $videoName[$i];
                        $video->code = $fembed;
                        $video->capitulo_id = $capitulo->id;
                        $video->slug = $capitulo->slug.'-'.$i;
                        $video->status = 1;

                        $video->save();
                    }
                }

                $capitulo->status++;
                $capitulo->save();
            }elseif($capitulo->method == 2){
                $curl = curl_init();
                $url = $capitulo->url;

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

                $capitulo->status++;
                $capitulo->save();
            }
        }

        if(Cache::has($slug)==false){
                Cache::add($slug,'contador',0.30);
                $capitulo->counterView++;
                $capitulo->save();

                $serie->counterView++;
                $serie->save();
            }

        $anime = Serie::select('series.*')
            ->where('id','=',$capitulo->serie_id)
            ->firstOrFail();

        $preview = Capitulo::select('capitulos.*')
            ->where('serie_id', '=', $capitulo->serie_id)
            ->where('number', '<', $capitulo->number)
            ->orderBy('number', 'desc')
            ->first();

        $next = Capitulo::select('capitulos.*')
            ->where('serie_id', '=', $capitulo->serie_id)
            ->where('number', '>', $capitulo->number)
            ->orderBy('number', 'asc')
            ->first();

        return view('capitulo.show',compact('capitulo','anime','preview','next','url'));
    }

}
