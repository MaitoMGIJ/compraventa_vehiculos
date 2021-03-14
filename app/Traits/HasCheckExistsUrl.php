<?php

namespace App\Traits;

trait HasCheckExistsUrl{

    public function urlExists($url = NULL)
        {
            if ($url == NULL) return false;
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $data = curl_exec($ch);
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            return ($httpcode >= 200 && $httpcode < 300) ? true : false;
    }

}
