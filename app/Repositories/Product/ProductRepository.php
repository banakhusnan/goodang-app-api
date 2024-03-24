<?php

namespace App\Repositories\Product;

interface ProductRepository
{
    // Tambah data product
    public function showAllProducts();

    // Tambah data product
    public function storeProduct($data);

    // Cari data product berdasarkan id
    public function showProductById($id);

    // Ubah data product berdasarkan id
    public function updateProductById($data, $id);

    // Hapus data product berdasarkan id
    public function deleteProductById($id);
}
