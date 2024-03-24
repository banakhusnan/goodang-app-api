<?php

namespace App\Repositories\Product;

class ProductRepositoryImplement implements ProductRepository
{
    private $modelProduct;
    public function __construct(
        \App\Models\Product $modelProduct
    ) {
        $this->modelProduct = $modelProduct;
    }

    public function showAllProducts()
    {
        return $this->modelProduct->all();
    }

    public function storeProduct($data)
    {
        $randomCharCode = mt_rand(65, 90);
        $data['code'] = chr($randomCharCode) . '-' . now()->format('his');

        $product = $this->modelProduct->create($data);

        return $product;
    }

    public function showProductById($id)
    {
        return $this->modelProduct->find($id);
    }

    public function updateProductById($data, $id)
    {
        $product = $this->modelProduct->find($id);

        if ($product) {
            $product->update($data);
        }

        return $product;
    }

    public function deleteProductById($id)
    {
        $deletedProduct = $this->modelProduct->find($id);

        if ($deletedProduct) {
            $deletedProduct->delete();
            return 'success';
        }

        return 'error';
    }
}
