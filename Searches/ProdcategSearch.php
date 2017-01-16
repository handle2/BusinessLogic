<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2016.12.21.
 * Time: 15:45
 */

namespace Modules\BusinessLogic\Search;


use Modules\BusinessLogic\Models\Prodcategs;
use Modules\BusinessLogic\ContentSettings\Prodcateg as ProdObj;

class ProdcategSearch extends BaseSearch
{
    public $id;
    
    public $url;
    
    public $name;
    
    public $inputs;

    /**
     * @return ProdcategSearch
     */
    public static function createProdcategSearch(){

        $search = new ProdcategSearch();
        $search->model = new Prodcategs();
        /**@var ProdObj $object*/
        $search->object = new ProdObj();
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