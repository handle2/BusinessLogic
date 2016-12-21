<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2016.12.21.
 * Time: 15:45
 */

namespace Modules\BusinessLogic\Search;


use Modules\BusinessLogic\Models\Prodcateg;
use Modules\BusinessLogic\ContentSettings\Prodcateg as ProdObj;

class ProdcategSearch extends BaseSearch
{
    public $id;
    public $code;
    public $type;
    public $name;
    public $parent;

    public $controller;
    public $action;

    public static function createRightSearch(){

        $search = new ProdcategSearch();
        $search->model = new Prodcateg();
        /**@var ProdObj $object*/
        $search->object = new ProdObj();
        return $search;
    }

    public function _readSearch(){
        
        $params = parent::_readSearch();

        return $params;
    }
}