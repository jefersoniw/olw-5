<?php

namespace App\Services;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductServices
{
  public function list()
  {
    return Product::paginate();
  }

  public function store(ProductStoreRequest $request)
  {
    DB::beginTransaction();
    try {
      $product_data = $request->except('sku');
      $product_data['slug'] = Str::slug($product_data['name']);

      $product = Product::create($product_data);
      $skus = $product->skus()->createMany($request->get('sku'));

      foreach ($skus as $k => $sku) {
        foreach ($request->sku[$k]['images'] as $i => $image) {
          $path = $image['url']->store('products');

          $sku->images()->create([
            'url' => $path,
            'cover' => $i == 0,
          ]);
        }
      }

      $product->load('skus.images');

      DB::commit();

      return $product;
    } catch (Exception $error) {
      DB::rollBack();

      return [
        'error' => true,
        'msg' => $error->getMessage()
      ];
    }
  }
}
