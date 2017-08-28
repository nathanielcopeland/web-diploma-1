<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){

$errors = array();
    
$categoryName = $_POST['new-category'];
if(strlen($categoryName) > 16){
    //create error message
    $errors["categoryName"] = "category name too long";
}
if(strlen($categoryName) < 3){
    $errors["categoryName"] = $errors["categoryName"] . " " . "category Name should be at least 3 characters";
}
 if($errors["categoryName"]){
     $errors["categoryName"] = trim($errors["categoryName"]);
 }
  
$categoryDescription = $_POST['category-description'];


if(count($errors) == 0){
    $query = "INSERT 
                      INTO forum_categories 
                      (cat_name,cat_description) 
                      VALUES
                      ('$categoryName','$categoryDescription')";
                      
$result = $connection->query($query);

if($result == true){
    $message = "Account successfully created";
} else {
if($connection->errno == 1062){
     $message = $connection->error;
}
 
}
    
}
}

?>

<div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <form id="createCategory-form" action="forum.php" method="post">
                        <h1>Create New Category</h1>
                        <div class="form-goup">
                            <label for="new-category">Category Name</label>
                            <input class ="form-control" type="text" id="new-category" name="new-category" placeholder="category name">
                        </div>
                        <div class="form-group">
                            <label  for="category-description">Category Description</label>
                            <input class ="form-control" type="text" id="category-description" name="category-description" placeholder="category description">
                        </div>
                       
                       <div class="text-center">
                           <button type="submit" name="submit" value="login" class="btn btn-info">Create</button>
                       </div>
                    </form>
                </div>
            </div>  
</div>            