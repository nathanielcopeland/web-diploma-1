<?php
session_start();
include("includes/database.php");
?>
<!doctype html>
<html>
      <?php
    $page_title = "Home Page";
    include("includes/head.php");
    ?>   
    <body>
     <?php 
        include("includes/navigation.php");
        if($_GET['id'] >= 1){
            $pagesection = $_GET['id'];
        } else{
            $pagesection = $_GET['board'];
        }
        if($pagesection < 1){
            
                
            if($_SESSION['rank'] >= 2){
                // CREATING CATEGORY
            include("includes/createCategory.php");
        }
        $query = "SELECT * FROM forum_categories";
        $result = $connection->query($query);
        
        
        while($categories = mysqli_fetch_array($result)){
            //output a row here
            
            // echo "<tr><td>".($categories['cat_name'])."</td><td>".($categories['cat_description'])."</td></tr>";
            echo "<div class='cat_container'><div class='cat_name'><a href='forum.php?id=".($categories['cat_id'])."'>".($categories['cat_name'])."</a></div><div class='cat_description'>".($categories['cat_description'])." </div>
        </div>";
        
        }
        } else {
            
            if($_GET['board'] < 1){
                
            echo $_GET['board'];
            // Creating Threads
            
            $query = "SELECT * FROM forum_categories WHERE cat_id = " . $_GET['id'];
           
            $result = $connection->query($query);
            $row = mysqli_fetch_array($result);
            
            
            
            if($_SESSION['rank']){
                echo "<div class='container'>
                        <div class='heading col-md-8'>
                            <H1>".$row['cat_name']."
                            </h1>
                        </div>
                        <div class='col-md-4' style='line-height:69px;'>
                            <button class='btn btn-primary' onclick='createThreadButton()'>New Thread</button>
                        </div>
                     </div>";
                
               include("includes/createThread.php"); 
            } else {
                echo "<div class='container'><div class='heading col-md-8'><H1>".$row['cat_name']."</h1></div></div>";
            }
            
            
            $query = "SELECT * FROM Thread where thread_cat = " .$_GET['id'];
            $result = $connection->query($query);
            
            
            while($threads = mysqli_fetch_array($result)){
            //output a row here
            $accounts_query = "SELECT * FROM accounts WHERE id = " . $threads['thread_by'];
            $accounts_result = $connection->query($accounts_query);
            $accounts = mysqli_fetch_array($accounts_result);
            echo "<div class='cat_container'>
                <div class='thread_name'><a href='forum.php?board=".($threads['thread_id'])."&page=1'>".($threads['thread_subject'])."</a></div>
                <div class='cat_description'> Thread Created by: ".($accounts['username'])." </div>
                <div class='cat_description'> Date Created: ".($threads['thread_date'])." </div>
        </div>";
}
        } else{
            
            
            //Posts
            //echo $_GET['board'];
            $query = "SELECT * FROM Thread where thread_id = " .$_GET['board'];
            $result = $connection->query($query);
            
            $thread = mysqli_fetch_array($result);
            
            $accountquery = "SELECT * FROM accounts where id = " .$thread['thread_by'];
            $result = $connection->query($accountquery);
            $account = mysqli_fetch_array($result);
            //title
            $thread_subject = $thread['thread_subject'];
            $thread_id = $thread['thread_id'];
            
            
            //title
            echo "<div class='container'><h1>" .$thread_subject."</h1> </div>";
            
            $currenturl = $_GET['board'];
            $currentpage = $_GET['page'];
            
            $query = "SELECT COUNT(post_topic) FROM Posts where post_topic = ".$thread_id;
            $reply_result = $connection->query($query);
            $page_count = mysqli_fetch_array($reply_result);
            
            
            
            if($page_count[0] > 19){
             echo '<div class="container">
                   <ul class="pagination">';
            if($currentpage > 1){
                       echo '<li><a href="forum.php?board='.$currenturl.'&page='.($currentpage -1).'"><</a></li>';
                   }
                   
            if($currentpage > 2){
                if($currentpage > ($page_count[0] +1) / 20 ){
              echo     '<li><a href="forum.php?board='.$currenturl.'&page='.($currentpage -2).'">'.($currentpage -2).'</a></li>';
                }
            echo    '<li><a href="forum.php?board='.$currenturl.'&page='.($currentpage -1).'">'.($currentpage -1).'</a></li>
                   <li><a class="current_tab" href="forum.php?board='.$currenturl.'&page='.($currentpage).'">'.($currentpage).'</a></li>';
              if($currentpage < ($page_count[0] +1) / 20 ){
              echo     '<li><a href="forum.php?board='.$currenturl.'&page='.($currentpage +1).'">'.($currentpage +1).'</a></li>';
              }
            }       else{
                echo '<li><a '.($currentpage=='1' ? 'class="current_tab"' : '').' href="forum.php?board='.$currenturl.'&page=1">1</a></li>
                   <li><a '.($currentpage=='2' ? 'class="current_tab"' : '').' href="forum.php?board='.$currenturl.'&page=2">2</a></li>';
                   if($page_count[0] > 39){
                       echo  '<li><a href="forum.php?board='.$currenturl.'&page=3">3</a></li>';
                   }
                 
            }
            
            if($currentpage < ($page_count[0] +1) / 20 ){
                echo '<li><a href="forum.php?board='.$currenturl.'&page='.($currentpage +1).'">></a></li>';
            }
             echo '
                   
                   
                   </ul>
                   </div>';
            }
            
            $post_reply = $_POST["thread-reply"];
            $id = $_SESSION['id'];
            //Reply Query
            $query = "SELECT * FROM Posts where post_topic = ".$thread_id;
            $reply_result = $connection->query($query);
        
            echo "<div class='topic_content'>";
            if($currentpage <= 1){
                $img_query = "SELECT * FROM user_details where account_id = " .$thread['thread_by'];
             $img_result = $connection->query($img_query);
            $profile_pic = mysqli_fetch_array($img_result);
                $original_date = $thread['thread_date'];
                $datestring = date('M d, y  h:i a', strtotime($original_date));
                echo "
                      <div class='container topic_container '>
                        <aside class='topic_author'>
                        <div class='user-image col-md-6'><img src='userimages/".$profile_pic['image_name']."'  height='80' width='80'></div>
                            <div class='author col-md-6'>
                            <a>".$account['username']."</a>
                            </div>
                        </aside> 
                        <div class='topic_body'>
                        <p>".$datestring."</p>
                            <div class='topic_description'>
                                ".$thread['thread_description']."
                            </div>
                        </div
                      </div>
                  </div>
            
            ";
            }
            
            
            $count = 1;
            while($reply = mysqli_fetch_array($reply_result)){
                if($currentpage > 1){
                    
                    $pagecount_result = ($currentpage + ($currentpage - 2)) * 10;
                } else{
                    $pagecount_result = 0;
                }
                if($count < $currentpage * 20 && $count >= $pagecount_result){
                     $query = "SELECT username FROM accounts WHERE id = ".$reply['post_by'];
                $result = $connection->query($query);
                $username = $result->fetch_assoc();
                
                $img_query = "SELECT * FROM user_details where account_id = " .$reply['post_by'];
            $img_result = $connection->query($img_query);
            $profile_pic = mysqli_fetch_array($img_result);
                
                $original_date = $reply['post_date'];
                $datestring = date('M d, y  h:i a', strtotime($original_date));
                
                echo "
                      <div class='container topic_container'>
                        <aside class='topic_author'>
                            <div class='user-image col-md-6'><img src='userimages/".$profile_pic['image_name']."'  height='80' width='80'></div>
                            <div class='author col-md-6'>
                            
                            <a>".$username['username']."</a>
                            </div>
                        </aside> 
                        
                        <div class='topic_body'>
                        <p>".$datestring."</p>
                            <div class='topic_description'>
                            ".$reply['post_content']."
                            </div>
                        </div>    
                      </div>
                        
            
            ";
                }
               
            
            $count += 1;
            }
            
            echo "</div>";
            
            if($page_count[0] > 19){
             echo '<div class="container">
                   <ul class="pagination">';
            if($currentpage > 1){
                       echo '<li><a href="forum.php?board='.$currenturl.'&page='.($currentpage -1).'"><</a></li>';
                   }
                   
            if($currentpage > 2){
                if($currentpage > ($page_count[0] +1) / 20 ){
              echo     '<li><a href="forum.php?board='.$currenturl.'&page='.($currentpage -2).'">'.($currentpage -2).'</a></li>';
                }
            echo    '<li><a href="forum.php?board='.$currenturl.'&page='.($currentpage -1).'">'.($currentpage -1).'</a></li>
                   <li><a class="current_tab" href="forum.php?board='.$currenturl.'&page='.($currentpage).'">'.($currentpage).'</a></li>';
              if($currentpage < ($page_count[0] +1) / 20 ){
              echo     '<li><a href="forum.php?board='.$currenturl.'&page='.($currentpage +1).'">'.($currentpage +1).'</a></li>';
              }
            }       else{
                echo '<li><a '.($currentpage=='1' ? 'class="current_tab"' : '').' href="forum.php?board='.$currenturl.'&page=1">1</a></li>
                   <li><a '.($currentpage=='2' ? 'class="current_tab"' : '').' href="forum.php?board='.$currenturl.'&page=2">2</a></li>';
                   if($page_count[0] > 39){
                       echo  '<li><a href="forum.php?board='.$currenturl.'&page=3">3</a></li>';
                   }
                 
            }
            
            if($currentpage < ($page_count[0] +1) / 20 ){
                echo '<li><a href="forum.php?board='.$currenturl.'&page='.($currentpage +1).'">></a></li>';
            }
             echo '
                   
                   
                   </ul>
                   </div>';
            }
            
        if($_SESSION['rank']){
               include("includes/createReply.php"); 
            }
            
        }
            
            
            
        
        }
        
        
        ?>
     
        <!--<div class="cat_container">-->
        <!--    <div class="cat_name">-->
        <!--    <a href="#">Testing Title</a>-->
        <!--    </div>-->
        <!--    <div class="cat_description">-->
        <!--    Testing a description for the new category-->
        <!--    </div>-->
        <!--</div>-->
        
        
    </body>
    
</html>