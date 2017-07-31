<?php
session_start();
if($_SERVER["REQUEST_METHOD"]=="POST"){
  unset($message);
  unset($errors);
  
  //get database connection
  include("includes/database.php");
  
  $email = $_POST["email"];
  $password = $_POST['password'];
  
  //construct query with email variable
  $query = "SELECT * FROM accounts WHERE email='$email'";
  
  //create array to store errors
  $errors = array();
  
  //run query
  $userdata = $connection->query($query);
  
  
  //check the result
  if($userdata->num_rows > 0){
    $user = $userdata->fetch_assoc();
    
    $id = $user['id'];
    $db_password = $user['password'];
    if(password_verify($password,$db_password)){
      $message = "You have been logged in";
      $_SESSION["id"] = $id;
    }
    else{
      $errors["account"] = "incorrect password or email";
    }
  }
  else{
    $errors["account"] = "there is no user with the supplied credentials";
  }
}

?>

<!doctype html>

<html>
    
    <?php
    $page_title = "register for account";
    include("includes/head.php");
    ?>
    <body>
        <?php include("nav.php")?>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <form id="login-form" action="login.php" method="post">
                        <h1>Login to your account</h1>
                        <div class="form-goup">
                            <label for="email">Email Address</label>
                            <input class ="form-control" type="email" id="email" name="email" placeholder="you@email.com">
                        </div>
                        <div class="form-group">
                            <label  for="password">Your Password</label>
                            <input class ="form-control" type="password" id="pasword" name="password" placeholder="your password">
                        </div>
                       <div class="text-center">
                           <button type="submit" name="submit" value="login" class="btn btn-info">Login</button>
                       </div>
                    </form>
                    <?php
                    echo $errors;
                    if(count($errors) > 0 || $message){
                        //see which class to be used with alert
                        if(count($errors) > 0){
                            $class="alert-warning";
                            $feedback = implode(" ",$errors);
                        } 
                        if($message){
                            $class="alert-success";
                            $feedback = $message;
                        }
                            echo "<div class=\"alert $class\">
                                    $feedback
                                  </div>";
                        }
                        ?>
                </div>
            </div>
        </div>
    </body>
</html>