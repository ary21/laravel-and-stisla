<?php

namespace App\Http\Controllers;

use App\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filterName = $request->get('name');
        
        $data = Categories::orderBy('id', 'asc');
        
        if ($request->has('name')){
            if (!empty($filterName)) {
                $data->where('name', 'like', '%'.$filterName.'%');
            }
        }

        $datas = $data->paginate(10);
        
        return view("categories.index", [ 'datas' => $datas ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("categories.form");
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
            'name' => 'bail|required|unique:categories|max:255',
        ]);
        
        $newData = new Categories;

        $newData->name = $request->get('name');
        $newData->created_by = \Auth::user()->id;

        $newData->save();

        return redirect()->route('categories.index')->with('status', 'Data successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Categories::findOrFail($id);
        
        return view('categories.show', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Categories::findOrFail($id);
        
        return view('categories.form', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'bail|required|unique:categories|max:255',
        ]);

        $data = Categories::findOrFail($id);
        
        $data->name = $request->get('name');
        $data->updated_by = \Auth::user()->id;

        $data->save();

        return redirect()->route('categories.index')->with('status', 'Data succesfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Categories::findOrFail($id);

        $data->deleted_by = \Auth::user()->id;

        $data->save();

        $data->delete();

        return redirect()->route('categories.index')->with('status', 'Data successfully delete');
    }
}
