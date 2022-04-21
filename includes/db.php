<?php
$connection = mysqli_connect('localhost', 'root', '', 'coffee_blog');
if($connection == false){
echo "error";
mysqli_connect_error();
}


?>