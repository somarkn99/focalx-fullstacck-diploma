<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::all();

        return response()->json([
            'status' => 'success',
            'brands' => $brands
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request)
    {
        try {
            DB::beginTransaction();

            $brand = Brand::create([
                'name' => $request->name,
               'slogan' => $request->slogan,
            ]);

            DB::commit();

            return response()->json([
               'status' =>'success',
                'brand' => $brand
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            Log::error($th);
            return response()->json([
                'status' =>'error',
             ],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        return response()->json([
            'status' => 'success',
            'brands' => $brand
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'slogan' =>'nullable|string|max:255',
        ]);

        $newData = [];

        if (isset($request->name)) {
            $newData['name'] = $request->name;
        }

        if (isset($request->slogan)) {
            $newData['slogan'] = $request->slogan;
        }

        $brand->update($newData);

        return response()->json([
           'status' =>'success',
            'brand' => $brand
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return response()->json([
            'status' =>'success',
         ]);
    }
}
