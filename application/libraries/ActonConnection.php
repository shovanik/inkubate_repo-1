<?php
/**
* Post form submission data to Act-On and convert visitors to known via cURL, allowing no direct touch 
* between Act-On and the application
*/

class ActonConnection 
{

  protected $_postItems = array();

  protected function getPostItems()
  {
    return $this->_postItems;
  }

/**
* for setting your a POST items (key is a field in Act-On, value is the input value from the application)
* @param string $key first part of key=value for form field submission
* @param string $value latter part of key=value for form field submission
*/
  public function setPostItems($key,$value)
  {
    $this->_postItems[$key] = (string)$value;
  }

  protected function getDomain($address)
  {
    $pieces = parse_url($address);
    $domain = isset($pieces['host']) ? $pieces['host'] : '';
    if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs))
    {
      return $regs['domain'];
    }
    return false;
  }

  protected function getUserIP() 
  {
  //check proxy
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
  {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }
  else
  {
    $ip = $_SERVER['REMOTE_ADDR'];
  }

  return $ip;
  }

  /**
  * process form data for submission to Act-On external form URL
  * @param string $extPostUrl external post (Proxy URL) for Act-On
  */
  public function processConnection($extPostUrl)
  {

    $this->setPostItems('_ipaddr',$this->getUserIP()); // Act-On accepts manually defined IPs if using field name '_ipaddr'

    $fields = http_build_query($this->getPostItems()); // encode post items into query-string

    $handle = curl_init();
    curl_setopt($handle, CURLOPT_POST, 1);
    curl_setopt($handle, CURLOPT_URL, "$extPostUrl");
    curl_setopt($handle, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($handle, CURLOPT_HEADER, 1);
    curl_setopt($handle, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($handle, CURLOPT_POSTFIELDS, $fields);

    $response = curl_exec($handle);

    if($response === FALSE){
      $response = "cURL Error: " . curl_error($handle);
    }
    else
    {
        
      //echo '<pre/>';print_r($response);  
        
      preg_match_all('/^Set-Cookie:\040wp\s*([^;]*)/mi', $response, $ra); // pull response "set-cookie" values from cURL response header 
      parse_str($ra[1][0], $cookie); // select the "set-cookie" for visitor conversion and store to array $cookie

      // set updated website visitor tracking cookie with processed "set-cookie" content from curl
      setrawcookie('wp' . key($cookie), implode(",", $cookie), time() + 86400 * 365, "/", $this->getDomain($extPostUrl)); //       set cookie expiry date to 1 year
    }

    curl_close($handle);
  }
}
?>