<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Categories;
use Session;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user=$request->session()->get('user');
        if($user){
        $products=Products::paginate(20);
      return view('products.index', compact('products'));
    }
    else{
        return redirect('login');
    }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       $user=$request->session()->get('user');
       if($user){
        $categories=Categories::all();
        return view('products.create', compact('categories'));
       }
       else{
           return redirect('login');
       }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $products=New Products();
        $products->name=$request->name;
        $products->price=$request->price;
        $products->category_id=$request->category_id;
        if($request->file('image')==null)
        {
            return back()->with("error", "Mising image!");
        }
        $photo=$request->file('image');
        $name=time().'.'.$photo->getClientOriginalExtension();
        $path=public_path('/images');
        $photo->move($path, $name);
        $products->image=$name;
        $products->save();
        return redirect('/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Products $products,$id)
    {
        if($request->session()->get('user') == null){
            return redirect('login');
        }
        $item=Products::find($id);
        return view('products.show',compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Products $products,$id)
    {
        if($request->session()->get('user') == null){
            return redirect('login');
        }
        $categories=Categories::all();
        $products=Products::find($id);
        return view('products.edit', compact('categories', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Products $products, $id)
    {
        $products=Products::find($id);
        $products->name=$request->name;
        $products->price=$request->price;
        $products->category_id=$request->category_id;
        if($request->file('image'))
        {
            $photo=$request->file('image');
            $name=time().'.'.$photo->getClientOriginalExtension();
            $path=public_path('/images');
            $photo->move($path, $name);
            $products->image=$name;
        }
       
        $products->update();
        return redirect('/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Products $products,$id)
    {
        if($request->session()->get('user') == null){
            return redirect('login');
        }
        $product=Products::find($id);
        $product->delete();
        return redirect('/products');
    
    }
}
