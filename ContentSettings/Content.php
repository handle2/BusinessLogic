<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2017.01.04.
 * Time: 22:22
 */

namespace Modules\BusinessLogic\ContentSettings;


use Modules\BusinessLogic\Models\Contents;

class Content extends Base
{
    public $id;
    
    public $type;
    
    public $url;
    
    public $name;
    
    public $text;
    
    public $lead;
    
    public $pictures;
    
    public $pictureIds;
    
    public $labels;
    
    public $langs;


    /**
     * Generálás
     * @param Contents $obj
     * @param $lang
     * @return Content
     */
    public function generate(Contents $obj,$lang){

        $content = new Content();
        $content->id = $obj->id;
        $langs = (object)$obj->langs;
        $content->type = isset($langs->{$lang}['type'])?$langs->{$lang}['type']:$obj->type;
        $content->url = isset($langs->{$lang}['url'])?$langs->{$lang}['url']:$obj->url;
        $content->name = isset($langs->{$lang}['name'])?$langs->{$lang}['name']:$obj->name;
        $content->text = isset($langs->{$lang}['text'])?$langs->{$lang}['text']:$obj->text;
        $content->lead = isset($langs->{$lang}['lead'])?$langs->{$lang}['lead']:$obj->lead;
        $content->pictureIds = $obj->pictureIds;
        $content->labels = isset($langs->{$lang}['labels'])?$langs->{$lang}['labels']:$obj->labels;
        $content->langs = $obj->langs;
        
        return $content;
    }

    /**
     * Törlés
     * @return bool
     */
    public function delete(){

        $this->deleteCache($this);

        $model = new Contents();
        $content = $model->create($this->id);
        if($content->delete()){
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

        $model = new Contents();
        /**@var Contents $content*/
        $content = $model->create($this->id);
        $content->id = $this->id;
        $content->type = $this->type;
        $content->url = $this->urlMakeup($this->url);
        $content->name = $this->name;
        $content->text = $this->text;
        $content->lead = $this->lead;
        $content->pictureIds = $this->pictureIds;
        $content->labels = $this->labels;
        $content->langs = $this->langs;
        if($content->save()){
            return true;
        }else{
            return false;
        }
    }
}