<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        $brands = Brand::all();
        $brands = Brand::paginate(5);
        return view('admin.brands.index', ['brands' => $brands]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100|min:5|unique:brands,name',
            'description' => ['required']
        ]);
        $brand = new Brand;
        $brand->name = $request->name;
        $brand->description = $request->description;
        $brand->save();
        return redirect()->route('brands.index')->with('success', 'Brand created!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        return view('admin.brands.show', ['brands' => $brand]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', ['brand' => $brand]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $brand->update([
            'name' => $request->name,
            'description' => $request->description
        ]);
        return redirect()->route('brands.index')->with('success', 'Brand updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->route('brands.index')->with('success', 'Move to trash list!');
    }

    public function trashed()   {
        $brands = Brand::onlyTrashed()->paginate();
        $title = "All Trashed Brands";
        return view('admin.brands.trashed', compact('title', 'brands'));
    }

    public function restore($id)    {
        Brand::withTrashed()
            ->where('id', $id)
            ->restore();
        return redirect(route('brands.trashed'))->with('success', 'Brand restored successfully!');
    }

    public function force($id)   {
        $brand = Brand::withTrashed()->where('id', $id)->first();
        $brand->forceDelete();
        return redirect()->route('brands.index')->with("success", "Brand deleted successfully!");
    }
}
