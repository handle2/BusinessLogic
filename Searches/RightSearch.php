<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2016.12.07.
 * Time: 21:21
 */

namespace Modules\BusinessLogic\Search;


use Modules\BusinessLogic\ContentSettings\Right;
use Modules\BusinessLogic\Models;

class RightSearch extends BaseSearch
{
    public $id;
    public $code;
    public $type;
    public $name;
    public $parent;

    public static function createRightSearch(){

        $search = new RightSearch();
        $search->model = new Models\Rights();
        /**@var \Modules\BusinessLogic\ContentSettings\Right $object*/
        $search->object = new Right();
        return $search;
    }

    public function _readSearch(){
        $params = parent::_readSearch();

        if($this->type){
            $params['type'] = $this->type;
        }
        if($this->parent){
            $params['parent'] = $this->parent;
        }

        return $params;
    }
}