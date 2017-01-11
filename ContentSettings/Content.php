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
    
    public function generate(Contents $obj){
        $content = new Content();
        $content->id = $obj->id;
        $content->type = $obj->type;
        $content->url = $obj->url;
        $content->name = $obj->name;
        $content->text = $obj->text;
        $content->lead = $obj->lead;
        $content->pictureIds = $obj->pictureIds;
        $content->labels = $obj->labels;
        
        return $content;
    }

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
        if($content->save()){
            return true;
        }else{
            return false;
        }
    }
}