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
    
    public $langs;

    /**
     * @param Prodcategs $obj
     * @param $lang
     * @return Prodcateg
     */
    public function generate(Prodcategs $obj,$lang){
        $prodcateg = new Prodcateg();
        $prodcateg->id = $obj->id;
        $langs = (object)$obj->langs;
        $prodcateg->url = isset($langs->{$lang}['url'])?$langs->{$lang}['url']:$obj->url;
        $prodcateg->name = isset($langs->{$lang}['name'])?$langs->{$lang}['name']:$obj->name;
        $prodcateg->inputs = $obj->inputs;
        $prodcateg->langs = $obj->langs;
        return $prodcateg;
    }

    /**
     * @return bool
     */
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

    /**
     * @return bool
     */
    public function save(){

        $this->deleteCache($this);
        
        $model = new Prodcategs();
        $prodcateg = $model->create($this->id);
        $prodcateg->id = $this->id;
        $prodcateg->url = $this->urlMakeup($this->url);
        $prodcateg->name = $this->name;
        $prodcateg->inputs = $this->inputs;
        $prodcateg->langs = $this->langs;
        if($prodcateg->save()){
            return true;
        }else{
            return false;
        }
    }
}