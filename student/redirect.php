<?php 
    //this page will redirect users based on the url paths
    if(isset($_GET['page']))
    {
        $page=$_GET['page'];
    }
    else
    {
        $page='welcome';
    }
    
    switch($page)
    {
        case "welcome":
        {
            include('dashboard.php');
        }
        break;
        
        case "question":
        {
            include('question.php');
        }
        break;

        case "question":
            {
                include('question.php');
            }
        break;

        case "question2":
            {
                include('question2.php');
            }
        break;

        case "question3":
            {
                include('question3.php');
            }
        break;

        case "question4":
            {
                include('question4.php');
            }
        break;

        case "question5":
            {
                include('question5.php');
            }
        break;
        
        case "login":
        {
            include('login.php');
        }
        break;

        case "subjects":
            {
                include('subjects.php');
            }
        break;

        case "reset":
            {
                include('reset.php');
            }
        break;
        
        case "endSession":
        {
            include('endSession.php');
        }
        break;

        case "endSession2":
            {
                include('endSession2.php');
            }
        break;    
        
        case "endSession3":
            {
                include('endSession3.php');
            }
        break;

        case "endSession4":
            {
                include('endSession4.php');
            }
        break;          
        
        case "endSession5":
            {
                include('endSession5.php');
            }
        break;
        
        case "results":
            {
                include('results.php');
            }
        break;      
        
        case "settings":
            {
                include('settings.php');
            }
        break;

        case "feedback":
        {
            include('feedback.php');
        }
        break;
        
        //unset user session and logs them out
        case "logout":
        {
            $tbl_name="tbl_student";
            $username=$_SESSION['student'];
            $student_id=$obj->get_userid($tbl_name,$username,$conn);
            $res=true;
            if($res==true)
            {
                //Set student active status to "no"
                $tbl_name3="tbl_student";
                $data3="is_active='no'";
                $where3="student_id='$student_id'";
                $query3=$obj->update_data($tbl_name3,$data3,$where3);
                $res3=$obj->execute_query($conn,$query3);
                if($res3===true)
                {
                    session_destroy();
                    header('location:'.SITEURL.'index.php?page=login');
                }
                else
                {
                    echo "Error";
                }
                
            }
            else
            {
                echo "Error";
            }
        }
        break;
        
        default:
        {
            include('dashboard.php');
        }
        break;
    }
?>