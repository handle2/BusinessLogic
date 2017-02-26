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

    public $type;

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

    protected function _readAggregation(){
        $params = parent::_readAggregation();

        if(!empty($this->type)){
            $params[]['$match'] = array(
                'type' => array('$eq'=> $this->type)
            );
        }
        
        $params[]['$project'] = array('_id' => 0,'name' => 1,'products' => 1,'id'=>1);

        $params[]['$unwind'] = '$products';

        return $params;
    }

    /**
     * @return array
     */
    public function _readSearch(){

        $params = parent::_readSearch();

        return $params;
    }
}