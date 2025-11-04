<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Services\ProductService;

class ProductController extends Controller
{
    public function __construct(
        private ProductService $productService,
    ) {}

    public function index()
    {
        $products = $this->productService->findAllPaginate();

        return $this->json($products, wrapper: false);
    }

    public function show(int|string $id)
    {
        $product = $this->productService->findById($id);

        return $this->json($product);
    }

    public function store(ProductStoreRequest $request)
    {
        $data = $request->validated();

        $product = $this->productService->create($data);

        return $this->json($product);
    }

    public function update(int|string $id, ProductUpdateRequest $request)
    {
        $data = $request->validated();

        $this->productService->update($id, $data);

        return $this->success('Product updated sucessfully');
    }

    public function delete(int|string $id)
    {
        $this->productService->delete($id);

        return $this->success('Product deleted sucessfully');
    }
}
