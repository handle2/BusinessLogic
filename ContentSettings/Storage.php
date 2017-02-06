<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2017.02.02.
 * Time: 10:54
 */

namespace Modules\BusinessLogic\ContentSettings;


use Modules\BusinessLogic\Models\Storages;

class Storage extends Base
{
    public $id;

    public $name;

    public $code;

    public $langs;


    /**
     * @param Storages $obj
     * @param $lang
     * @return Label
     */
    public function generate(Storages $obj,$lang){
        $self = new Storage();
        $langs = (object)$obj->langs;
        foreach ($obj as $key => $prop){
            if($key != '_id'){
                $self->{$key} = isset($langs->{$lang}[$key])?$langs->{$lang}[$key]:$prop;
            }
        }
        return $self;
    }

    /**
     * @return bool
     */
    public function delete(){

        $this->deleteCache($this);

        $model = new Storages();
        $self = $model->create($this->id);
        if($self->delete()){
            unset($this);
            return true;
        }else{
            return false;
        }
    }

    /**
     * @return bool
     */
    public function save(){

        $this->deleteCache($this);

        $model = new Storages();
         $storage = $model->create($this->id);
        foreach ($this as $key => $prop){
            if($key != '_id') {
                $storage->{$key} = $this->{$key};
            }
        }
        if($storage->save()){
            return true;
        }else{
            return false;
        }
    }
}