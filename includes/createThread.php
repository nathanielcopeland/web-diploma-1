<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){

$errors = array();
    
$threadName = $_POST['new-thread'];
if(strlen($categoryName) > 16){
    //create error message
    $errors["threadName"] = "thread name too long";
}
if(strlen($threadName) < 3){
    $errors["threadName"] = $errors["threadName"] . " " . "Thread Name should be at least 3 characters";
}
 if($errors["threadName"]){
     $errors["threadName"] = trim($errors["threadName"]);
 }
  
$threadDescription = $_POST['thread-description'];
$threadid = $_POST['thread'];

$cat_id = $row['cat_id'];
$id = $_SESSION['id'];



if(count($errors) == 0){
    
    $query = "INSERT 
                      INTO Thread 
                      (thread_subject,thread_description,thread_date,thread_cat,thread_by) 
                      VALUES
                      ('$threadName','$threadDescription',NOW(),'$cat_id','$id')";
                      
$result = $connection->query($query);

if($result == true){
    $message = "thread successfully created";
} else {
if($connection->errno == 1062){
     $message = $connection->error;
} else{
    echo "error";
}
 
}
    
}

}

?>

<div id='toggleThreadButton' style='display:none;' class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 padding_bottom">
                    <form id="createCategory-form"  method="post">
                        <h1>Create New Thread</h1>
                        <div class="form-goup ">
                            <label for="new-thread">Thread Name</label>
                            <input class ="form-control" type="text" id="new-thread" name="new-thread" placeholder="thread name">
                        </div>
                        <div class="form-group ">
                            <label  for="thread-description">Thread Description</label>
                            <textarea class ="form-control  reply-box" type="text" id="thread-description" name="thread-description" placeholder="thread description"></textarea>
                        </div>
                       
                       <div class="text-center">
                           <button type="submit" name="submit" value="login" class="btn btn-info">Create</button>
                       </div>
                    </form>
                </div>
            </div>  
</div>            