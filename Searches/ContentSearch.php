<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2017.01.04.
 * Time: 22:22
 */

namespace Modules\BusinessLogic\Search;


use Modules\BusinessLogic\ContentSettings\Content;
use Modules\BusinessLogic\Models\Contents;

class ContentSearch extends BaseSearch
{
    public $ids;
    public static function createContentSearch(){

        $search = new ContentSearch();
        $search->model = new Contents();
        /**@var Content $object*/
        $search->object = new Content();
        return $search;
    }

    public function _readSearch(){

        $params = parent::_readSearch();

        return $params;
    }
}