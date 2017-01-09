<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2017.01.09.
 * Time: 9:34
 */

namespace Modules\BusinessLogic\ContentSettings;


use Modules\BusinessLogic\Models\Labels;

class Label extends Base
{
    public $id;
    public $name;
    public $code;

    public function generate(Labels $obj){
        $self = new Label();
        $self->id = $obj->id;
        $self->name = $obj->name;
        $self->code = $obj->code;
        return $self;
    }

    public function delete(){

        $model = new Labels();
        $self = $model->create($this->id);
        if($self->delete()){
            unset($this);
            return true;
        }else{
            return false;
        }
    }

    public function save(){

        $model = new Labels();
        $self = $model->create($this->id);
        $self->id = $this->id;
        $self->name = $this->name;
        $self->code = $this->code;
        if($self->save()){
            return true;
        }else{
            return false;
        }
    }
}