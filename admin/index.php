<?php
    //main file that will load up the admin dashboard, header, footer and init sessions
    include('config/session.php');
    ob_start();
    include('../reusables/header.php');
    include('../reusables/menu.php');
    include('pages/redirect.php');
    include('../reusables/footer.php');
?>