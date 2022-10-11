<!--Update Student Results Starts Here-->
<?php 
    //Gets result details from db
    if(isset($_GET['summary_id']))
    {
        $summary_id=$_GET['summary_id'];
        $tbl_name="tbl_result_summary";
        $where="summary_id=$summary_id";
        $query=$obj->select_data($tbl_name,$where);
        $res=$obj->execute_query($conn,$query);
        $count_rows=$obj->num_rows($res);
        if($count_rows==1)
        {
            $row=$obj->fetch_data($res);
            $subject=$row['subject'];
            $student_id=$row['student_id'];
            $marks=$row['marks'];
            $added_date=$row['added_date'];
        }
        else
        {
            header('location:'.SITEURL.'admin/index.php?page=results');
        }
    }
    else
    {
        header('location:'.SITEURL.'admin/index.php?page=results');
    }
?>

<div class="main">
    <div class="content">
        <div class="report">
            <!--Form to update data-->
            <form method="post" action="" class="forms">
                <h2>Update Result</h2>
                <!--Session check-->
                <?php 
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                ?>
                <div class="results">
                    <div class="row">
                        <p class="feedback">Student ID:</p> 
                        <p><?php echo $student_id; ?></p>
                        <br />
                        <p class="feedback">Subject Taken:</p> 
                        <p><?php echo $subject; ?></p>
                        <br />
                        <p class="feedback">Percentage Obtained:</p> 
                        <input type="decimal" name="marks" value="<?php echo $marks; ?>" required="true" class="marks"/> 
                    </div>
                </div>

                <input type="submit" name="submit" value="UPDATE"  class="btn-update2"/>
                <a href="<?php echo SITEURL; ?>admin/index.php?page=results"><button type="button" class="btn-delete">CANCEL</button></a>
            </form>
            <!--Submits updated data-->
            <?php 
                if(isset($_POST['submit']))
                {
                    $marks=$obj->sanitize($conn,$_POST['marks']);
                    $tbl_name='tbl_result_summary';
                    $today=date("Y-m-d");
                    $data="marks='$marks'";
                    $where="summary_id='$summary_id'";
                    $query=$obj->update_data($tbl_name,$data,$where);
                    $res=$obj->execute_query($conn,$query);
                    if($res===true)
                    {
                        //success
                        $_SESSION['update']="<div class='success'>Results successfully updated.</div>";
                        header('location:'.SITEURL.'admin/index.php?page=update_results');
                    }
                    else
                    {
                        //fail
                        $_SESSION['update']="<div class='error'>Failed to update results. Please try again.</div>";
                        header('location:'.SITEURL.'admin/index.php?page=update_results&id='.$summary_id);
                    }
                }
            ?>
        </div>
    </div>
</div>
<!--Update Student Results Ends Here-->