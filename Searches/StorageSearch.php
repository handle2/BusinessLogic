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
     * ez a discount típusa
     * @var string */
    public $type;

    /**
     * ezzel adjuk meg ,hogy az aktuális árlistát szeretnénk megkapni
     * @var bool */
    public $actual = false;

    /**
     * ezzel adjuk meg ,hogy csak azokat adja vissza aminek van ára is
     * @var bool  */
    public $priced = true;

    /**
     * ezzel azokat kapjuk vissza ami van raktáron
     * @var bool  */
    public $onStorage = true;

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

        if($this->actual){

            $today = time();
            $params[]['$match'] = array(
                'dateFrom' => array('$lte'=> $today),
                'dateTo' => array('$gte'=> $today)
            );
        }

        $params[]['$project'] = array('_id' => 0,'name' => 1,'product' => '$products','id'=>1);

        if(!empty($this->unwind)){
            $params[]['$unwind'] = $this->unwind;
        }

        if($this->priced){
            $params[]['$match'] = array('product.price' => array('$gt'=>0));
        }
        if($this->onStorage){
            $params[]['$match'] = array('product.quantity' => array('$gt'=>0));
        }

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