<?php

namespace App\Http\Controllers;

use App\Catagory;
use Illuminate\Http\Request;

use App\Http\Requests\CreateCatagoryRequest;
use App\Http\Requests\Catagories\UpdateCatagories;

class CatagoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('catagories.index')->with('catagories', Catagory::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('catagories.create'); //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCatagoryRequest $request)
    {
        Catagory::create([
            'name' => $request->name

        ]);

        session()->flash('success', 'Catagory created successfully');

        return redirect(route('catagories.index'));
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
    public function edit(Catagory $catagory)
    {
        return view('catagories.create')->with('catagory', $catagory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCatagories $request, Catagory $catagory)
    {
        $catagory->name = $request->name;

        $catagory->save();

        session()->flash('success', 'Catagory updated successfully');

        return redirect(route('catagories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Catagory $catagory)
    {
        if ($catagory->post->count() > 0) {
            session()->flash('error', 'Catagory can not be deleted because it has some posts');
            return redirect()->back();
        }


        $catagory->delete();

        session()->flash('success', 'Catagory Deleted Successfully');

        return redirect(route('catagories.index'));
    }
}
