<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2016.12.22.
 * Time: 19:29
 */

namespace Modules\BusinessLogic\ContentSettings;


use Modules\BusinessLogic\Models\Prodcategs;

class Prodcateg extends Base
{
    public $id;
    public $url;
    public $name;
    public $inputs;

    public function generate(Prodcategs $obj){
        $prodcateg = new Prodcateg();
        $prodcateg->id = $obj->id;
        $prodcateg->url = $obj->url;
        $prodcateg->name = $obj->name;
        $prodcateg->inputs = $obj->inputs;
        return $prodcateg;
    }

    public function delete(){

        $this->deleteCache($this);
        
        $model = new Prodcategs();
        $input = $model->create($this->id);
        if($input->delete()){
            unset($this);
            return true;
        }else{
            return false;
        }
    }

    public function save(){

        $this->deleteCache($this);
        
        $model = new Prodcategs();
        $prodcateg = $model->create($this->id);
        $prodcateg->id = $this->id;
        $prodcateg->url = $this->urlMakeup($this->url);
        $prodcateg->name = $this->name;
        $prodcateg->inputs = $this->inputs;
        if($prodcateg->save()){
            return true;
        }else{
            return false;
        }
    }
}