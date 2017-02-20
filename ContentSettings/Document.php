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

    public $langs;


    /**
     * @param Documents $obj
     * @param $lang
     * @return Document
     */
    public function generate(Documents $obj,$lang){
        $document = new Document();
        $document->id = $obj->id;
        $document->sourceImage = $obj->sourceImage;
        $document->croppedImage = $obj->croppedImage;
        $document->bounds = $obj->bounds;
        $langs = (object)$obj->langs;
        $document->name = isset($langs->{$lang}['name'])?$langs->{$lang}['name']:$obj->name;
        $document->type = $obj->type;
        $document->size = $obj->size;
        $document->langs = $obj->langs;
        return $document;
    }

    /**
     * Törlés
     * @return bool
     */
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

    /**
     * Mentés
     * @return bool
     */
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
        $document->langs = $this->langs;
        if($document->save()){
            return true;
        }else{
            return false;
        }
    }

    public function getUrl(){
        $path = './public/images/'.$this->name;
        if(!file_exists($path)){
            $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', !empty($this->croppedImage)?$this->croppedImage:$this->sourceImage));
            file_put_contents($path, $data);
        }
        return substr($path, 1);

    }
}