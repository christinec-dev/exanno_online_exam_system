<?php 
    //this page will redirect admins based on the url paths
    if(isset($_GET['page']))
    {
        $page=$_GET['page'];
    }
    else
    {
        $page='home';
    }
    
    switch($page)
    {
        case "home":
        {
            include('dashboard.php');
        }
        break;
        
           case "index":
        {
            include('dashboard.php');
        }
        break;
        
        case "admins":
        {
            include('admins.php');
        }
        break;

        case "schedule":
        {
            include('schedule_exam.php');
        }
        break;

        case "add_admin":
        {
            include('add_admin.php');
        }
        break;
        
        case "update_admin":
        {
            include('update_admin.php');
        }
        break;
        
        case "students":
        {
            include('students.php');
        }
        break;
        
        case "add_student":
        {
            include('add_student.php');
        }
        break;
        
        case "update_student":
        {
            include('update_student.php');
        }
        break;
        
        case "faculties":
        {
            include('faculties.php');
        }
        break;
        
        case "add_faculty":
        {
            include('add_faculty.php');
        }
        break;
        
        case "update_faculty":
        {
            include('update_faculty.php');
        }
        break;
        
        case "questions":
        {
            include('questions.php');
        }
        break;
        
        case "add_question":
        {
            include('add_question.php');
        }
        break;
        
        case "update_question":
        {
            include('update_question.php');
        }
        break;
        
        case "results":
        {
            include('results.php');
        }
        break;
        
        case "view_result":
        {
            include('view_result.php');
        }
        break;

        case "update_results":
            {
                include('update_results.php');
            }
        break;
        case "settings":
        {
            include('settings.php');
        }
        break;
        
        case "logout":
        {
            if(isset($_SESSION['admin']))
            {
                unset($_SESSION['admin']); //destroy admin session
                header('location:'.SITEURL.'admin/login.php');
            }
            
        }
        break;
        
        default:
        {
            include('dashboard.php');
        }
    }
?>