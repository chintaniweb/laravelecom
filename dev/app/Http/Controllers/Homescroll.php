<?php

namespace App\Http\Controllers;

use Request;
use DB;
use App\Homescroll_model;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Session;

class Homescroll extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get data from newsletter table & apply pagination 
        $data = DB::table('home_scroll')->paginate(10);
       
        //return list
        return view('Homescroll/list', ['data' => $data]);
    }
    
    /**
     * Get json Response of content page
     */
    public function getHomeScrollList() {
        
        
        //fetch sql data into arrays
        $data = DB::table('home_scroll')->get();
        //$str = $this->db->last_query();  echo $str;exit;
        header("Content-type: application/json"); 
	echo "{\"data\":" .json_encode($data). "}";
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //request all record 
            $data = Request::all();
            //print_r($input);exit;
        //if the insert has returned true then we show the flash message
        if (Location_model::create($data)) {
        
        header("Content-type: application/json"); 
	echo "{\"data\":" .json_encode($data). "}";
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
    public function destroy($id)
    {
        //
    }
}
