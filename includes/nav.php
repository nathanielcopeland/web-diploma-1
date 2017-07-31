<header></header>
        <nav class="navbar navbar-default">
            <div class="navbar-header">
                <ul class="nav navbar-nav">
                    <li><a href="https://webdev-nathanielcopeland.c9users.io/index.php">Home</a></li>
                
                <li><a href="https://webdev-nathanielcopeland.c9users.io/login.php">Login</a></li>
               </ul>
               
               <ul class="nav navbar-nav navbar-right">
                   <li class="dropdown ">
                       <a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1
                           <span class="caret"></span></a>
                               <ul class=" nav navbar-nav navbar-right">
                                  <div class="container">
            <div class="row">
                <div class="col-sm-2 col-md-offset-4">
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
                        <p>Dont have an account?<a href="register.php"> Register Here</a></p>
                        
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
                               </ul>
                   </li>
               </ul>
            </div>
        </nav>
<header></header>