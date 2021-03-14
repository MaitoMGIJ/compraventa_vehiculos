<?php

namespace App\Traits;

trait HasDefaultImage{

    public function getImage(){
        if($this->urlExists($this->url)){
            return $this->url;
        }
        return config('hasdefaultimage.default');
    }

}
