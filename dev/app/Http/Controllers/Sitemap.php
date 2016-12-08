<?php

namespace App\Http\Controllers;

use Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Session;

class Sitemap extends Controller {

    public function __construct() {
        if (Session::get('id') == '') {
            Redirect::to('admin')->send();
        }
        
        //apply permission for boces website
        if(Session::get('website_id') == 1){
            
        $this->middleware('auth');
        $this->middleware('permission:sitemap-list', ['only' => ['show', 'index']]);
        
        
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //

        return view('Sitemap/view');
    }

    public function generate() {
        // Set the output file name.
        $OUTPUT_FILE = (Request::get('OUTPUT_FILE') != "") ? Request::get("OUTPUT_FILE") : "sitemap.xml";
        //echo $OUTPUT_FILE;
        //exit;
        $file = $OUTPUT_FILE;

        //echo $file;
        //exit;
        // Set the start URL. Here is https used, use http:// for 
        // non SSL websites.
        //define(SITE, base_url());
        //$url = SITE;
        $url = "http://asecretadmirer.com/";
        //echo "<br>";
        //echo SITEMAP_URL;       exit;
        // Set true or false to define how the script is used.
        // true:  As CLI script.
        // false: As Website script.
        define('CLI', true);

        // echo"hello";
        //exit;
        // Define here the URLs to skip. All URLs that start with 
        // the defined URL will be skipped too.
        // Example: "https://www.plop.at/print" will also skip
        // https://www.plop.at/print/bootmanager.html
        $skip = array(
            "https://www.plop.at/print",
            "https://www.plop.at/slide",
        );

        // Define what file types should be scanned.
        $extension = array(
            ".html",
            ".php",
        );

        $FREQUENCY = (Request::get('FREQUENCY') != "") ? Request::get("FREQUENCY") : "weekly";

        //echo $FREQUENCY;
        //exit;
        // Scan frequency
        $freq = $FREQUENCY;

        // Page priority
        $priority = "0.5";


        define('VERSION', "1.0");
        define('NL', 'CLI' ? "\n" : "<br>");


        $pf = fopen($file, "w");
        if (!$pf) {
            echo "Cannot create $file!" . NL;
            //echo "jldjsljld";
            //exit;
            return;
        }

        fwrite($pf, "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n" .
                "<!-- Created with Plop PHP XML Sitemap Generator " . VERSION . " https://www.plop.at -->\n" .
                "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\"\n" .
                "        xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"\n" .
                "        xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9\n" .
                "        http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">\n" .
                "  <url>\n" .
                "    <loc>$url/</loc>\n" .
                "    <changefreq>daily</changefreq>\n" .
                "  </url>\n");

        $scanned = array();

        $scandata = $this->Scan($url);

        fwrite($pf, "</urlset>\n");
        fclose($pf);

        echo "Done." . NL;
        echo "$file created." . NL;
        // Init end ==========================
        //set success message
        //$this->session->set_flashdata('item', array('message' => 'Sitemap created successfully', 'class' => 'alert alert-success'));
        //redirect
        Session::flash('message', 'Sitemap created successfully');
        return Redirect::to('Sitemap');
    }

    public function Path($p) {
        $a = explode("/", $p);
        $len = strlen($a[count($a) - 1]);
        return (substr($p, 0, strlen($p) - $len));
    }

    public function GetUrl($url) {
        $agent = "Mozilla/5.0 (compatible; Plop PHP XML Sitemap Generator/" . VERSION . ")";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, $agent);

        $data = curl_exec($ch);

        curl_close($ch);

        return $data;
    }

    public function GetQuotedUrl($str) {
        if ($str[0] != '"')
            return $str; // Only process a string 



            
// starting with double quote
        $ret = "";

        $len = strlen($str);
        for ($i = 1; $i < $len; $i++) { // Start with 1 to skip first quote
            if ($str[$i] == '"')
                break; // End quote reached
            $ret .= $str[$i];
        }

        return $ret;
    }

    public function Scan($url) {
        global $scanned, $pf, $extension, $skip, $freq, $priority;

        echo $url . NL;


        @array_push($scanned, $url);
        $html = $this->GetUrl($url);
        $a1 = explode("<a", $html);

        foreach ($a1 as $val) {
            $anker_parts = explode(">", $val);
            $a = $anker_parts[0];

            $href_split = explode("href=", $a);
            // print_r($href_split);
            // exit;
            $href_string = $href_split[0];
            //echo $href_string;
            //exit;
            if ($href_string[0] = '') {
                $href_string[0] = 1;
            }
//echo $href_string[0];
//exit;
//echo "<pre>";
//            print_r($href_string);
//            exit;
            if ($href_string[0] == '"') {
                $next_url = $this->GetQuotedUrl($href_string);
            } else {
                $spaces_split = explode(" ", $href_string);
                $next_url = str_replace("\"", "", $spaces_split[0]);
            }

            $fragment_split = explode("#", $next_url);
            $next_url = $fragment_split[0];

            if ((substr($next_url, 0, 7) != "http://") &&
                    (substr($next_url, 0, 8) != "https://") &&
                    (substr($next_url, 0, 6) != "ftp://") &&
                    (substr($next_url, 0, 7) != "mailto:")) {
                if ($next_url[0] == '/') {
                    $next_url = "$scanned[0]$next_url";
                } else {
                    $next_url = $this->Path($url) . $next_url;
                }
            }

            if (substr($next_url, 0, strlen($scanned[0])) == $scanned[0]) {
                $ignore = false;
                if (isset($skip)) {
                    foreach ($skip as $v) {
                        if (substr($next_url, 0, strlen($v)) == $v) {
                            $ignore = true;
                        }
                    }
                }


                if (!$ignore && !@in_array($next_url, $scanned)) {
                    
                }
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        
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
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    Public function update(Request $request, $id) {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        
    }

}
