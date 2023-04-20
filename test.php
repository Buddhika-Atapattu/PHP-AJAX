<?php
$con = mysqli_connect('localhost','root','','testdb');

// checking the page number
if(isset($_POST['count'])){
    $page = $_POST['count'];
}
else{
    $page = 1;
}


$itemPerPage = 3;

$itemStartFrom = ($page - 1) * $itemPerPage;
