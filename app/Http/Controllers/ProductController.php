<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_products = Product::with(['variants'])
            ->get();
        return  view('product.index', compact('all_products'));
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
        $products = Product::get();
        $variant = ProductVariant::find($id);
        $variances = ProductVariant::get();
//        dd($variance);
        return view('product.show', compact('variant', 'products', 'variances'));
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
            return redirect()->route('product.index')->with('success', 'product  deleted Successfully');
        } catch (\exception $e) {
            return $e->getMessage();
        }
    }
}
