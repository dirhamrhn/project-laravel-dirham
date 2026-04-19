<?php
namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function store($data)
    {
        return Product::create($data);
    }

    public function update($id, $data)
    {
        $product = Product::findOrFail($id);
        $product->update($data);
        return $product;
    }

    public function delete($id)
    {
        return Product::destroy($id);
    }
}