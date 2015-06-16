<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script type="text/javascript">
  (function() {
    var po = document.createElement('script');
    po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/client:plusone.js?onload=render';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(po, s);
  })();

  function render() {
    gapi.signin.render('customBtn', {
      'callback': 'signinCallback',
      'clientid': '151275758111-o7dub4hc3pulp984ustfr3qhuflh1h55.apps.googleusercontent.com',
      'cookiepolicy': 'http://billbahadur.com',
      'scope': 'https://www.googleapis.com/auth/plus.login'
    });
  }
  function signinCallback(authResult) {
    if (authResult['status']['signed_in']) {
            console.log(authResult);
            document.getElementById('customBtn').setAttribute('style', 'display: none');
             /* get google plus id */
            $.ajax({
                type: "GET",
                url: "https://www.googleapis.com/oauth2/v2/userinfo?access_token="+authResult['access_token']
            })
            .done(function( data ){
                console.log(data);
            });
        } else {
            console.log('Sign-in state: ' + authResult['error']);
        }
  }
  </script>
  <div id="customBtn" class="customGPlusSignIn">
    <span class="icon"></span>
    <span class="buttonText">Google</span>
  </div>