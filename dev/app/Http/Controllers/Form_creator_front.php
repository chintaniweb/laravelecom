<?php
/**
 * @access          :   public
 * @description     :   Form Creator Front Module
 * @author          :   Swati D. <chaitali@iwebsquare.com>
 * @created date    :   21st Sept, 2016
 * @updated date    :   23rd Sept, 2016
 * @created By      :   Swati D.
 * @version         :   0.1
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Form_creator_front_model;
use App\Form_answer_model;
use Illuminate\Support\Facades\Redirect;

class Form_creator_front extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //get data from model
        $data = Form_creator_front_model::where('form_creator_id',$id)
                                        ->orderBy('form_questions_id')->get();
        
        //load view
        return view('form_creator_front', ['data' => $data,'id' => $id]);
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
    public function store($id,Request $request)
    {
        //get all data into form
        $answer_data = $request->all();
        
        //fetch for creaotr id
        $answer_data['form_creator_id'] =   $id;
        
        //get answer from array
        $answers[]=  $answer_data['question'];
        
        foreach ($answers[0] as $k=> $v)
        {
            //get form question id
            $answer_data['form_questions_id']   =   $k;
            
            //for checkbox
            if(is_array($v)){
                $answer_data['answer']  = implode(',',$v);
            } 
            else {
                $answer_data['answer'] = $v;
            }
            //insert answer
            $insert = Form_answer_model::create($answer_data);
        }   
        
        if($insert){
            
            //redirect & message
            session()->flash('msg','Form Submited successfully');
            
            return redirect('Form_creator_front/'.$id);
        }
        else{
             //set failure message
            Session::flash('msg', 'Please try again!');
            
            return redirect('Form_creator_front/'.$id);
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
