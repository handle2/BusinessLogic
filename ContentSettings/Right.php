<?php
namespace Modules\BusinessLogic\ContentSettings;

use Modules\BusinessLogic\Models as Models;

class Right extends Base
{

    private $_id = null;
    public $name = "";
    public $code = "";
    public $categ = "";
    public $types = array();

    public static function getRights($type,$categ = null)
    {
        $rights = [];

        if($categ){
            $conditions =  array(
                '$or' => array(
                    array('types' => []),
                    array('types' => array('$in'=>[$type]))
                ),
                'categ' => $categ
            );
        }else{
            $conditions =  array(
                '$or' => array(
                    array('types' => []),
                    array('types' => array('$in'=>[$type]))
                )
            );
        }
        
        $_rights = Models\Rights::find(array(
            $conditions
        ));
        foreach ($_rights as $item) {
            $right = new Right();
            $right->_id = $item->_id;
            $right->name = $item->name;
            $right->code = $item->code;
            $right->categ = $item->categ;
            $right->types = $item->types;
            $rights[] = $right;
        }
        return $rights;
    }
    public function save(){
        $right = Models\Rights::findFirst(array(
            'conditions' => array(
                '_id' => $this->_id
            )
        ));
        $right->name = $this->name;
        $right->code = $this->code;
        $right->categ = $this->categ;
        $right->types = $this->types;
        $right->save();
    }
}