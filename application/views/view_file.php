<?php
//echo phpinfo();
if( ! empty($download_path))
{
    //$data = file_get_contents(base_url().$download_path);
    $data = file_get_contents(FCPATH.$download_path); // Read the file's contents
    $name = $download_path;
 
    force_download($name, $data);
 
}

?>