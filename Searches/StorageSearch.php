<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2017.02.02.
 * Time: 11:06
 */

namespace Modules\BusinessLogic\Search;


use Modules\BusinessLogic\ContentSettings\Storage;
use Modules\BusinessLogic\Models\Storages;

class StorageSearch extends BaseSearch
{
    /**
     * @return StorageSearch
     */
    public static function createStorageSearch(){

        $search = new StorageSearch();
        $search->model = new Storages();
        /**@var Storage $object*/
        $search->object = new Storage();
        return $search;
    }

    /**
     * @return array
     */
    public function _readSearch(){

        $params = parent::_readSearch();

        return $params;
    }
}