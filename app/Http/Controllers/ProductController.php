<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductController extends Controller
{
    private $productRepository;
    public function __construct(\App\Repositories\Product\ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->productRepository->showAllProducts();

        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(\App\Http\Requests\StoreProductRequest $request): ProductResource
    {
        // request divalidasi dan kembalikan nilai berupa array
        $data = $request->validated();

        // Tambahkan data kedalam database
        $newProduct = $this->productRepository->storeProduct($data);

        // Kirim data berupa json
        return new ProductResource($newProduct);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): ProductResource
    {
        // Cari data product berdasarkan id
        $findProduct = $this->productRepository->showProductById($id);

        // Jika product yang dicari = kosong/null, berikan pesan error
        if (!$findProduct) {
            throw new HttpResponseException(response([
                'status' => 'error',
                'message' => 'product not found'
            ], 404));
        }

        // Kirim data berupa json
        return new ProductResource($findProduct);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(\App\Http\Requests\UpdateProductRequest $request, string $id): ProductResource
    {
        // Request divalidasi
        $data = $request->validated();

        // Ubah product kedalam repository pattern
        $updatedProduct = $this->productRepository->updateProductById($data, $id);

        // Jika product yang dicari = kosong/null, berikan pesan error
        if (!$updatedProduct) {
            throw new HttpResponseException(response([
                'status' => 'error',
                'message' => 'product not found'
            ], 404));
        }

        return new ProductResource($updatedProduct);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deletedProduct = $this->productRepository->deleteProductById($id);

        if ($deletedProduct === 'success') {
            response()->json([
                'status' => 'success',
                'message' => 'The product has been successfully deleted'
            ], 200);
        }

        throw new HttpResponseException(response([
            'status' => 'error',
            'message' => 'Product not found'
        ], 404));
    }
}
