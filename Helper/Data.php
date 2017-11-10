<?php

namespace Reviewscouk\Reviews\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{

    public function getProductSkus($product)
    {
        $sku = $product->getSku();
        $type = $product->getTypeID();

        $productSkus = [$sku];
        if ($type == 'configurable') {
            $usedProducts = $product->getTypeInstance()->getUsedProducts($product);
            foreach ($usedProducts as $usedProduct) {
                $productSkus[] = $usedProduct->getSku();
            }
        }

        if ($type == 'grouped') {
            $usedProducts = $product->getTypeInstance()->getAssociatedProducts($product);
            foreach ($usedProducts as $usedProduct) {
                $productSkus[] = $usedProduct->getSku();
            }
        }

        return $productSkus;
    }
}
