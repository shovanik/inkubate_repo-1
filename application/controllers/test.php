<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class test extends CI_Controller {


    
    public function test_get(){

        $resp   = $this->facebook_count('https://www.facebook.com/CourseWorld');

        print_r($resp);

    }

    

    function facebook_count($url){

    

        // Query in FQL

        $fql  = "SELECT share_count, like_count, comment_count ";

        $fql .= " FROM link_stat WHERE url = '$url'";

        

        $fqlURL = "https://api.facebook.com/method/fql.query?format=json&query=" . urlencode($fql);

        

        // Facebook Response is in JSON

        $response = file_get_contents($fqlURL);

        return json_decode($response);

    

    }
    
 
}

    

?>
