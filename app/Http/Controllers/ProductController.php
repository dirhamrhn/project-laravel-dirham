<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductService;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    protected $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    //Tampilkan Data
    public function index()
    {
        return response()->json([
            'status' => true,
            'data' => Product::all()
        ]);
    }

    //Tambah Data
    public function store(StoreProductRequest $request)
    {
        try {
            $data = $request->validated();
            $result = $this->service->store($data);

            return response()->json([
                'status' => true,
                'data' => $result
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal tambah data'
            ]);
        }
    }

    //Ubah Data
    public function update(StoreProductRequest $request, $id)
    {
        $data = $request->validated();
        try {
            return $this->service->update($id, $data);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal update data'
            ]);
        }
    }

    //Hapus Data
    public function destroy($id)
    {
        try {
            return $this->service->delete($id);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal hapus data'
            ]);
        }
    }
}
