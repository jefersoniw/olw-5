<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandStoreRequest;
use App\Http\Requests\BrandUpdateRequest;
use App\Models\Brand;
use App\Services\BrandServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BrandController extends Controller
{

    public function __construct(protected BrandServices $brandServices)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        Gate::authorize('viewAny', Brand::class);
        return response()->json($this->brandServices->list());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandStoreRequest $request): JsonResponse
    {
        Gate::authorize('create', Brand::class);
        return response()->json($this->brandServices->store($request));
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand): JsonResponse
    {
        Gate::authorize('view', $brand);
        return response()->json($brand);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandUpdateRequest $request, Brand $brand): JsonResponse
    {
        Gate::authorize('update', $brand);
        return response()->json($this->brandServices->update($request, $brand));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        Gate::authorize('delete', $brand);
        return response()->json($this->brandServices->delete($brand));
    }
}
