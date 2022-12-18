<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offers;

class OffersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->session()->get('user') == null){
            return redirect('login');
        }
        $offers=Offers::paginate(20);
        return view('offers.index', compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->session()->get('user') == null){
            return redirect('login');
        }
        return view('offers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rasm= New Offers();
        if ($request->file('offer_img')==null) {
            return back()->with('error', 'Missing image!');
        }
        $photo=$request->file('offer_img');
        $name = $photo->getClientOriginalExtension();
        $photoname=time().'.'.$name;
        $path = public_path('/images');  
        $photo->move($path, $photoname);
        $rasm->image=$photoname;
        $rasm->save();
        return redirect('/offers');
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
        //
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
    public function destroy(Request $request, $id)
    {
        if($request->session()->get('user') == null){
            return redirect('login');
        }
        $offer=Offers::find($id)->first();
        $offer->delete();
        return redirect('/offers');
        
    }
}
