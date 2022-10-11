<?php 
    //main file that will load up the login pages, header, footer and init sessions
    include('admin/config/session.php');
    ob_start();
    include('reusables/header.php');
    include('student/redirect.php');
    include('reusables/footer.php');
?>