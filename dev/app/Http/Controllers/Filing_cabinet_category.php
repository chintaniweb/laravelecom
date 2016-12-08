<?php

namespace App\Http\Controllers;

use Request;
use DB;
use App\Filing_cabinet_category_model;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Session;

class Filing_cabinet_category extends Controller {

    public function __construct() {
        if (Session::get('id') == '') {
            Redirect::to('admin')->send();
        }
        //apply permission for boces website
        if(Session::get('website_id') == 1){
            
        $this->middleware('auth');
        $this->middleware('permission:filling-cabinet-category-create', ['only' => ['create']]);
        $this->middleware('permission:filling-cabinet-category-edit',   ['only' => ['edit']]);
        $this->middleware('permission:filling-cabinet-category-list',   ['only' => ['show', 'index']]);
        $this->middleware('permission:filling-cabinet-category-delete',   ['only' => ['destroy']]);
        
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //load the view
        return view('Filing_cabinet/list_category');
    }

    public function getFilingCabinetCategoryList($id) {
        //echo "enter";
        // exit;
        //$id=Request::segment(3);
        if ($id != "") {
            //echo "enete to he if";
            //exit;

            $data = DB::select("SELECT filing_cabinet_category_id, parent_id, filing_cabinet_category_id as filing_cabinet_category_id_tmp,filing_cabinet_category_id as filing_cabinet_category_id_cat_tmp, category_name,category_sort FROM `filing_cabinet_category` where parent_id=$id");
        } else {
            //echo "enter to the else";
            //exit;
            $data = DB::select("SELECT filing_cabinet_category_id, parent_id, filing_cabinet_category_id as filing_cabinet_category_id_tmp,filing_cabinet_category_id as filing_cabinet_category_id_cat_tmp, category_name,category_sort FROM `filing_cabinet_category`");
        }

        //  echo "<pre>";
        // print_r($data);
        //exit;
        header("Content-type: application/json");
        echo "{\"data\":" . json_encode($data) . "}";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $id = 0;
        if ($id != "") {
            //echo "if";
            //exit;
            $data = DB::select("SELECT filing_cabinet_category_id, parent_id, filing_cabinet_category_id as filing_cabinet_category_id_tmp,filing_cabinet_category_id as filing_cabinet_category_id_cat_tmp, category_name,category_sort FROM `filing_cabinet_category` where parent_id=$id");
        } else {

            //echo "else";
            //exit;
            $data = DB::select("SELECT filing_cabinet_category_id, parent_id, filing_cabinet_category_id as filing_cabinet_category_id_tmp,filing_cabinet_category_id as filing_cabinet_category_id_cat_tmp, category_name,category_sort FROM `filing_cabinet_category`");
        }
        // echo "<pre>";

        $tree = $this->buildTree($data);
        //echo "<pre>";
        //print_r($tree);
        //exit;

        $tree_str = "<select name='parent_id' class=\"form-control\">\n";
        $tree_str .= '<option value="0">---- Select Page -----</option>';
        $tree_str .= $this->printTree($tree);
        $tree_str .="</select>";

        //store string of tree into one variable
        $page_tree = $tree_str;

        //echo "eneter to the create";
        return view('Filing_cabinet/create_category', ['page_tree' => $page_tree]);
    }

    /**
     * build Tree structure
     * @param array $data
     * @param type $parent
     * @return type
     */
    public function buildTree(Array $data, $parent = 0) {

        $tree = array();
        foreach ($data as $d) {
            if ($d->parent_id == $parent) {
                $children = $this->buildTree($data, $d->filing_cabinet_category_id);
                // set a trivial key
                if (!empty($children)) {
                    $d->_children = $children;
                }
                $tree[] = $d;
            }
        }
        return $tree;
    }

    /**
     * Print tree in string
     * @param type $tree
     * @param int $r
     * @param type $p
     */
    public function printTree($tree, $r = 0, $p = null, $parent_id = "") {

        static $str = "";
        $parent_id;
        foreach ($tree as $i => $t) {
            $dash = ($t->parent_id == 0) ? '' : str_repeat('-', $r) . ' ';
            $selected = ($parent_id == $t->filing_cabinet_category_id) ? ' selected ' : "";

            $str .= "<option $selected value=" . $t->filing_cabinet_category_id . ">" . $dash . $t->category_name . "</option>";
            //if($selected!=="") { echo $str; exit;}
            if ($t->parent_id == $p) {
                // reset $r
                $r = 0;
            }
            if (isset($t->_children)) {
                $this->printTree($t->_children, ++$r, $t->parent_id, $parent_id);
            }
        }

        return $str;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {


        //echo "enter to the store";
        //exit;
        $input = Request::all();

        //request for flashing the data on failed validation
        Request::flash();

        //set rules for validation
        $rules = array(
            'category_name' => 'required',
        );

        //make validation
        $validate = Validator::make(Request::all(), $rules);

        //check if validation
        if ($validate->fails()) {
            //echo "dfsf";exit;
            //set validation message
            $messages = $validate->messages();

            //show validation message & redirect
            return Redirect::to('Filing_cabinet_category/create')->withErrors($validate);
        } else {
            //request for flashing the data on failed validation
            // store
            Filing_cabinet_category_model::create($input);

            // redirect
            Session::flash('message', 'Record created successfully');
            return Redirect::to('Filing_cabinet/create');
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
        $category = array();

        $category = Filing_cabinet_category_model::find($id);

        //get parent id for selected into dropdown
        $parent_id = (count($category) > 0) ? $category->parent_id : "";

        $id = 0;
        if ($id != "") {
            //echo "if";
            //exit;
            $data = DB::select("SELECT filing_cabinet_category_id, parent_id, filing_cabinet_category_id as filing_cabinet_category_id_tmp,filing_cabinet_category_id as filing_cabinet_category_id_cat_tmp, category_name,category_sort FROM `filing_cabinet_category` where parent_id=$id");
        } else {

            //echo "else";
            //exit;
            $data = DB::select("SELECT filing_cabinet_category_id, parent_id, filing_cabinet_category_id as filing_cabinet_category_id_tmp,filing_cabinet_category_id as filing_cabinet_category_id_cat_tmp, category_name,category_sort FROM `filing_cabinet_category`");
        }

        // echo "<pre>";

        $tree = $this->buildTree($data);

        $tree_str = "<select name='parent_id' class=\"form-control\">\n";
        $tree_str .= '<option value="0">---- Select Page -----</option>';
        $tree_str .= $this->printTree($tree, '', '', $parent_id);
        $tree_str .="</select>";

        ////store string of tree into one variable
        $page_tree = $tree_str;

        return view('Filing_cabinet/edit_category', ['category' => $category, 'page_tree' => $page_tree]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    Public function update(Request $request, $id) {
        //echo "enter to the update";
        //exit;
        //fetch post data
        $filing_category_data = $request::except('_method');
        //echo "<pre>";
        //print_r($filing_category_data);
        //exit;
        //request for flashing the data on failed validation
        Request::flash();

        //set rules for validation
        $rules = array(
            'category_name' => 'required',
        );

        //make validation
        $validator = Validator::make(Request::all(), $rules);

        //check if validation
        if ($validator->fails()) {
            return Redirect::to('Filing_cabinet_category/' . $id . '/edit')
                            ->withErrors($validator);
        } else {
            //update doorway
            Filing_cabinet_category_model::where('filing_cabinet_category_id', $id)->update($filing_category_data);

            // redirect
            Session::flash('message', 'Successfully updated !');

            return Redirect::to('Filing_cabinet/' . $id . '/edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        // echo $id;
        //exit;
        // delete
        $filing_category_data = Filing_cabinet_category_model::find($id);

        $filing_category_data->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the Filing Cabinet Category!');
        return Redirect::to('Filing_cabinet_category');
    }

}
