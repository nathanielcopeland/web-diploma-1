<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
            $post_query = "INSERT
                            INTO Posts
                            (post_content,post_date,post_topic,post_by)
                            VALUES
                            ('$post_reply',NOW(),'$thread_id','$id')";
            $result = $connection->query($post_query);
            
            header('Location: '.$_SERVER['REQUEST_URI']);
            exit();
            }
            
            
            echo "<div class='container'>
            <div class='row'>
                <div class='col-md-4 col-md-offset-4'>
                    <form id='reply-form'  method='post'>
                        <h1>Reply</h1>
                       
                        <div class='form-group'>
                            
                            <textarea class ='form-control reply-box' type='text' id='thread-reply' name='thread-reply' placeholder='Post Reply'></textarea>
                        </div>
                       
                       <div class='text-center'>
                           <button type='submit' name='submit' value='login' class='btn btn-info'>Create</button>
                       </div>
                    </form>
                </div>
            </div>  
            </div>";
?>