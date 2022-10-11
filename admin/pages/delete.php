<?php
    //session check
    include('../config/session.php'); 
    if((isset($_GET['id']))&&(isset($_GET['page'])))
    {
        //Get the values from URL
        $id=$_GET['id'];
        $page=$_GET['page'];
        switch($page)
        {
            case "students":
            {
                $tbl_name="tbl_student";
                $title="Student";
                $where="student_id=$id";
            }
            break;
            
            case "admins":
            {
                    $tbl_name="tbl_admin";
                    $title="Admin";
                    $where="admin_id=$id";
            }
            break;

            case "faculties":
            {
                $tbl_name="tbl_faculty";
                $title="Faculty";
                $where="faculty_id=$id";
            }
            break;
            
            case "questions":
            {
                $tbl_name="tbl_question";
                $title="Question";
                $where="question_id=$id";
            }
            break;
        }

        //Delete query for student, faculty, question, or admin
        $query=$obj->delete_data($tbl_name,$where);
        $res=$obj->execute_query($conn,$query);
        //delete success notify
        if($res==true)
        {
            $_SESSION['delete']="<div class='success'>".$title." successfully deleted.</div>";
            header('location:'.SITEURL.'admin/index.php?page='.$page);
        }
        //delete failed notify
        else
        {
            $_SESSION['delete']="<div class='error'>Err occured. Failed to delete ".$title.".</div>";
            header('location:'.SITEURL.'admin/index.php?page='.$page);
        }
    }
    else
    {
        $_SESSION['fail']="<div class='error'>Failed to delete. Please Try Again.</div>";
        header('location:'.SITEURL.'admin/');
    }
?>