<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use App\Services\CategoryServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    public function __construct(protected CategoryServices $categoryServices)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        Gate::authorize('viewAny', Category::class);
        return response()->json($this->categoryServices->list());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request): JsonResponse
    {
        Gate::authorize('create', Category::class);
        return response()->json($this->categoryServices->store($request));
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): JsonResponse
    {
        Gate::authorize('view', $category);
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        Gate::authorize('update', $category);
        return response()->json($this->categoryServices->update($request, $category));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        Gate::authorize('delete', $category);
        return response()->json($this->categoryServices->delete($category));
    }
}
