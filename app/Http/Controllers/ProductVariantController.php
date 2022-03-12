<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $product =  Product::with('variants')
            ->where('id', $id)
            ->first();
        return  view('product.variants.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::get();
        return  view('product.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'product_id' => ['required'],
            'size' => ['required'],
            'price' => ['required', 'integer'],
        ]);

        try{
            $data = new ProductVariant();
            $data->product_id = $request->product_id;
            $data->gender = $request->gender;
            $data->size = $request->size;
            $data->color = $request->color;
            $data->price = $request->price;
            $data->save();

            return redirect()->route('product.index')->with('success', 'Product variant Added successfully');

        }catch (\Exception $e){
            return $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::with(['variants'])
            ->where('id', $id)
            ->first();
        if (!$product) {
            return redirect()->to('dashboard/product');
        }
        $variances = ProductVariant::get();
//        dd($variances);
        return view('product.show', compact('product', 'variances'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $product = Product::find($id);
            if (!$product) {
                return response()->json(['success' => false, 'message' => 'Product not found !']);
            }
            $product->product_name = $request->product_name;
            if ($product->save()) {
                return response()->json(['success' => true, 'message' => 'Product has been updated successfully !']);
            }
            return response()->json(['success' => false, 'message' => 'Product update failed !']);

        } catch(\exception $e) {
//            return response()->json(['success' => false, 'message' => 'Product update failed !']);
            return $e;
        }
        return $request->all();
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {
            ProductVariant::destroy($id);
            return response()->json(['success' => true, 'message' => 'Variance has been deleted successfully !']);
        }
        catch (\exception $e) {
            return $e->getMessage();
        }
    }



}
