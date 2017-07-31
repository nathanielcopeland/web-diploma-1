<?php
session_start();
include("includes/database.php");
//process registration with php
//print_r($_server);
if($_SERVER["REQUEST_METHOD"]=="POST"){
    // print_r($_POST);

$errors = array();
$username = $_POST['username'];
//check username for errors
if(strlen($username) > 16){
    //create error message
    $errors["username"] = "username too long";
}
if(strlen($username) < 3){
    $errors["username"] = $errors["username"] . " " . "username should be at least 6 characters";
}
 if($errors["username"]){
     $errors["username"] = trim($errors["username"]);
 }
     

$email = $_POST["email"];
//check and validate email
$email_check = filter_var($email,FILTER_VALIDATE_EMAIL);
    if($email_check == false){
        $errors["email"] = "email address is not valid";
    } 

$password1 = $_POST['password1'];
$password2 = $_POST['password2'];

if($password1 !== $password2){
    $errors["password"] = "passwords do not match";
} elseif(strlen($password1) < 8){
    $errors["password"] = "password should be atleast 8 characters";
}
//if no errors write data to database
if(count($errors) == 0){
    //hash the password
    echo $password;
    $password = password_hash($password,PASSWORD_DEFAULT);
    echo $password;
    //create a query string
    $query = "INSERT 
                      INTO accounts 
                      (username,email,password,status,created) 
                      VALUES
                      ('$username','$email','$password','1',NOW())";
                      
$result = $connection->query($query);
if($result == true){
    echo "account created";
} else {
    if($connection->errno == 1062){
        $message = $connection->error;
        if(strstr($message,"username")){
            $errors["username"] = "username already taken";
        }
        if(strstr($message,"email")){
            $errors["email"] = "email already used";
        }
    //     if(strpos($connection->error, "username") !== false){
    //         echo "username already in use";
    //         echo $connection->error;
    //     } else{
    //         echo "email already in use";
    //     }
        
    }
}

}
}


?>

<!doctype html>
<html>
    
    
<?php
$page_title = "Register For Account";
include("includes/head.php");
?>
<body>
    <?php 
        include("nav.php");
        ?>
    
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <form id="registeration" method="POST" action="register.php">
                    
                    <h2>Register for an account</h2>
                    
                    <!--username-->
                    <?php
                    if($errors["username"]){
                        $username_error_class = "has-error";
                    }
                    ?>
                    <div class="form-group <?php echo $username_error_class; ?>">
                        <label for="username">Username</label>
                        <input class="form-control" name="username" type="text" id="username"  placeholder="minimum 3 characters" value ="<?php echo $username; ?>">
                        <span class="help-block">
                            <?php echo $errors["username"];?>
                        </span>
                    </div>
                    
                    <!--email-->
                    <?php
                    if($errors["email"]){
                        $email_error_class = "has-error";
                    }
                    ?>
                    <div class="form-group <?php echo $email_error_class; ?>">
                        <label for="email">Email</label>
                        <input class="form-control" name="email" type="email" id="email" placeholder="you@domain.com" value="<?php echo $email; ?>">
                        <span class="help-block">
                            <?php echo $errors["email"]; ?>
                        </span>
                    </div>
                    
                    <!--password-->
                    <?php
                    if($errors["password"]){
                        $password_error_class = "has-error";
                    }
                    ?>
                    <div class="form-group <?php echo $password_error_class; ?>">
                        <!--password 1-->
                        <label for="password1">Password</label>
                        <input class="form-control" name="password1" type="password" id="password1" placeholder="minimum 8 characters">
                        <!--password 2-->
                         <label for="password2">Retype Password</label>
                        <input class="form-control" name="password2" type="password" id="password2" placeholder="minimum 8 characters">
                        <span class="help-block">
                            <?php
                            echo $errors["password"];
                            ?>
                        </span>
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" class="btn btn-default">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <?php 
    echo $_SESSION["id"];
    ?>
    
    
</body>
</html>
