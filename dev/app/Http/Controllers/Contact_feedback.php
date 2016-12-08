<?php

/** @access             :   public
 * @description          :   Contact-feedback - Admin level
 * @author               :   Chaitali D. <chaitali@iwebsquare.com> 
 * @created date         :   27th Sept, 2016
 * @updated date         :   4th Oct, 2016
 * @Last updated By      :   Swati D.
 * @version              :   0.1
 */

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;
use DB;
use Session;
use Response;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Contact_feedback_model;

class Contact_feedback extends Controller {

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
    public function index() {
        $month = "";
        $year = "";
        $feedback_status = "";
        //get contact data
        $data = $data = DB::select(
                        DB::raw(" SELECT contact_id, contact_id as contact_id_tmp,_token ,name, comment,email,phone,"
                                . "ip_address,location_id,feedback_status,created_at FROM `contact_feedback` "
                                . "where feedback_status LIKE 'New'"));

        //get location data
        $location_data = get_location("contact", "Yes");

        //load view
        return view('Contact-feedback/index', ['data' => $data, 'location_data' => $location_data, 'month' => $month,
            'year' => $year, 'feedback_status' => $feedback_status]);
    }

    /*
     * Display a listing of the resource.
     * for method post
     * @Chaitali Darji
     */

    public function contact_list(Request $request) {
        //fetch all post data
        $contact_data = Request::all();

        //fetch month
        $month = $contact_data['theMonth'];

        //fetch year
        $year = $contact_data['theYear'];

        //fetch feedback status
        $status = $contact_data['feedback_status'];
        $feedback_status = $contact_data['feedback_status'];

        $searth_str = "";

        if ($status != "")
            $searth_str = " and feedback_status LIKE '%{$status}'";

        if ($year != "")
            $searth_str = " and YEAR(created_at) = $year";

        if ($month != "")
            $searth_str = " and MONTH(created_at) = $month";

        if (@$searth_str != "") {

            //get contact data 
            $data = $data = DB::select(
                            DB::raw(" SELECT contact_id, contact_id as contact_id_tmp, name, comment,email,"
                                    . "phone,ip_address,location_id,feedback_status,created_at FROM `contact_feedback`"
                                    . " where 1=1 $searth_str"));
            if (count($data) == 0) {

                //get contact data
                $data = $data = DB::select(
                                DB::raw(" SELECT contact_id, contact_id as contact_id_tmp,_token ,name, comment,email,phone,"
                                        . "ip_address,location_id,feedback_status,created_at FROM `contact_feedback` "
                                        . "where feedback_status LIKE 'New'"));
            }
        } else {

            //get contact data
            $data = $data = DB::select(
                            DB::raw(" SELECT contact_id, contact_id as contact_id_tmp,_token ,name, comment,email,phone,"
                                    . "ip_address,location_id,feedback_status,created_at FROM `contact_feedback` "
                                    . "where feedback_status LIKE 'New'"));
        }

        //get location data
        $location_data = get_location("contact", "Yes");

        //load view
        return view('Contact-feedback/index', ['data' => $data, 'location_data' => $location_data, 'month' => $month,
            'year' => $year, 'feedback_status' => $feedback_status]);
    }

    public function download_feedback() {

        //fetch column names in list
        $data = DB::getSchemaBuilder()->getColumnListing('contact_feedback');

        $report = array();
        $month = array();
        $year = array();
        //print_r($data);exit;
        //load the view
        return view('Contact-feedback/create_download_feedback', ['data' => $data, '$report' => $report, 'month' => $month, 'year' => $year]);
    }

    public function get_download(Request $request) {

        //fetch all data from contact feedback table
        Contact_feedback_model::all();

        //fetch month
        $month = Request::get('month');

        //fetch year
        $year = Request::get('year');

        $table = DB::select(DB::raw(" SELECT `contact_id`, `_token`,`name`,"
                                . " `comment`, `email`, `phone`, `ip_address`, `location_id`,"
                                . " `feedback_status`, `created_at`,`updated_at`, `respond_location_id`, "
                                . "`respond_feedback`, `forward_location_id`, `forward_comment`, "
                                . "`forward_email`, `forward_email_subject` FROM `contact_feedback`"
                                . " WHERE month(created_at) = '$month' AND year(created_at) = $year"));
        //print_r($table);exit;
        // Now generate the CSV file
        $filename = 'Contact Feedback_' . date('d-m-Y') . '.csv';

        //open file
        $handle = fopen($filename, 'w+');

        //csv file containing the given fields fetch from table
        fputcsv($handle, array('contact_id', '_token', 'name', 'comment', 'email', 'phone', 'ip_address',
            'location_id', 'feedback_status', 'created_at', 'updated_at', 'respond_location_id', 'respond_feedback',
            'forward_location_id', 'forward_comment', 'forward_email', 'forward_email_subject'));

        //csv file containing the given data fetch from table
        foreach ($table as $row) {
            fputcsv($handle, array($row->contact_id, $row->_token, $row->name, $row->comment, $row->email, $row->phone,
                $row->ip_address, $row->location_id, $row->feedback_status, $row->created_at, $row->updated_at,
                $row->respond_location_id, $row->respond_feedback, $row->forward_location_id, $row->forward_comment,
                $row->forward_email, $row->forward_email_subject));
        }

        //close file
        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

        $name = 'Contact Feedback_' . date('d-m-Y') . '.csv';

        //return download 
        return Response::download($filename, $name, $headers);
    }

    /**
     * Show the form for editing the specified resource.
     * For respond data
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function respond($id) {

        //fetch data from contact_id
        $data = DB::table('contact_feedback')->where('contact_id', $id)->get();

        //get location data
        $location_data = get_location("contact", "Yes");

        /*         * ********SESSION DATA START************** */

        //check if session data exist
        if (Session::has('name')) {

            //fetch user name from session
            $user_name = Session::get('name');
        }
        //fetch single row of current session from users table
        $email = DB::table('users')->where('first_name', $user_name)->get();

        /*         * ********SESSION DATA END**************** */

        //load view
        return view('Contact-feedback/respond', ['data' => $data, 'location_data' => $location_data, 'email' => $email]);
    }

    /**
     * Update respond for the specified resource in storage.
     * Respond Update
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_respond(Request $request, $id) {

        //get data into form
        $input = Request::all();

        //fetch respond location id & set it as array
        $input['respond_location_id'] = array();

        //fetch respond location id
        $location = $input['respond_location_id'];

        //seperate respond location id by comma
        $respond_location_id = implode(',', $location);

        //fetch feedback respond
        $respond_feedback = $input['respond_feedback'];

        //set respond location id
        $input['respond_location_id'] = $respond_location_id;

        //sql query to update data
        $data = DB::table('contact_feedback')->where('contact_id', $id)->update($input);

        //check if data
        if ($data) {

            //success flash data
            Session::flash('message', 'Respond successfully');

            //redirect to update page
            return Redirect::to('Contact-feedback/respond/' . $id);
        } else {

            //Failure flash data
            Session::flash('message', 'please try again!');

            //redirect to update page
            return Redirect::to('Contact-feedback/respond/' . $id);
        }
    }

    /**
     * Show the form for editing the specified resource.
     * For forward data
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function forward($id) {

        //fetch data from contact_id
        $data = DB::table('contact_feedback')->where('contact_id', $id)->get();

        //get location data
        $location_data = get_location("contact", "Yes");

        /*         * ********SESSION DATA START************** */

        //check if session data exist
        if (Session::has('name')) {

            //fetch user name from session
            $user_name = Session::get('name');
        }
        //fetch single row of current session from users table
        $email = DB::table('users')->where('first_name', $user_name)->get();

        /*         * **********SESSION DATA END************* */

        //load view
        return view('Contact-feedback/forward', ['data' => $data, 'location_data' => $location_data, 'email' => $email]);
    }

    /*
     * Update forward for the specified resource in storage.
     * Forward Update
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update_forward(Request $request, $id) {

        //get data into form
        $input = Request::all();

        //fetch forward location id & set it to array
        $input['forward_location_id'] = array();

        //fetch forward location id
        $location = $input['forward_location_id'];

        //fetch forward location id & seperate by comma
        $forward_location_id = implode(',', $location);

        //fetch comment forwarded
        $forward_comment = $input['forward_comment'];

        //fetch email forwarded
        $forward_email = $input['forward_email'];

        //fetch email subject forwarded
        $forward_email_subject = $input['forward_email_subject'];

        //set respond location id
        $input['forward_location_id'] = $forward_location_id;

        //sql query to update data
        $data = DB::table('contact_feedback')->where('contact_id', $id)->update($input);

        //check if data
        if ($data) {

            //success flash data
            Session::flash('message', 'Forward successfully');

            //redirect to update page
            return Redirect::to('Contact-feedback/forward/' . $id);
        } else {

            //Failure flash data
            Session::flash('message', 'please try again!');

            //redirect to update page
            return Redirect::to('Contact-feedback/forward/' . $id);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
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
        //get location data
        $location_data = get_location("contact", "Yes");

        //fetch data from contect_id
        $data = DB::table('contact_feedback')
                ->where('contact_id', $id)
                ->get();

        //load view
        return view('Contact-feedback/edit', ['data' => $data, 'location_data' => $location_data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //auto fill form data when validation fails
        Request::flash();

        // create the validation rules 
        $rules = array(
            'email' => 'required|email',
        );

        //validate against the inputs from our form
        $validator = Validator::make(Request::all(), $rules);

        //check if the validator failed 
        if ($validator->fails()) {

            //get the error messages from the validator
            $messages = $validator->messages();

            //failure flash data
            Session::flash('message', 'please try again !');

            //redirect our user back to the form with the errors from the validator
            return Redirect::to('contact_feedback/edit/' . $id)->withErrors($validator);
        } else {

            //fetch all data into form
            $input = Request::all();

            //update query
            $update_result = DB::table('contact_feedback')
                    ->where('contact_id', $id)
                    ->update($input);

            if ($update_result) {

                //success flash data
                Session::flash('message', 'Contact-feedback Updated Successfully!');
            } else {

                //failure flash data
                Session::flash('message', 'please try again!');
            }

            //redirect to update page
            return Redirect::to('contact_feedback/edit/' . $id)->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //delete record
        DB::table('contact_feedback')
                ->where('contact_id', $id)
                ->delete();

        //success flash data
        Session::flash('message', 'Record Deleted Successfully!');

        //redirect to routes
        return redirect('contact-feedback');
    }

}
