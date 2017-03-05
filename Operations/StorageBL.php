<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2017.03.05.
 * Time: 19:03
 */

namespace Modules\BusinessLogic\Operations;


use Modules\BusinessLogic\Search\StorageSearch;

class StorageBL extends BaseBL
{
    public function getDefaultStorage(){
        $storageSearch = StorageSearch::createStorageSearch();
        $storageSearch->actual = true;
        $storageSearch->unwind = '$product';
        $storageSearch->type = 'discount';
        $discounts = $storageSearch->aggregate();
        $storageSearch->actual = false;
        $storageSearch->type = 'basic';
        $base = $storageSearch->aggregate();
        $storage = [];

        foreach ($base as $product){
            $take = false;
            foreach ($discounts as $discount){
                if($discount['product']['id'] == $product['product']['id']){
                    $discount['product']['basePrice'] = $product['product']['price'];
                    $discount['product'] = (object)$discount['product'];
                    $storage[] = (object)$discount;
                    $take = true;
                    break;
                }
            }
            if(!$take){
                $product['product']['basePrice'] = $product['product']['price'];
                $product['product'] = (object)$product['product'];
                $storage[] = (object)$product;
            }
        }
        return $storage;
    }
}