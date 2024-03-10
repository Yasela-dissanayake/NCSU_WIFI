<?php include('./constants/header.php'); ?>

<?php require_once('./configurations/auth.php'); ?>

<?php
require_once './vendor/autoload.php';

// init configuration
$clientID = '986111635896-9g0ksum6ouo21g9lf2kj66nt9lvib1eo.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost/NCSU-WiFi/login.php';

// create Client Request to access Google API

$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");


if(isset($_GET['code'])){
  // Get Token
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

  // Check if fetching token did not return any errors
  if(!isset($token['error'])){
      // Setting Access token
      $client->setAccessToken($token['access_token']);

      // store access token
      $_SESSION['access_token'] = $token['access_token'];

      // Get Account Profile using Google Service
      $gservice = new Google_Service_Oauth2($client);

      // Get User Data
      $udata = $gservice->userinfo->get();
      foreach($udata as $k => $v){
          $_SESSION['login_'.$k] = $v;
      }
      $_SESSION['ucode'] = $_GET['code'];

      header('location: ./');
      exit;
  }
}

?>

<?php
// Function to detect if the user is using a mobile device
function isMobileDevice() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER['HTTP_USER_AGENT']);
}

// Use the function to determine device type
$isMobile = isMobileDevice();
?>

<!-- Font Awesome -->
<script src="https://kit.fontawesome.com/57c0ce6296.js" crossorigin="anonymous"></script>

 <!-- google fonts -->
 <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Ubuntu&display=swap" rel="stylesheet">

<link rel="stylesheet" href="/style.css">
<meta name = "veiwpoint" content = "width=device-width , initial-scale=1.0">

<section class="h-100vh gradient-form" style="background-color: #eee; display:flex; align-items:center; heigth:100vh; line-height: 1.5; border-style: inset;">
  <div class="container py-5 h-100vh ">
    <div class="row d-flex justify-content-center align-items-center">
      <div class="col-xl-4 col-sm-2 text-center">
        <div class="card shadow rounded-3 text-black "  style=" margin:auto;">
          <!-- <div class="row g-0"> -->
          <div class="card-body p-md-5 mx-md-1">
                <div class="text-center">
                  <i class="fa fa-wifi" style="font-size:60px "></i>
                  <h3 class="mt-1 mb-6 pb-1" style="padding-top:20px;  font-family: Montserrat-bold; font-weight: bold; margin-bottom: 1rem;">Welcome To Student Registration Portal</h3>
                </div>

                <form>
                  <p style="text-align:center">Unlock the power of seamless connectivity with our cutting-edge WiFi Access Registration Portal.</p>

                  <p class="text-center font-weight-bold">
                    Click here to continue with your G-Suite Account (pdn.ac.lk)
                  </p>

                  <div class="text-center pt-1 mb-5 pb-1">
                    <!-- Google Sign-In button with Google icon -->
                    <a href="<?php echo $client->createAuthUrl() ?>" class="btn btn-outline-primary btn-lg login-button"  style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: 1rem; --bs-btn-font-size: 1.5rem;">
                    <img src="./images/google.png" alt="google-logo" style = "width: 20px; height: 20px; margin-bottom:3px">
                      Log in 
                    </a>
                  </div>
                </form>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include('./constants/bootstrapFooterConfigurations.php'); ?>
