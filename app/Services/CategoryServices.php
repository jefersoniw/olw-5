<?php

namespace App\Services;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use Exception;

class CategoryServices
{
  public function list()
  {
    return Category::paginate();
  }
  public function store(CategoryStoreRequest $request)
  {
    try {
      $category = Category::create($request->validated());
      return $category;
    } catch (Exception $error) {
      return [
        'error' => true,
        'msg' => $error->getMessage()
      ];
    }
  }
  public function update(CategoryUpdateRequest $request, Category $category)
  {
    try {
      $category->update($request->validated());
      return $category;
    } catch (Exception $error) {
      return [
        'error' => true,
        'msg' => $error->getMessage()
      ];
    }
  }
  public function delete(Category $category)
  {
    try {
      $category->delete();

      return [
        'msg' => 'Category Deleted!'
      ];
    } catch (Exception $error) {
      return [
        'error' => true,
        'msg' => $error->getMessage()
      ];
    }
  }
}
