<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2016.12.23.
 * Time: 10:13
 */

namespace Modules\BusinessLogic\Search;


use Modules\BusinessLogic\ContentSettings\Input;
use Modules\BusinessLogic\Models\Inputs;

class InputSearch extends BaseSearch
{
    public $ids;
    public static function createInputSearch(){

        $search = new InputSearch();
        $search->model = new Inputs();
        /**@var Input $object*/
        $search->object = new Input();
        return $search;
    }

    public function _readSearch(){

        $params = parent::_readSearch();

        return $params;
    }
}