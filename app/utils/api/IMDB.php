<?php

namespace App\utils\api;

class IMDB {
    public static function CallAPI($url){
        $ua = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:97.0) Gecko/20100101 Firefox/97.0';
        $ch = curl_init();
        if (preg_match('`^https://`i', $url))
        {//pour les URLs en HTTPS
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        }
        curl_setopt($ch, CURLOPT_USERAGENT, $ua);
        curl_setopt($ch, CURLOPT_URL, $url );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
        // le scraper suit les redirections
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $result = curl_exec($ch);
        curl_close ( $ch );
        return json_decode( $result, true );
    }

    public static function getListeMovie($nom){
        $tab_film = array();
        $tab_year = [
            date('Y', strtotime('-1 year')),
            date('Y'),
            date('Y', strtotime('+1 year'))
        ];
        foreach($tab_year as $year){
            $rq = "https://api.themoviedb.org/3/search/movie?api_key=".config('global.KEY_IMBD').
            "&language=fr&query=".$nom."&page=1&include_adult=false&year=".$year;
            $result = IMDB::CallAPI($rq);
            if (isset($result['results'])){
                foreach($result['results'] as $film){
                    if (str_contains($film['title'], $nom)){
                        $tab_film[] = $film;
                    }
                }
            }
            if (isset($result['total_pages']))
                for ($i = 2 ; $i <= $result['total_pages'] ; $i++){
                    $rq = "https://api.themoviedb.org/3/search/movie?api_key=".config('global.KEY_IMBD').
                    "&language=fr&query=".$nom."&page=".$i."&include_adult=false&year=".$year;
                    $other_result = IMDB::CallAPI($rq);
                    if (isset($other_result['results'])){
                        foreach($other_result['results'] as $film){
                            if (str_contains($film['title'], $nom)){
                                $tab_film[] = $film;
                            }
                        }
                    }
                }
        }
        return $tab_film;
    }

    public static function getBaseUrlImage(){
        $rq = "https://api.themoviedb.org/3/configuration?api_key=".config('global.KEY_IMBD');
        $result = IMDB::CallAPI($rq);
        if (isset($result['images']['base_url'])){
            return $result['images']['base_url'].'original';
        } else {
            return "";
        }
    }

    public static function getUrlImage($id_imdb_film){
        if ($id_imdb_film != 0){
            $infos = IMDB::getInfosFilm($id_imdb_film);
            if (isset($infos['poster_path'])){
                return IMDB::getBaseUrlImage().$infos['poster_path'];
            }
        }
        return "";
    }

    public static function getInfosFilm($id_imdb_film){
        $rq = "https://api.themoviedb.org/3/movie/".$id_imdb_film."?api_key=".config('global.KEY_IMBD')."&language=fr";
        return IMDB::CallAPI($rq);
    }
}