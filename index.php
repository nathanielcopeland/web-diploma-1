<?php
session_start();
include("includes/database.php");

$_SESSION["favcolor"] = "green";
?>
<!doctype html>
<html>
    <?php
    $page_title = "Home Page";
    include("includes/head.php");
    ?>
    <body>
        
        <?php 
        include("nav.php");
        ?>
        
        
        <div class="container">
            <div class="row">
            
            <div class="col-sm-6 col-md-6">
            <h1>Title 1 <i class="fa fa-battery-full" aria-hidden="true"></i></h1>
Well, the way they make shows is, they make one show. That show's called a pilot. Then they show that show to the people who make shows, and on the strength of that one show they decide if they're going to make more shows. Some pilots get picked and become television programs. Some don't, become nothing. She starred in one of the ones that became nothing.

            </div>    
            
            <div class="col-sm-6 col-md-6">
<h1>Title 2 <i class="fa fa-battery-quarter" aria-hidden="true"></i></h1>


Your bones don't break, mine do. That's clear. Your cells react to bacteria and viruses differently than mine. You don't get sick, I do. That's also clear. But for some reason, you and I react the exact same way to water. We swallow it too fast, we choke. We get some in our lungs, we drown. However unreal it may seem, we are connected, you and I. We're on the same curve, just on opposite ends.          </div> 
            
            </div>
        </div>
    </body>
    
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h3>This is a Footer</h3>
                </div>
                
            </div>
        </div>
        
    </footer>
    
</htm>