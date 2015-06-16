<?php

/**
 * Layout management library based on:
 * http://codeigniter.com/wiki/layout_library/ *
 * Extended layout placeholders and javascript and css files inclussion.
 */
class Common
{
    function send_mail($to=NULL, $from=NULL, $subject=NULL,$body=NULL,$from_name=NULL,$bcc="") {
        if($from_name == NULL)
        {
            $name = "Inkubate Team";
        }
        else
        {
            $name = $from_name;
        }
		$headers = "";
		$headers .= 'From: '.$name.' <'.$from.'>' . "\n";
		$headers .= 'MIME-Version: 1.0'. "\n";
		$headers .= "Content-Type: text/HTML; charset=ISO-8859-1\n";
		if($bcc != "")
		{
		    $headers .= 'Bcc: '.$bcc."\n";
		}
		@mail($to,$subject,$body,$headers);      
    }
  /*function page_html($array)
  {
    $page     = $array['page'];
    $cur_page = $page;
    $page -= 1;
    $per_page     = $array['per_page'];
    $previous_btn = true;
    $next_btn     = true;
    $first_btn    = false;
    $last_btn     = false;
    $start        = $array['start'];
    $msg = "";
    $song_id = $array['song_id'];
    $func = $array["func"];
    $count = $array['count'];
    if ($count > $per_page) {
        $no_of_paginations = ceil($count / $per_page);
        
       // ---------------Calculating the starting and endign values for the loop----------------------------------- 
        if ($cur_page >= 7) {
            $start_loop = $cur_page - 3;
            if ($no_of_paginations > $cur_page + 3)
                $end_loop = $cur_page + 3;
            else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
                $start_loop = $no_of_paginations - 6;
                $end_loop   = $no_of_paginations;
            } else {
                $end_loop = $no_of_paginations;
            }
        } else {
            $start_loop = 1;
            if ($no_of_paginations > 7)
                $end_loop = 7;
            else
                $end_loop = $no_of_paginations;
        }
        // -----------------------------------------------------------------------------------------------------------
        $msg .= "<div class='pagination' style='margin-top:20px;'><ul>";
        
        // FOR ENABLING THE FIRST BUTTON
        if ($first_btn && $cur_page > 1) {
            $msg .= "<li p='1' class='active'>First</li>";
        } else if ($first_btn) {
            $msg .= "<li p='1' class='inactive'>First</li>";
        }
        
        // FOR ENABLING THE PREVIOUS BUTTON
        if ($previous_btn && $cur_page > 1) {
            $pre = $cur_page - 1;
            $msg .= "<li p='$pre' class='active'  onclick=\"".$func."('".$song_id."','".$pre."')\">Previous</li>";
        } else if ($previous_btn) {
            $msg .= "<li class='inactive'>Previous</li>";
        }
        for ($i = $start_loop; $i <= $end_loop; $i++) {
            
            if ($cur_page == $i)
                $msg .= "<li p='$i' style='color:#fff;background-color:#ABC509;' class='active' >{$i}</li>";
            else
                $msg .= "<li p='$i' class='active'   onclick=\"".$func."('".$song_id."','".$i."')\" >{$i}</li>";
        }
        
        // TO ENABLE THE NEXT BUTTON
        if ($next_btn && $cur_page < $no_of_paginations) {
            $nex = $cur_page + 1;
            $msg .= "<li p='$nex' class='active' onclick=\"".$func."('".$song_id."','".$nex."')\">Next</li>";
        } else if ($next_btn) {
            $msg .= "<li class='inactive'>Next</li>";
        }
        
        // TO ENABLE THE END BUTTON
        if ($last_btn && $cur_page < $no_of_paginations) {
            $msg .= "<li p='$no_of_paginations' class='active'>Last</li>";
        } else if ($last_btn) {
            $msg .= "<li p='$no_of_paginations' class='inactive'>Last</li>";
        }
        //$goto         = "<input type='text' class='goto' size='1' style='margin-top:0px;margin-left:60px; height:24px; width:40px;'/><input type='button' id='go_btn' class='go_button' value='Go'/>";
        //$total_string = "<span class='total' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span>";
        //$msg          = $msg . "</ul>" . $goto . $total_string . "</div>"; // Content for pagination
        $msg          = $msg . "</ul></div>"; // Content for pagination
    }
    return $msg;
  }*/
  function page_html($array)
  {
    $page     = $array['page'];
    $cur_page = $page;
    $page -= 1;
    $per_page     = $array['per_page'];
    $previous_btn = true;
    $next_btn     = true;
    $first_btn    = false;
    $last_btn     = false;
    $start        = $array['start'];
    $msg = "";
    $id = $array['id'];
    $func = $array["func"];
    $count = $array['count'];
    if ($count > $per_page) {
        $no_of_paginations = ceil($count / $per_page);
        
        /* ---------------Calculating the starting and endign values for the loop----------------------------------- */
        if ($cur_page >= 7) {
            $start_loop = $cur_page - 3;
            if ($no_of_paginations > $cur_page + 3)
                $end_loop = $cur_page + 3;
            else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
                $start_loop = $no_of_paginations - 5;
                $end_loop   = $no_of_paginations;
            } else {
                $end_loop = $no_of_paginations;
            }
        } else {
            $start_loop = 1;
            if ($no_of_paginations > 6)
                $end_loop = 6;
            else
                $end_loop = $no_of_paginations;
        }
        /* ----------------------------------------------------------------------------------------------------------- */
        $msg .= "<div class='pagination' style='margin-top:20px;'><ul>";
        
        // FOR ENABLING THE FIRST BUTTON
        if ($first_btn && $cur_page > 1) {
            $msg .= "<li p='1' class='active'>First</li>";
        } else if ($first_btn) {
            $msg .= "<li p='1' class='inactive'>First</li>";
        }
        
        // FOR ENABLING THE PREVIOUS BUTTON
        if ($previous_btn && $cur_page > 1) {
            $pre = $cur_page - 1;
            $msg .= "<li p='$pre' class='active'  onclick=\"".$func."('".$id."','".$pre."','".$per_page."')\"><<</li>";
        } else if ($previous_btn) {
            $msg .= "<li class='inactive'><<</li>";
        }
        for ($i = $start_loop; $i <= $end_loop; $i++) {
            
            if ($cur_page == $i)
                $msg .= "<li p='$i' style='color:#fff;background-color:#000;' class='active' >{$i}</li>";
            else
                $msg .= "<li p='$i' class='active'   onclick=\"".$func."('".$id."','".$i."','".$per_page."')\" >{$i}</li>";
        }
        
        // TO ENABLE THE NEXT BUTTON
        if ($next_btn && $cur_page < $no_of_paginations) {
            $nex = $cur_page + 1;
            $msg .= "<li p='$nex' class='active' onclick=\"".$func."('".$id."','".$nex."','".$per_page."')\">>></li>";
        } else if ($next_btn) {
            $msg .= "<li class='inactive'>>></li>";
        }
        
        // TO ENABLE THE END BUTTON
        if ($last_btn && $cur_page < $no_of_paginations) {
            $msg .= "<li p='$no_of_paginations' class='active'>Last</li>";
        } else if ($last_btn) {
            $msg .= "<li p='$no_of_paginations' class='inactive'>Last</li>";
        }
        //$goto         = "<input type='text' class='goto' size='1' style='margin-top:0px;margin-left:60px; height:24px; width:40px;'/><input type='button' id='go_btn' class='go_button' value='Go'/>";
        //$total_string = "<span class='total' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span>";
        //$msg          = $msg . "</ul>" . $goto . $total_string . "</div>"; // Content for pagination
        $msg          = $msg . "</ul></div>"; // Content for pagination
    }
    return $msg;
  }
  
    function removeFile($image_name,$folder) { 
		$path = FCPATH.$folder.$image_name;
		//echo $path;
		@unlink($path);
		
	}
	
	
}

?>
