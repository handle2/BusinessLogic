<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2016.12.21.
 * Time: 15:45
 */

namespace Modules\BusinessLogic\ContentSettings;


class Prodcateg extends Base
{
    public $id;

    public function generate(\Modules\BusinessLogic\Models\Prodcateg $obj){
        $prodcateg = new Prodcateg();
        foreach ($obj as $key => $prop){
            if($key != '_id'){
                $prodcateg->{$key} = $prop;
            }
        }
        return $prodcateg;
    }

    public function delete(){

        $model = new \Modules\BusinessLogic\Models\Prodcateg();
        $prodcateg = $model->create($this->id);

        if($prodcateg->delete()){
            unset($this);
            return true;
        }else{
            return false;
        }
    }

    public function save(){

        $model = new \Modules\BusinessLogic\Models\Prodcateg();
        $prodcateg = $model->create($this->id);
        foreach ($this as $key => $prop){
            if($key != '_id') {
                $prodcateg->{$key} = $this->{$key};
            }
        }
        if($prodcateg->save()){
            return true;
        }else{
            return false;
        }
    }
}