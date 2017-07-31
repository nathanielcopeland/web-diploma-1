<?php
session_start();
if($_SERVER["REQUEST_METHOD"]=="POST"){
  unset($message);
  unset($errors);
  
  //get database connection
  include("includes/database.php");
  
  $user_email = $_POST["user"];
  
  
  if(filter_var($user_email,FILTER_VALIDATE_EMAIL)){
      //if true, user entered an email 
      $query = "SELECT * FROM accounts WHERE email='$user_email'";
  } else {
      //if false, user entered a username
      $query = "SELECT * FROM accounts WHERE username='$user_email'";
  }
  $password = $_POST['password'];
  
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
        <?php include("includes/nav.php")?>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <form id="login-form" action="login.php" method="post">
                        <h1>Login to your account</h1>
                        <div class="form-goup">
                            <label for="email">Email Address or Username</label>
                            <input class ="form-control" type="text" id="user" name="user" placeholder="you@email.com">
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