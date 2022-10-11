<!--Update Faculty Page Starts Here-->
<?php 
    //Gets data from db table
    if(isset($_GET['id']))
    {
        $faculty_id=$_GET['id'];
        $tbl_name="tbl_faculty";
        $where="faculty_id=$faculty_id";
        $query=$obj->select_data($tbl_name,$where);
        $res=$obj->execute_query($conn,$query);
        $count_rows=$obj->num_rows($res);
        if($count_rows==1)
        {
            $row=$obj->fetch_data($res);
            $faculty_name=$row['faculty_name'];
            $time_duration=$row['time_duration'];
            $qns_per_page=$row['qns_per_set'];
            $subject_one=$row['subject_one'];
            $subject_two=$row['subject_two'];
            $subject_three=$row['subject_three'];
            $subject_four=$row['subject_four'];
            $subject_five=$row['subject_five'];
            $is_active=$row['is_active'];
        }
        else
        {
            header('location:'.SITEURL.'admin/index.php?page=faculties');
        }
    }
    else
    {
        header('location:'.SITEURL.'admin/index.php?page=faculties');
    }
?>
<div class="main">
    <div class="content">
        <div class="report">
            <!--Form to update data-->
            <form method="post" action="" class="forms">
                <h2>Update Faculty</h2>
                <!--Session check-->
                <?php 
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                ?>
                <span class="name">Faculty Title</span> 
                <input type="text" name="faculty_name" value="<?php echo $faculty_name; ?>" required="true" /> <br />
                
                <span class="name">Time Duration</span>
                <input type="number" name="time_duration" value="<?php echo $time_duration; ?>" required="true" /><br />
                
                <span class="name">Questions/Set</span>
                <input type="number" name="qns_per_page" value="<?php echo $qns_per_page; ?>" required="true" /><br />
                
                <span class="name">Subject One</span>
                <input type="text" name="subject_one_qns" value="<?php echo $subject_one; ?>" required="true" /><br />
                
                <span class="name">Subject Two</span>
                <input type="text" name="subject_two_qns" value="<?php echo $subject_two; ?>" /><br />

                <span class="name">Subject Three</span>
                <input type="text" name="subject_three_qns" value="<?php echo $subject_three; ?>" required="true" /><br />
                
                <span class="name">Subject Four</span>
                <input type="text" name="subject_four_qns" value="<?php echo $subject_four; ?>" /><br />
                
                <span class="name">Subject Five</span>
                <input type="text" name="subject_five_qns" value="<?php echo $subject_five; ?>" required="true" /><br />

                <span class="name">Is Active?</span>
                <input <?php if($is_active=="yes"){echo "checked='checked'";} ?> type="radio" name="is_active" value="yes" /> Yes 
                <input <?php if($is_active=="no"){echo "checked='checked'";} ?> type="radio" name="is_active" value="no" /> No
                <br />
                
                <input type="submit" name="submit" value="UPDATE"  class="btn-add" />
                <a href="<?php echo SITEURL; ?>admin/index.php?page=faculties"><button type="button" class="btn-delete">CANCEL</button></a>
            </form>
            <!--Submits updated data-->
            <?php 
                if(isset($_POST['submit']))
                {
                    //Getting all the values from the forms
                    $faculty_name=$obj->sanitize($conn,$_POST['faculty_name']);
                    $time_duration=$obj->sanitize($conn,$_POST['time_duration']);
                    $qns_per_page=$obj->sanitize($conn,$_POST['qns_per_page']); 
                    $subject_one=$obj->sanitize($conn,$_POST['subject_one_qns']);
                    $subject_two=$obj->sanitize($conn,$_POST['subject_two_qns']);
                    $subject_three=$obj->sanitize($conn,$_POST['subject_three_qns']);
                    $subject_four=$obj->sanitize($conn,$_POST['subject_four_qns']);
                    $subject_five=$obj->sanitize($conn,$_POST['subject_five_qns']);
                    $is_active=$obj->sanitize($conn,$_POST['is_active']);
                    $updated_date=date('Y-m-d');
                    //Adding updated data to table
                    $tbl_name='tbl_faculty';
                    $data="faculty_name='$faculty_name',
                            time_duration='$time_duration',
                            qns_per_set='$qns_per_page',
                            subject_one='$subject_one',
                            subject_two='$subject_two',
                            subject_three='$subject_three',
                            subject_four='$subject_four',
                            subject_five='$subject_five',
                            is_active='$is_active',
                            updated_date='$updated_date'";
                    $where="faculty_id='$faculty_id'";
                    $query=$obj->update_data($tbl_name,$data,$where);
                    $res=$obj->execute_query($conn,$query);
                    if($res===true)
                    {
                        //success
                        $_SESSION['update']="<div class='success'>Faculty successfully updated.</div>";
                        header('location:'.SITEURL.'admin/index.php?page=faculties');
                    }
                    else
                    {
                        //fail
                        $_SESSION['update']="<div class='error'>Failed to update faculty. Please try again.</div>";
                        header('location:'.SITEURL.'admin/index.php?page=update_faculty&id='.$faculty_id);
                    }
                }
            ?>
        </div>
    </div>
</div>
<!--Update Faculty Page Ends Here-->