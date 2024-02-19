<?php require_once('./configurations/auth.php') ?>
<?php require_once('./constants/header.php')?>

<?php 
if(isset($_GET['logout'])){
    session_destroy();
    header('location: login.php');
}
?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary bg-gradient">
        <div class="container">
            <a class="navbar-brand" href="./">NCSU WiFi</a>
            <div class="text-center">
              <img src="<?= $_SESSION['login_picture'] ?>" alt="loginImage" class="img-thumb-nail rounded-circle">
            </div>
            <div class="text-center">
                                <a href="./?logout" class="btn btn btn-danger btn-sm rounded-0">Logout</a>
                            </div>
    </div>
        </div>
    </nav>
    <div class="container my-5">



   <div class="card" style="width:100%;">
   <div class="card-body">
   <div class="card">
  <h6 class="card-header">Basic Details</h6>
  <div class="card-body">
  <form>
  <div class="row mb-3">
    <div class="col">
      <input type="text" class="form-control" placeholder="First name">
    </div>
    
    <div class="col">
      <input type="text" class="form-control" placeholder="Last name">
    </div>
  </div>

  <div class="row">
    <div class="col">
      <input type="text" class="form-control" placeholder="First name">
    </div>
    <div class="col">
      <input type="text" class="form-control" placeholder="Last name">
    </div>
  </div>
</form>
  
</div>
  </div>
  
</div>
        
            </div>
        </div>
    </div>
<?php include('./constants/bootstrapFooterConfigurations.php')?>