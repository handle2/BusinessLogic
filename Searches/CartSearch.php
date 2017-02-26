<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2017.02.25.
 * Time: 21:41
 */

namespace Modules\BusinessLogic\Search;


use Modules\BusinessLogic\ContentSettings\Cart;
use Modules\BusinessLogic\Models\Carts;

class CartSearch extends BaseSearch
{
    public $id;

    public $type;

    public $userId;

    /**
     * @return ContentSearch
     */
    public static function createContentSearch(){

        $search = new CartSearch();
        $search->model = new Carts();
        /**@var Cart $object*/
        $search->object = new Cart();
        return $search;
    }

    /**
     * @return array
     */
    public function _readSearch(){

        $params = parent::_readSearch();

        if(!empty($this->userId)){
            $params['userId'] = $this->userId;
        }

        if(!empty($this->type)){
            $params['type'] = $this->type;
        }

        return $params;
    }

}