<?php 
    //session check
    include('../config/session.php');
    //Get the values from URL
    if((isset($_GET['summary_id']))&&(isset($_GET['student_id']))&&(isset($_GET['added_date'])))
    {
        $summary_id=$_GET['summary_id'];
        $student_id=$_GET['student_id'];
        $added_date=$_GET['added_date'];
        //Deleting result record from tbl_result_summary
        $tbl_name="tbl_result_summary";
        $where="summary_id='$summary_id'";
        $query=$obj->delete_data($tbl_name,$where);
        $res=$obj->execute_query($conn,$query);
        if($res==true)
        {
            $tbl_name2="tbl_result";
            $where2="student_id='$student_id' && added_date='$added_date'";
            $query2=$obj->delete_data($tbl_name2,$where2);
            $res2=$obj->execute_query($conn,$query2);
            //record delete success
            if($res2==true)
            {
                $_SESSION['delete']="<span class='success'>Result successfully deleted.</span>";
                header('location:'.SITEURL.'admin/index.php?page=results');
            }
            //record delete error
            else
            {
                $_SESSION['delete']="<span class='error'>Failed to delete result.</span>";
                header('location:'.SITEURL.'admin/index.php?page=results');
            }
        }
    }
    else
    {
        header('location:'.SITEURL.'admin/index.php?page=results');
    }
?>