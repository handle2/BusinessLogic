<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2017.01.08.
 * Time: 19:30
 */

namespace Modules\BusinessLogic\ContentSettings;


use Modules\BusinessLogic\Models\Documents;

class Document extends Base
{
    public $id;
    public $sourceImage;
    public $croppedImage;
    public $bounds;
    public $name;
    public $type;
    public $size;
    
    public function generate(Documents $obj,$lang){
        $document = new Document();
        $document->id = $obj->id;
        $document->sourceImage = $obj->sourceImage;
        $document->croppedImage = $obj->croppedImage;
        $document->bounds = $obj->bounds;
        $document->name = isset($obj->{$lang}['name'])?$obj->{$lang}['name']:$obj->name;
        $document->type = $obj->type;
        $document->size = $obj->size;
        return $document;
    }

    public function delete(){

        $this->deleteCache($this);
        
        $model = new Documents();
        $document = $model->create($this->id);
        if($document->delete()){
            unset($this);
            return true;
        }else{
            return false;
        }
    }

    public function save(){

        $this->deleteCache($this);
        
        $model = new Documents();
        $document = $model->create($this->id);
        $document->id = $this->id;
        $document->sourceImage = $this->sourceImage;
        $document->croppedImage = $this->croppedImage;
        $document->bounds = $this->bounds;
        $document->name = $this->name;
        $document->type = $this->type;
        $document->size = $this->size;
        if($document->save()){
            return true;
        }else{
            return false;
        }
    }
}