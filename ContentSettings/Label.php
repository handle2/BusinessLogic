<?php
namespace Modules\BusinessLogic\ContentSettings;

use Modules\BusinessLogic\Models as Models;

class Label extends Base{
    public $id = null;
    public $title = null;
    public $code = null;

    public static function getLabel($code){
        $mlabel = Models\Labels::findFirst(array('conditions'=>array('code'=>$code)));
        $label = new Label();
        $label->id = $mlabel->_id;
        $label->title = $mlabel->title;
        $label->code = $mlabel->code;
        return $label;
    }

    public static function getLabels(){
        $mlabel = Models\Labels::find();
        $labels = [];
        foreach ($mlabel as $lab){
            $label = new Label();
            $label->id = $lab->_id;
            $label->title = $lab->title;
            $label->code = $lab->code;
            $labels[] = $label;
        }
        return $labels;
    }
    
    public function save(){
        $content = Models\Labels::findFirst(array(
            'conditions' => array(
                '_id' => $this->id
            )
        ));
        $content->title = $this->title;
        $content->code = $this->code;
        $content->save();
    }
}