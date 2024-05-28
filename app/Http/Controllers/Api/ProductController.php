<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\MessageResource;
use App\Http\Resources\ProductResource;
use App\Libraries\FileResponseLibraries;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $lastProduct = Product::where('company_id', $request->company_id)->orderBy('created_at', 'desc')->first();
        if($lastProduct) {
            $product_no = substr(pathinfo($lastProduct->product_img, PATHINFO_FILENAME), 2) + 1;
        } else {
            $product_no = 1;
        }
        $product = new Product;
        if ($request->hasFile('product_img')) {
            $product_img = $request->file('product_img');
            $fileName = "P_" . $product_no . '.' . $product_img->getClientOriginalExtension();
            FileResponseLibraries::uploadFile($product_img, "/{$request->company_id}/product/", $fileName);
            $product->product_img = $fileName;
        }
        $product->company_id = $request->company_id;
        $product->type = $request->type;
        $product->save();

        $languages = ['vi', 'en', 'ja'];
        $product_names = json_decode($request->product_name, true);
        $product_descriptions = json_decode($request->product_description, true);
        $t_products = ['product_name' => $product_names, 'product_description' => $product_descriptions];
        foreach ($languages as $language) {
            $queryData = ["language" => $language];
            foreach ($t_products as $key => $t_product) {
                if (isset($t_product[$language])) {
                    $queryData[$key] = $t_product[$language];
                }
            }
            if (!empty($queryData)) {
                $product->translate()->create($queryData);
            }
        }
        return response()->json([
            "message" => "Create product success",
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $type = request()->query('type');
        $product = Product::where("type", $type)
            ->where("company_id", $id)
            ->get();

        return ProductResource::collection($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        $oldFileName = pathinfo($product->product_img, PATHINFO_FILENAME);
        if ($request->hasFile('product_img')) {
            $product_img = $request->file("product_img");
            $fileName = $oldFileName . '.' . $product_img->getClientOriginalExtension();
            FileResponseLibraries::deleteFile("/{$product->company_id}/product/", $product->product_img);
            FileResponseLibraries::uploadFile($product_img, "/{$product->company_id}/product/", $fileName);
            $product->product_img = $fileName;
        }
        $product->save();

        $languages = ['vi', 'en', 'ja'];
        $t_product_datas = [
            'product_name' => json_decode($request->product_name, true), 
            'product_description' => json_decode($request->product_description, true)
        ];
        foreach ($languages as $language) {
            $updateData = [];
            foreach ($t_product_datas as $key => $t_product_data) {
                if (isset($t_product_data[$language])) {
                    $updateData[$key] = $t_product_data[$language];
                }
            }
            $t_product = $product->translate()->where('language', $language)->first();
            if (!empty($updateData) && $t_product) {
                $t_product->update($updateData);
            }
        }
        return (new ProductResource($product))->additional(['message' => 'Product updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if ($product) {
            FileResponseLibraries::deleteFile("/{$product->company_id}/product/", $product->product_img);
            $product->delete();
            return response()->json(['message' => 'Product deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Product not found'], 404);
        }
    }
}
