<html>

  <head>
    <title>Demo: Getting an email address using the Google+ Sign-in button</title>
    <!-- Include the API client and Google+ client. -->
    <script src = "https://plus.google.com/js/client:plusone.js"></script>
  </head>

  <body>
    <!-- Container with the Sign-In button. -->
    <div id="gConnect" class="button">
      <button class="g-signin"
          data-scope="email"
          data-clientid="151275758111-o7dub4hc3pulp984ustfr3qhuflh1h55.apps.googleusercontent.com"
          data-callback="onSignInCallback"
          data-theme="dark"
          data-cookiepolicy="http://billbahadur.com">
      </button>
      <!-- Textarea for outputting data -->
      <div id="response" class="hide">
        <textarea id="responseContainer" style="width:100%; height:150px"></textarea>
      </div>
    </div>
 </body>

  <script type="text/javascript">
  /**
   * Handler for the signin callback triggered after the user selects an account.
   */
  function onSignInCallback(resp) {
    gapi.client.load('plus', 'v1', apiClientLoaded);
  }

  /**
   * Sets up an API call after the Google API client loads.
   */
  function apiClientLoaded() {
    gapi.client.plus.people.get({userId: 'me'}).execute(handleEmailResponse);
  }

  /**
   * Response callback for when the API client receives a response.
   *
   * @param resp The API response object with the user email and profile information.
   */
  function handleEmailResponse(resp) {
    //alert(resp.emails);
    var fullname;
    var primaryEmail;
    for (var i=0; i < resp.emails.length; i++) {
      if (resp.emails[i].type === 'account') primaryEmail = resp.emails[i].value;
    }
    document.getElementById('responseContainer').value = 'full name: ' + resp.displayName + 'Primary email: ' +
        primaryEmail + '\n\nFull Response:\n' + JSON.stringify(resp);
  }

  </script>

</html>