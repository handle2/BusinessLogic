<?php

namespace Modules\BusinessLogic\ContentSettings;


class Base
{
    public function getPictures(){
        if(!isset($this->pictureIds)){
            return null;
        }

        return Document::createPictures($this->pictureIds);
    }

    protected function generateUrl($name){
        $ekezet = array('ö', 'ü', 'ó', 'ő', 'ú', 'ű', 'á', 'é', 'í', ' ', '?', '!', '{', '}', ',', ':', '@', '&', '<', '>', '|', '\\','%','(',')');
        $normal = array('o', 'u', 'o', 'o', 'u', 'u', 'a', 'e', 'i', '-', '',  '',  '',  '',  '',  '',  '',  '',  '',  '',  '',  '','','','');
        $url = str_replace($ekezet, $normal, mb_strtolower($name));
        return $url;
    }
}