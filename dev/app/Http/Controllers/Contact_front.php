<?php
/** @access             :   public
* @description          :   Contact-feedback - Front-end
* @author               :   Chaitali D. <chaitali@iwebsquare.com> 
* @created date         :   26th Sept, 2016
* @Last updated By      :   Chaitali D.
* @version              :   0.1
*/
namespace App\Http\Controllers;

use Mail;
use Session;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Contact_front_model;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class Contact_front extends Controller {
 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //Get Contact Locations 
        $location_data = get_location("contact", "Yes");

        //load view
        return view('contact_feedback', ['location_data' => $location_data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        
        //create the validation rules 
        $rules = array(
            'name' => 'required',
            'email' => 'required|email'
        );

        //validate against the inputs from our form
        $validator = Validator::make($request->all(), $rules);

        //check if the validator failed 
        if ($validator->fails()) {

            //get the error messages from the validator
            $messages = $validator->messages();

            //failure flash data
            Session::flash('message', 'please try again!');

            //redirect to routes
            return Redirect::to('Contact_feedback/Contact')->withErrors($validator);
        } 
        else {

            //fetch all data from contact-form
            $contact_data = $request->all();
            //print_r($contact_data);exit;
            $name           = $contact_data['name'];
            $email          = $contact_data['email'];
            $subject        = "Contact - feedback";
            $phone          = $contact_data['phone'];
            $comment        = $contact_data['comment'];
            $location_id    = $contact_data['location_id'];
            $location       = ""; //set blank

            //convert array into string
            if (isset($location_id)) {
                $location = implode(",",$location_id);
            }
            
            //add string in original
            $contact_data['location_id'] = $location;

            //insert contact detail in databse
            $contact_create = Contact_front_model::create($contact_data);
            
            //if inserted
            if($contact_create){
                $data['name'] = $name;
                $data['comment'] = $comment;
              //print_r($data);exit;
                //Testing of mail send
               
                Mail::send(['text' => 'mail'], $data, function($message) use ($email, $name, $subject, $comment) {
                    $message->to($email, $name)->subject($subject);
                    $message->from('dev.iwebquare@gmail.com', 'Admin');
                });
                
                //Mail send to Admin
//                Mail::send(['text' => 'mail'], $data, function($message) use ($email, $name, $subject, $comment) {
//                    $message->to('dev.iwebquare@gmail.com', 'Admin')->subject($subject);
//                    $message->from($email, $name);
//                });

                //success flash data
                Session::flash('message', 'Your mail has been sent successfully!');

                //redirect to routes
                return redirect('Contact_feedback/Contact');
            }
            else{
                //failure flash data
                Session::flash('message', 'please try again!');

                //redirect to routes
                return Redirect::to('Contact_feedback/Contact');
            }
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
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

}
