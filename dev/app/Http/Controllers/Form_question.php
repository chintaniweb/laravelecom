<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Form_question_model;
use App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;

class Form_question extends Controller {

    public function __construct() {
        if (Session::get('id') == '') {
            Redirect::to('admin')->send();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id) {

        //get form creator id
        $form_creator_id = $id;

        // load the create form 		
        return View('Form_question.index', array('form_creator_id' => $form_creator_id));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id) {

        // load the create form 		
        return View('Form_question.create', array('id' => $id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $question_data = $request->all();

        $id = $question_data['form_creator_id'];

        $file_name = $request->file('question_file');

        $mctext = preg_replace("/\r\n/", ",", $question_data['multiplechoicetext']);

        $rules = array(
            'question' => 'required'
        );

        //check validation
        $validator = Validator::make($question_data, $rules);

        // if validation fails
        if ($validator->fails()) {
            return Redirect::to('Form_question/create/' . $id)
                            ->withErrors($validator);
        } else {

            if ($file_name != "") {

                //upload file if have
                $path = "resources/views/Form_question/Form_question_files/";

                //if directory is not available then create the directory
                if (!is_dir($path)) {
                    //create the directory and give permission to create
                    mkdir($path, 0777, TRUE);
                }

                //move file into folder
                $image_name = do_upload($file_name, $path);

                $question_data['question_file'] = $image_name;
            }
            $form_question_create = Form_question_model::create($question_data);

            if ($form_question_create) {

                //success flash data
                Session::flash('message', 'Question Created Successfully!');
            } else {
                //failure flash data
                Session::flash('message', 'please try again!');
            }

            //redirect to listing
            return redirect('Form_question/create/' . $id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($que_id, $id) {

        $form_questions = Form_question_model::find($que_id);

        // show the edit form and pass the Doorway
        return View('Form_question.edit')
                        ->with('form_questions', $form_questions)->with('id', $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($que_id, Request $request) {

        $questions_data = $request->except('_method');

        //print_r($question_data);exit;

        $mctext = preg_replace("/\r\n/", ",", $questions_data['multiplechoicetext']);

        $id = $questions_data['form_creator_id'];

        $file_name = $request->file('question_file');

        $rules = array(
            'question' => 'required'
        );

        //check validation
        $validator = Validator::make($questions_data, $rules);

        // if validation fails
        if ($validator->fails()) {
            return Redirect::to('Form_question/' . $que_id . '/edit/form_id/' . $id)
                            ->withErrors($validator);
        } else {

            if ($file_name != "") {

                //upload file if have
                $path = "resources/views/Form_question/Form_question_files/";

                //if directory is not available then create the directory
                if (!is_dir($path)) {
                    //create the directory and give permission to create
                    mkdir($path, 0777, TRUE);
                }

                //move file into folder
                $image_name = do_upload($file_name, $path);

                $questions_data['question_file'] = $image_name;
            }

            //print_r($questions_data);exit;
            // echo $que_id;exit;
            $form_question_update = Form_question_model::where('form_questions_id', $que_id)->update($questions_data);

            if ($form_question_update) {

                //success flash data
                Session::flash('message', 'Question Updated Successfully!');
            } else {
                //failure flash data
                Session::flash('message', 'please try again!');
            }

            //redirect to listing
            return redirect('Form_question/' . $que_id . '/edit/form_id/' . $id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    /*
     * get Question list for listing
     * by creator id
     */

    public function getQuestionList($id) {

        //fetch sql data into arrays
        $data = DB::select(
                        DB::raw(" SELECT * FROM `form_questions` WHERE "
                                . "form_creator_id = '" . $id . "' ORDER BY `form_questions_id`")
        );

        //$str = $this->db->last_query();  echo $str;exit;
        header("Content-type: application/json");
        echo "{\"data\":" . json_encode($data) . "}";
    }

    /**
     * Remove the image from folder and storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_image($name, $id, $creator_id) {

        $picture_path = 'resources/views/Form_question/Form_question_files/';

        $delete_file = $picture_path . $name;

        //delete image from folder
        unlink($delete_file);

        $questions_data = array('question_file' => '');

        $form_question_update = Form_question_model::where('form_questions_id', $id)->update($questions_data);

        //redirect
        return redirect('Form_question/' . $id . '/edit/form_id/' . $creator_id);
    }

}
