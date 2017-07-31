<?php 
echo $_SESSION["id"];
if($_SESSION == null){
    echo 'session has no id';
}
echo 'hello';
echo $_SESSION["favcolor"];
?>