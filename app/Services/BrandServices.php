<?php

namespace App\Services;

use App\Http\Requests\BrandStoreRequest;
use App\Http\Requests\BrandUpdateRequest;
use App\Models\Brand;
use Exception;

class BrandServices
{
  public function list()
  {
    return Brand::paginate();
  }

  public function store(BrandStoreRequest $request)
  {
    try {
      $brand = Brand::create($request->validated());
      return $brand;
    } catch (Exception $error) {
      return [
        'error' => true,
        'msg' => $error->getMessage()
      ];
    }
  }

  public function update(BrandUpdateRequest $request, Brand $brand)
  {
    try {
      $brand->update($request->validated());
      return $brand;
    } catch (Exception $error) {
      return [
        'error' => true,
        'msg' => $error->getMessage()
      ];
    }
  }

  public function delete(Brand $brand)
  {
    try {
      $brand->delete();

      return [
        'msg' => 'Brand Deleted!'
      ];
    } catch (Exception $error) {
      return [
        'error' => true,
        'msg' => $error->getMessage()
      ];
    }
  }
}
