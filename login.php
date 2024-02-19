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

<!-- Font Awesome -->
<script src="https://kit.fontawesome.com/57c0ce6296.js" crossorigin="anonymous"></script>

<section class="h-100vh gradient-form" style="background-color: #eee; display:flex; align-items:center; heigth:100vh">
  <div class="container py-5 h-100vh ">
    <div class="row d-flex justify-content-center align-items-center">
      <div class="col-xl-10 text-center">
        <div class="card shadow rounded-3 text-black"  style="width:75%; margin:auto">
          <!-- <div class="row g-0"> -->
          <div class="card-body p-md-5 mx-md-1">
                <div class="text-center">
                  <i class="fa fa-wifi" style="font-size:60px "></i>
                  <h4 class="mt-1 mb-6 pb-1" style="padding-top:20px">Welcome To Student Registration Portal</h4>
                </div>

                <form>
                  <p style="text-align:center">Unlock the power of seamless connectivity with our cutting-edge WiFi Access Registration Portal.</p>

                  <p class="text-center font-weight-bold">
                    Click here to continue with your G-Suite Account (pdn.ac.lk)
                  </p>

                  <div class="text-center pt-1 mb-5 pb-1">
                    <!-- Google Sign-In button with Google icon -->
                    <a href="<?php echo $client->createAuthUrl() ?>" class="btn btn-outline-primary w-50 login-button"  style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: 1rem; --bs-btn-font-size: 1.5rem;">
                    <i class="fa-brands fa-google" style="color: #25a253;"></i>
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
