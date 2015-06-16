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
      preg_match_all('/^Set-Cookie:\040wp\s*([^;]*)/mi', $response, $ra); // pull response "set-cookie" values from cURL response header 
      parse_str($ra[1][0], $cookie); // select the "set-cookie" for visitor conversion and store to array $cookie

      // set updated website visitor tracking cookie with processed "set-cookie" content from curl
      setrawcookie('wp' . key($cookie), implode(",", $cookie), time() + 86400 * 365, "/", $this->getDomain($extPostUrl)); //       set cookie expiry date to 1 year
    }

    curl_close($handle);
  }
}
$post1 = new ActonConnection;
$post1->setPostItems('First Name','Milan');
$post1->setPostItems('Last Name','Labalo'); 
//$post1->setPostItems('Email','milan.labalo@kreativac.org');
$post1->setPostItems('Email','prasenjit.das@appsbee.com');
$post1->setPostItems('User Segmentation Type','Writer'); //Select options 01
$post1->setPostItems('Gender','Male'); //Select options 02
$post1->setPostItems('Age','49');
$post1->setPostItems('Mailing Street','1000 Fifth Avenue');
$post1->setPostItems('Mailing City','New York'); 
$post1->setPostItems('Mailing State/Province','NY'); //Select options 03
$post1->setPostItems('Mailing Zip/Postal Code','10028');
$post1->setPostItems('Mailing Country','US'); //Select options 04
$post1->setPostItems('Company','LaBros');
$post1->setPostItems('Industry','Education Publishing'); //Select options 05
$post1->setPostItems('Title','Developer');
$post1->setPostItems('Website','www.inkubate.com');
$post1->setPostItems('Twitter Handle','42231089');
$post1->setPostItems('Facebook ID','100001940881746');
$post1->setPostItems('LinkedIn ID','110711583');
$post1->setPostItems('Google+ ID','113551191017950459231');
$post1->setPostItems('Title Genre Interest','Art'); //Select options 06
$post1->setPostItems('Title Content Interest Type','Guide'); //Select options 07
$post1->setPostItems('Interested in New Titles','Yes'); //Select options 08
$post1->setPostItems('Manuscripts Viewed','50');
$post1->setPostItems('Titles Published Annually','1-100'); //Select options 09
$post1->setPostItems('Offers eBooks','Yes'); //Select options 10
$post1->setPostItems('Description','Tralala');
$post1->setPostItems('Are You a Self Published Author','Yes'); //Select options 11
$post1->setPostItems('Titles Have Won Literary Awards','Yes'); //Select options 12
$post1->setPostItems('In or Completed MFA in Creative Writing','Yes'); //Select options 13
$post1->setPostItems('# of Manuscripts Created','33');
$post1->setPostItems('Lifetime Number of Titles Published','1-100'); //Select options 14
$post1->processConnection('http://marketing.inkubate.com/acton/eform/13876/0016/d-ext-0001');
 
?>