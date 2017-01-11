<?php

namespace Modules\BusinessLogic\ContentSettings;


use Modules\BusinessLogic\Search\DocumentSearch;
use Phalcon\DI;

class Base
{
    public function getPictures(){
        if(!isset($this->pictureIds)){
            return null;
        }
        $search = DocumentSearch::createDocumentSearch();
        $search->ids = $this->pictureIds;
        $search->disableCache();
        $pictures = $search->find();
        return $pictures;
    }

    protected function urlMakeup($name){
        $ekezet = array('ö', 'ü', 'ó', 'ő', 'ú', 'ű', 'á', 'é', 'í');
        $normal = array('o', 'u', 'o', 'o', 'u', 'u', 'a', 'e', 'i');
        $text = $url = str_replace($ekezet, $normal, mb_strtolower($name));
        return preg_replace('/[^a-z0-9]/i', '_', $text);
    }

    protected function createRedis(){
        $di = DI::getDefault();
        return $di['redis'];
    }
    
    protected function deleteCache($obj){
        $cache = $this->createRedis();

        $objectName = explode('\\',get_class($obj));

        /**@var \Predis\Client $cache*/
        $keys = $cache->keys('*');

        foreach ($keys as $key){
            if(strpos($key, end($objectName)) !== false){
                $cache->del([$key]);
            }
        }
    }
}