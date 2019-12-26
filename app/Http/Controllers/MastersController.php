<?php

namespace App\Http\Controllers;

use App\Masters;
use Illuminate\Http\Request;

class MastersController extends Controller
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
        $do = $request->get('do');
        $filterName = $request->get('name');
        
        $data = Masters::orderBy('id', 'asc');
        
        if ($do == 'order') {
            $data->where('type', 'orderType');

            if ($request->has('name')){
                if (!empty($filterName)) {
                    $data->where('value', 'like', '%'.$filterName.'%');
                }
            }
    
            $datas = $data->paginate(10);
            
            return view("masters.order.index", [ 'datas' => $datas ]);
        } 
        elseif ($do == 'payment') {
            $data->where('type', 'paymentType');

            if ($request->has('name')){
                if (!empty($filterName)) {
                    $data->where('value', 'like', '%'.$filterName.'%');
                }
            }
    
            $datas = $data->paginate(10);
            
            return view("masters.payment.index", [ 'datas' => $datas ]);
        } 
        else {
            return view("masters.index");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type = NULL)
    {
        if ($type == 'order') {
            return view("masters.order.form");
        } 
        elseif ($type == 'payment') {
            return view("masters.payment.form");
        } 
        else {
            return view("masters.index");
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
        $newData = new Masters; 
        $type = $request->get('type');
        
        if ($type == 'orderType') {
            $request->validate([
                'name' => 'bail|required|max:255',
                'komisi' => 'required|max:255',
            ]);
            
            $newData->value = $request->get('name');
            $newData->extra = $request->get('komisi');
            $newData->type = $request->get('type');
            $newData->created_by = \Auth::user()->id;
    
            $newData->save();
    
            return redirect()->route('masters.index', ['do' => 'order'])->with('status', 'Data successfully created');
        } 
        elseif ($type == 'paymentType') {
            $request->validate([
                'name' => 'bail|required|max:255',
            ]);
            
            $newData->value = $request->get('name');
            $newData->type = $request->get('type');
            $newData->created_by = \Auth::user()->id;
    
            $newData->save();
    
            return redirect()->route('masters.index', ['do' => 'payment'])->with('status', 'Data successfully created');
        }
        else {
            return redirect()->route('masters.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Masters  $masters
     * @return \Illuminate\Http\Response
     */
    public function show($id = NULL)
    {
        // no thing
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Masters  $masters
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $type = $request->get('do');
        
        $data = Masters::findOrFail($id);
        
        if ($type == 'order') {
            return view('masters.order.form', ['data' => $data]);
        } 
        elseif ($type == 'payment') {
            return view('masters.payment.form', ['data' => $data]);
        } 
        else {
            return view("masters.index");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Masters  $masters
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $type = $request->get('type');
        $data = Masters::findOrFail($id);
        
        if ($type == 'orderType') {
            $request->validate([
                'name' => 'bail|required|max:255',
                'komisi' => 'required|max:255',
            ]);
            
            $data->value = $request->get('name');
            $data->extra = $request->get('komisi');
            $data->updated_by = \Auth::user()->id;

            $data->save();
    
            return redirect()->route('masters.index', ['do' => 'order'])->with('status', 'Data successfully updated');
        } 
        elseif ($type == 'paymentType') {
            $request->validate([
                'name' => 'bail|required|max:255',
            ]);

            $data->value = $request->get('name');
            $data->updated_by = \Auth::user()->id;
    
            $data->save();
    
            return redirect()->route('masters.index', ['do' => 'payment'])->with('status', 'Data successfully updated');
        }
        else {
            return redirect()->route('masters.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Masters  $masters
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $type = $request->get('type');

        $data = Masters::findOrFail($id);

        $data->deleted_by = \Auth::user()->id;
        $data->save();

        $data->delete();

        if ($type) {
            return redirect()->route('masters.index', ['do' => $type])->with('status', 'Data successfully delete');
        }
        else {
            return redirect()->route('masters.index');
        }
    }
}
