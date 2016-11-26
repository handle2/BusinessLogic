<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2016.10.08.
 * Time: 23:01
 */

namespace Modules\BusinessLogic\ContentSettings;

use Modules\BusinessLogic\Models as Models;

class Type extends Base
{
    private $_id;
    public $name;
    public $type;
    public $seq;
    public $code;

    private function generateTypes($arrays){
        $types = array();
        foreach ($arrays as $array){
            $type = new Type();
            $type->_id = $array->_id;
            $type->name = $array->name;
            $type->type = $array->type;
            $type->seq = $array->seq;
            $type->code = $array->code;
            $types[] = $type;
        }
        return $types;
    }
    
    public static function getTypes($type,$seq = null){
        if($seq && $seq != 1){
            $conditions = array(
                "conditions" => array(
                    'type' => $type,
                    'seq' => array('$gt' => $seq)
                )
            );
        }else{
            $conditions = array(
                "conditions" => array(
                    'type' => $type
                )
            );
        }
        $types = Models\Types::find($conditions);
        $t = new Type();
        return $t->generateTypes($types);
    }

    public static function getType($code){
        $type = Models\Types::findFirst(array(
            "conditions" => array(
                'code' => $code
            )
        ));
        if($type){
            $t = new Type();
            return $t->generateTypes([$type])[0];
        }
        return false;
    }
    
}