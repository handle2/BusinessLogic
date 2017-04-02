<?php
/**
 * Created by PhpStorm.
 * User: Krisz
 * Date: 2017.03.05.
 * Time: 19:03
 */

namespace Modules\BusinessLogic\Operations;


use Modules\BusinessLogic\ContentSettings\Product;
use Modules\BusinessLogic\Search\ProductSearch;
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
        $storageSearch->onStorage = false;
        $storageSearch->type = 'basic';
        $base = $storageSearch->aggregate();
        $storageProducts = [];

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
                $storageProducts[] = (object)$product;
            }
        }
        $products = [];
        $productSearch = ProductSearch::createProductSearch();
        foreach ($storageProducts as $storageProduct){
            /** @var Product $product */
            $product = $productSearch->create($storageProduct->product->id);
            $product->basePrice = $storageProduct->product->basePrice;
            $product->price = $storageProduct->product->price;
            $product->quantity = $storageProduct->product->quantity;
            $products[] = $product;
        }


        return $products;
    }
}