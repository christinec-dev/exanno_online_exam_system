<!DOCTYPE html>
<html lang="en-US">
    <head>
        <!--Meta Tags Starts Here-->
        <meta charset="UTF-8" />
        <meta name="author" content="Christine Coomans" />
        <meta name="description" content="Online Examination System made by Christine Coomans." />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <!--Meta Tags Ends Here-->

        <title>Exano - Online Examination Portal</title>

        <!--Exam countdown timer starts here-->
        <script src="<?php echo SITEURL; ?>/assets/js/countdown/jquery.js"></script>
        <script src="<?php echo SITEURL; ?>/assets/js/countdown/jquery.simple.timer.js"></script>
        <script>
          $(function(){
            $('.timer').startTimer();
          });
        </script>
        <!--Exam countdown timer ends here-->
        
        <!--Script for question editor input fields-->
        <script type="text/javascript" src="<?php echo SITEURL; ?>/assets/ckeditor/ckeditor.js"></script>
        
        <!--CSS Styling & Bootstrap CDN-->
        <link rel="stylesheet" type="text/css" href="<?php echo SITEURL; ?>/assets/css/style.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    
    <body>
        <!--Navigation starts here-->
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">exanno</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="./admin?page=login">Admin Portal</a>
                    </li> 
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Student Portal</a>
                    </li>
                </ul>
                <span class="navbar-text ">
                    <a href="<?php echo SITEURL; ?>index.php?page=logout"> <button type="button" class="btn-exit" onclick="return confirm('Are you sure you want to log out?')">LOG OUT</button></a>
                </span>
                </div>
            </div>
        </nav>
        <!--Navigation ends here-->

        <!--Header starts here-->
        <header class="header">
            <div class="wrapper">
                <div class="head-title">       
                    <h1>Exanno Examination Portal</h1>
                </div>
            </div>
        </header>
        <!--Header ends here-->