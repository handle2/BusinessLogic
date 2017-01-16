<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2016.12.23.
 * Time: 10:13
 */

namespace Modules\BusinessLogic\Search;


use Modules\BusinessLogic\ContentSettings\Product;
use Modules\BusinessLogic\Models\Products;

class ProductSearch extends BaseSearch
{

    /**
     * @return ProductSearch
     */
    public static function createProductSearch(){

        $search = new ProductSearch();
        $search->model = new Products();
        /**@var Product $object*/
        $search->object = new Product();
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