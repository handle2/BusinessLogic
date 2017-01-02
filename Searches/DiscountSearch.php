<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2017.01.01.
 * Time: 19:15
 */

namespace Modules\BusinessLogic\Search;


use Modules\BusinessLogic\ContentSettings\Discount;
use Modules\BusinessLogic\Models\Discounts;

class DiscountSearch extends BaseSearch
{
    public $ids;
    public static function createDiscountSearch(){

        $search = new DiscountSearch();
        $search->model = new Discounts();
        /**@var Discount $object*/
        $search->object = new Discount();
        return $search;
    }

    public function _readSearch(){

        $params = parent::_readSearch();

        return $params;
    }
}