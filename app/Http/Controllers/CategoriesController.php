<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
class CategoriesController extends Controller
{
    public function index(Request $request)
    {
        if($request->session()->get('user') == null){
            return redirect('login');
        }
        $categories=Categories::paginate(20);
        return view('categories.index', compact('categories'));
        
    }

     public function create(Request $request)
    {
        if($request->session()->get('user') == null){
            return redirect('login');
        }
        $parents=Categories::where('parent_id', 0)->get();
        return view('categories.create', compact('parents'));
    }

    public function store(Request $request)
    {
        $categories=New Categories();
        $categories->title=$request->title;
        $categories->parent_id=$request->parent_id;
        if($request->file('icon')==null)
        {
            return back()->with("error", "Mising image!");
        }
        $photo=$request->file('icon');
        $name=time().'.'.$photo->getClientOriginalExtension();
        $path=public_path('/images');
        $photo->move($path, $name);
        $categories->icon=$name;
        $categories->save();
        return redirect('/categories');
    }

    public function show(Request $request, $id)
    {
        if($request->session()->get('user') == null){
            return redirect('login');
        }
       $categories=Categories::where('parent_id', $id)->get();
        return view('categories.index', compact('categories'));
    }

    public function edit(Request $request, $id)
    {
        if($request->session()->get('user') == null){
            return redirect('login');
        }
        $parents=Categories::where('parent_id', 0)->get();
        $categories=Categories::find($id);
        return view('categories.edit', compact('categories','parents'));
    }

    public function update(Request $request, $id)
    {
        $categories=Categories::find($id);
        $categories->title=$request->title;
        $categories->parent_id=$request->parent_id;
        if($request->file('icon'))
        {
            $photo=$request->file('icon');
            $name=time().'.'.$photo->getClientOriginalExtension();
            $path=public_path('/images');
            $photo->move($path, $name);
            $categories->icon=$name;
        }
        $categories->update();
        return redirect('/categories');

    }

    public function destroy(Request $request, $id)
    {
        if($request->session()->get('user') == null){
            return redirect('login');
        }
        $categories=Categories::find($id);
        $categories->delete();
        return redirect('/categories');
       
    }
}
