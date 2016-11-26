<?php
namespace Modules\BusinessLogic\ContentSettings;

use Modules\BusinessLogic\Models as Models;

class Content extends Base{
    public $pictures = array();
    public $pictureIds = array();
    public $id = null;
    public $title = null;
    public $short = null;
    public $lead = null;
    public $text = null;
    public $parent = null;
    public $url = null;
    public $user = null;
    public $type = null;
    public $labels = array();

    private function genetareContents($contents){

        $cons = array();

        foreach ($contents as $item){
            $content = new Content();
            $content->id = $item->_id;
            $content->title = $item->title;
            $content->short = $item->short;
            $content->lead = $item->lead;
            $content->text = $item->text;
            $content->pictureIds = $item->pictureIds;
            $content->parent = $item->parent;
            $content->url = $item->url;
            $content->type = $item->type;
            $content->user = $item->user;
            $content->labels = $item->labels;
            $cons[] = $content;
        }
        return $cons;
    }

    public static function getContents($parent = false){
        if($parent){
            $conditions = array('conditions' => array(
                'parent' => $parent
            ));   
        }else{
            $conditions = [];
        }
        $contents = Models\Contents::find($conditions);
        $class = new Content();
        return $class->genetareContents($contents);
     }

    public static function getContentByType($type){
        $contents = Models\Contents::find((array(
            'conditions' => array(
                'type' => $type
            )
        )));
        $class = new Content();
        return $class->genetareContents($contents);
    }

     public static function getContent($url){
        $c = Models\Contents::findFirst(array(
            'conditions' => array(
                'url' => $url
            )
        ));
         $class = new Content();
         return $class->genetareContents([$c])[0];
    }

    public static function createByLabels($labels){
        $contents = Models\Contents::find(array(
            'conditions' => array(
                'labels' => array('$in' => $labels)
            )
        ));
        $class = new Content();
        return $class->genetareContents($contents);
    }

    public function getChildren(){
        $contents = Models\Contents::find(array(
             'conditions' => array(
                'parent' => (string)$this->id
             )
        ));
        $class = new Content();
        return $class->genetareContents($contents);
    }

    public function save(){
        $content = Models\Contents::findFirst(array(
            'conditions' => array(
                '_id' => $this->id
            )
        ));
        $content->title = $this->title;
        $content->short = $this->short;
        $content->lead = $this->lead;
        $content->text = $this->text;
        $content->pictureIds = !empty($this->pictureIds)?$this->pictureIds:[];
        $content->parent = $this->parent;
        $content->url = $this->url;
        $content->type = !empty($this->type)?$this->type:[];
        $content->user = !empty($this->user)?$this->user:[];
        $content->labels = $this->labels;
        $content->save();
    }
}