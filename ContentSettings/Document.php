<?php

namespace Modules\BusinessLogic\ContentSettings;

use Modules\BusinessLogic\Models as Models;

class Document extends Base
{
    public $id = null;
    public $name = null;
    public $type = null;
    public $user = null;
    public $blob = null;
    public $doc_type = null;
    public $size = null;
    public $url = null;

    public function save(){
        $document = Models\Documents::findFirst(array(
            'conditions' => array(
                '_id' => $this->id
            )
        ));
        $document->name = $this->name;
        $document->type = $this->type;
        $document->user = $this->user;
        $document->blob = $this->blob;
        $document->doc_type = $this->doc_type;
        $document->size = $this->size;
        $document->url = !empty($this->url)?$this->url:'';
        $document->save();
    }
    
    public static function createPictures($ids){
        $pictures = Models\Documents::find(array(
            'conditions' => array(
                '_id' => array('$in' => $ids)
            )
        ));
        $array = [];
        foreach ($pictures as $picture){
            $document = new Document();
            $document->name = $picture->name;
            $document->type = $picture->type;
            $document->user = $picture->user;
            $document->blob = $picture->blob;
            $document->doc_type = $picture->doc_type;
            $document->size = $picture->size;
            $document->url = !empty($picture->url)?$picture->url:'';
            $array[] = $document;
        }
        return $array;
    } 
    
    public function getUrl(){
        if(!file_exists($this->generateUrl($this->url))){
             $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $this->blob));
             file_put_contents('public/images/'.$this->generateUrl($this->name), $data);
        }
        return '/'.$this->generateUrl($this->url);
    }
}