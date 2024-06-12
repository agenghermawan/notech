<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(){
        $dataItem = Product::all();
        return view('welcome')->with([
            'dataItem' => $dataItem
        ]);
    }

    public function store(ProductRequest $request)
    {
        $getNameImage = $request->file('photo')->getClientOriginalName();
        $data = $request->all();
        $data['photo'] =  $request->file('photo')->storeAs('assets/item-image', $getNameImage, 'public');

        $store = Product::create($data);
        return redirect()->route('product.index');
    }

    public function destroy($id) {
        $delete = Product::where('id', $id)->first();
        $delete->delete();

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:100',
            'sale_price' => 'required|numeric',
            'purchase_price' => 'required|numeric',
            'stock' => 'required|integer|min:1',
        ], [
            'name.required' => 'Item name is required',
            'photo.image' => 'Item photo must be an image',
            'photo.mimes' => 'Item photo must be a jpeg, png, jpg',
            'photo.max' => 'Item photo must be less than 100KB',
            'sale_price.required' => 'Sale price is required',
            'purchase_price.required' => 'Purchase price is required',
            'stock.required' => 'Stock is required',
            'name.unique' => 'Item name must be unique',
            'sale_price.numeric' => 'Sale price must be a number',
            'purchase_price.numeric' => 'Purchase price must be a number',
            'stock.integer' => 'Stock must be an integer',
            'stock.min' => 'Stock must be at least 1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $product = Product::findOrFail($id);

        $product->name = $request->input('name');
        $product->purchase_price = $request->input('purchase_price');
        $product->sale_price = $request->input('sale_price');
        $product->stock = $request->input('stock');


        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $getNameImage = $request->file('photo')->getClientOriginalName();
            $photoPath=  $request->file('photo')->storeAs('assets/item-image', $getNameImage, 'public');
            $product->photo = $photoPath;
        }

        $product->save();
        return redirect()->back();
    }
}
