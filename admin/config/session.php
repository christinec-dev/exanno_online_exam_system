<?php 
    //Start admin session Here
    session_start();
    //security functions for db queries
    include('functions.php');
    //Set the default time zone
    date_default_timezone_set('Africa/Harare');
    $obj=new Functions();
    //Connecting to the database
    $conn=$obj->db_connect();
    //Database select
    $db_select=$obj->db_select($conn);
?>