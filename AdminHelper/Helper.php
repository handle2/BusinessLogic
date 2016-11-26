<?php

namespace Modules\BusinessLogic\AdminHelper;

use Modules\BusinessLogic\Models as Models;

class Helper{
    public static function isOkay($name){
        $rights = new Models\Rights();
        $perm = $rights->permission($name);
        return !empty($perm->types)?$perm->types:array();   
    }
    public static function setNotification($title,$question){
        $helper = new Helper();
        $helper->_settleNoti($title,$question);
    }

    private function _settleNoti($title,$question){
        $di = \Phalcon\DI\FactoryDefault::getDefault();
        $view = $di['view'];
        $view->question = $question;
        $view->title = $title;
        $view->partial("stuffs/modal");
    }

    public static function saveDocuments($input,$user,$doc_type){
        $pictures = array();
        $ids = array();
        foreach($input as $key => $value){
            $i = 0;
            foreach ($value as $key2 => $value2){
                $pictures[$i][$key] =  $value[$i];
                $i++;
            }
        };
        foreach ($pictures as $picture){
            if(empty($picture['tmp_name'])) {
                continue;
            }else{
                $path = $picture['tmp_name'];
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                $picture['user'] = $user;
                $picture['url'] = 'public/images/'.$picture['name'];
                $picture['doc_type'] = $doc_type;
                $picture['blob'] = $base64;
                $document = new Models\Documents();
                $ids[] = $document->saveDocument($picture);
            }
        }
        return $ids;
    }
}