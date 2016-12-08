<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Form_creator_model;
use App\Form_question_model;
use App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;

class Form_creator extends Controller {

    public function __construct() {
        if (Session::get('id') == '') {
            Redirect::to('admin')->send();
        }
        
        //apply permission for boces website
        if(Session::get('website_id') == 1){
            
        $this->middleware('auth');
        $this->middleware('permission:form-create', ['only' => ['create']]);
        $this->middleware('permission:form-edit',   ['only' => ['edit']]);
        $this->middleware('permission:form-list',   ['only' => ['show', 'index']]);
        $this->middleware('permission:form-delete',   ['only' => ['destroy']]);
        
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $location_data = get_location("contact", "Yes");

        //set all news
        $location_id = 0;

        // load the listing page 		
        return View('Form_creator.index', array('location_data' => $location_data, 'location_id' => $location_id));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        // load the create form 		
        return View('Form_creator.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //return filled form
        $request->flash();

        //Fetch form data
        $form_data = $request->all();

        //convert field type string to date
        $form_data['on_site_date'] = date('Y-m-d', strtotime($form_data['on_site_date']));
        $form_data['off_site_date'] = date('Y-m-d', strtotime($form_data['off_site_date']));

        //validation
        $rules = array(
            "form_name" => "required",
        );

        //validation check
        $validator = Validator::make($form_data, $rules);

        //if fails
        if ($validator->fails()) {
            return redirect('Form_creator/create')->withErrors($validator);
        } else {

            Form_creator_model::create($form_data);

            //redirect & message
            session()->flash('msg', 'Record Inserted Successfully');

            return redirect('Form_creator');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        // get the form_creator
        $form_creator = Form_creator_model::find($id);

        // show the edit form and pass the form_creator
        return View('Form_creator.edit')
                        ->with('form_creator', $form_creator);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //fetch post data
        $form_data = $request->except('_method', 'hidden_on_site_date', 'hidden_off_site_date', 'main_page');

        //convert field type string to date
        $form_data['on_site_date'] = date('Y-m-d', strtotime($form_data['on_site_date']));
        $form_data['off_site_date'] = date('Y-m-d', strtotime($form_data['off_site_date']));

        //validation
        $rules = array(
            "form_name" => "required"
        );

        //validation check
        $validator = Validator::make($form_data, $rules);

        //if fails
        if ($validator->fails()) {
            return redirect('Form_creator/' . $id . '/edit')->withErrors($validator);
        } else {

            //update form creator
            Form_creator_model::where('form_creator_id', $id)->update($form_data);

            // redirect
            Session::flash('msg', 'Form successfully updated!');

            return Redirect::to('Form_creator/' . $id . '/edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request) {
        //fetch form data
        $form_delete_data = $request->all();

        //fetch radio button value
        $form_delete = $form_delete_data['form_delete'];

        if ($form_delete == "Delete_question") {

            //delete questions
            $form_question = Form_question_model::where('form_creator_id', $id)->delete();

            //set success message
            Session::flash('msg', 'Record deleted successfully!');

            //redirect success
            return redirect::to('Form_creator');
        } elseif ($form_delete == "Delete_form_question") {

            //delete questions
            $form_question = Form_question_model::where('form_creator_id', $id)->delete();

            //delete if confirm 
            $form_creator = Form_creator_model::find($id);
            $form_creator->delete();

            //set success message
            Session::flash('msg', 'Record deleted successfully!');

            //redirect success
            return redirect::to('Form_creator');
        } else {

            //set failer message
            Session::flash('msg', 'Please try again!');

            //redirect failure
            return redirect::to('Form_creator');
        }
    }

    /*
     * load the delete view page
     * @Chaitali Darji
     */

    public function delete($id) {

        // load the delete view 		
        return View('Form_creator.delete', array('id' => $id));
    }

    /*
     * get data for listing of all forms
     * @ Chaitali Darji
     */

    public function getFormList() {

        //fetch sql data into arrays
        $data = DB::select(
                        DB::raw("SELECT form_creator.form_creator_id,form_creator.*, b.questions, c.submited "
                                . "FROM form_creator left outer join (SELECT form_creator_id, count(*) as questions "
                                . "FROM form_questions group by form_questions.form_creator_id)b "
                                . "ON form_creator.form_creator_id = b.form_creator_id left outer join "
                                . "(SELECT form_creator_id, count(*) as submited FROM form_submit group by form_creator_id)c "
                                . "ON form_creator.form_creator_id = c.form_creator_id order by form_creator.form_creator_id ")
        );

        header("Content-type: application/json");
        echo "{\"data\":" . json_encode($data) . "}";
    }

    /*
     * get data for edit form creator limit
     * @chaitali Darji
     */

    public function edit_limit($id) {
        // get the form data
        $form_creator_limit = Form_creator_model::find($id);

        // show the edit form and pass the form_creator
        return View('Form_creator.edit_limit')
                        ->with('form_creator_limit', $form_creator_limit);
    }

    /*
     * Update the specified resource of form creator limit
     * @chaitali Darji
     */

    public function update_limit($id, Request $request) {

        $form_creator_data = $request->except('_method');

        $rules = array(
            'form_limit' => 'required'
        );

        //check validation
        $validator = Validator::make($form_creator_data, $rules);

        //set failer message
        Session::flash('msg', 'Please try again!');

        // if validation fails
        if ($validator->fails()) {
            return Redirect::to('Form_creator_update_limit/' . $id)
                            ->withErrors($validator);
        } else {

            //update form creator
            Form_creator_model::where('form_creator_id', $id)->update($form_creator_data);

            // redirect
            Session::flash('msg', 'Form Limit successfully updated!');

            return Redirect::to('Form_creator_update_limit/' . $id)
                            ->withErrors($validator);
        }
    }

}
