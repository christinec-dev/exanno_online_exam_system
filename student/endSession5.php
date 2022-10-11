<?php 
    //session check
    include('check.php');
    //Inserting Summary Result Here
    if(isset($_SESSION['totalScore']))
    {
        $totalScore=$_SESSION['totalScore']; 
    }
    else
    {
        $totalScore=0;
    }      
    //To get student details
    $tbl_name="tbl_student";
    $username=$_SESSION['student'];
    $student_id=$obj->get_userid($tbl_name,$username,$conn);
    //To get faculty detail
    $tbl_name1="tbl_faculty";           
    $subject=$obj->get_subjectfive($tbl_name1,$conn);
    $obtainedMarks=$_SESSION['totalScore'];
    $full_marks=$_SESSION['full_marks'];
    $obtainedPercent=($obtainedMarks/$full_marks)*100;
    //To add result summary to the database
    $added_date=date('Y-m-d');
    $tbl_name2="tbl_result_summary";
    $data="student_id='$student_id',
            subject='$subject',
            marks='$obtainedPercent',
            added_date='$added_date'";
    $query=$obj->insert_data($tbl_name2,$data);
    $res=$obj->execute_query($conn,$query);
?>

<!--Exam End Session Page Starts here-->
    <div class="main">
            <div class="content">
                <div class="welcome">
                    <?php 
                        if(isset($_SESSION['time_complete']))
                        {
                            echo $_SESSION['time_complete'];
                        }
                    ?>
                    <p class="congrats-text">Examination Complete</p>
                     <?php 
                        $tbl_name='tbl_student';
                        $username=$_SESSION['student'];
                        $userid=$obj->get_userid($tbl_name,$username,$conn);
                        $tbl_name3="tbl_result_summary";
                        $where3="student_id=$userid ORDER BY summary_id DESC LIMIT 1";
                        $query2=$obj->select_data($tbl_name3,$where3); 
                        $res=mysqli_query($conn,$query2);
                        $row=$obj->fetch_data($res);
                        $marks=$row['marks'];
                        $added_date=date('Y-m-d');
                        $obtainedMarks=$_SESSION['totalScore'];
                        $full_marks=$_SESSION['full_marks'];
                        $obtainedPercent=($obtainedMarks/$full_marks)*100;
                        $marksShown=$obtainedMarks;
                        $_SESSION['USERID']= $userid;
                        $lastDigit=substr($marksShown,-1);
                        $realMark=$marksShown;
                     ?>
                     
                     <p><span>Subject: </span><?php echo $subject;?></p>
                     <p><span>Final Result: </span><?php echo $realMark;?> / <?php echo $full_marks;?></p>
                     <p><span>Percentage Obtained: </span><?php echo $obtainedPercent; ?>%</p>

                     <a href="<?php echo SITEURL; ?>index.php?page=feedback">
                        <button type="button" class="btn-exit">
                            View Result Summary
                        </button>
                     </a>

                    <a href="<?php echo SITEURL; ?>index.php?page=logout">
                        <button type="button" class="btn-exit">&nbsp; Log Out &nbsp;</button>
                    </a>
                </div>
            </div>
        </div>
<!--Exam End Session Page Ends here-->
