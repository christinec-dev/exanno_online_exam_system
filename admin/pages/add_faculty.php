<!--Faculty Add Page Starts Here-->
<div class="main">
    <div class="content">
        <div class="report">                    
            <!--Faculty input form-->
            <form method="post" action="" class="forms">
                <h2>Add Faculty</h2>
                <!--session check-->
                <?php 
                    if(isset($_SESSION['validation']))
                    {
                        echo $_SESSION['validation'];
                        unset($_SESSION['validation']);
                    }
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
                ?>
                <span class="name">Faculty Title</span> 
                <input type="text" name="faculty_name" placeholder="Faculty Title" required="true" /> <br />
                
                <span class="name">Time Duration</span>
                <input type="text" name="time_duration" placeholder="Allocated Exam Time in Minutes" required="true" /><br />
                
                <span class="name">Questions/Set</span>
                <input type="text" name="qns_per_page" placeholder="Total Questions Per Exam" required="true" /><br />
                
                <span class="name">Subject One</span>
                <input type="text" name="subject_one_qns" required="true" /><br />
                
                <span class="name">Subject Two</span>
                <input type="text" name="subject_two_qns"  /><br />

                <span class="name">Subject Three</span>
                <input type="text" name="subject_three_qns"required="true" /><br />
                
                <span class="name">Subject Four</span>
                <input type="text" name="subject_four_qns"  /><br />
                
                <span class="name">Subject Five</span>
                <input type="text" name="subject_five_qns" required="true" /><br />

                <span class="name">Is Active?</span>
                <input type="radio" name="is_active" value="yes" /> Yes 
                <input type="radio" name="is_active" value="no" /> No
                <br />
                
                <input type="submit" name="submit" value="Add Faculty" class="btn-add" style="margin-left: 15%;" />
                <a href="<?php echo SITEURL; ?>admin/index.php?page=faculties">
                    <button type="button" class="btn-delete">Cancel</button>
                </a>
            </form>
            <!--Faculty input validation-->
            <?php 
                if(isset($_POST['submit']))
                {
                    //Get values from the form
                    $faculty_name=$obj->sanitize($conn,$_POST['faculty_name']);
                    $time_duration=$obj->sanitize($conn,$_POST['time_duration']);
                    $qns_per_page=$obj->sanitize($conn,$_POST['qns_per_page']);
                    $subject_one=$obj->sanitize($conn,$_POST['subject_one_qns']);
                    $subject_two=$obj->sanitize($conn,$_POST['subject_two_qns']);
                    $subject_three=$obj->sanitize($conn,$_POST['subject_three_qns']);
                    $subject_four=$obj->sanitize($conn,$_POST['subject_four_qns']);
                    $subject_five=$obj->sanitize($conn,$_POST['subject_five_qns']);
                    if(isset($_POST['is_active']))
                    {
                        $is_active=$obj->sanitize($conn,$_POST['is_active']);
                    }
                    else
                    {
                        $is_active="yes";
                    }
                    $added_date=date('Y-m-d');
                    $updated_date=date('Y-m-d');
                    //Validation
                    if(($faculty_name=="")||($time_duration=="")||($qns_per_page==""))
                    {
                        $_SESSION['validation']="<div class='error'>Faculty name or Time Duration or Question Per Page is Empty.</div>";
                        header('location:'.SITEURL.'admin/index.php?page=add_faculty');
                    }
                    //Inserting new data into the database
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
                            added_date='$added_date',
                            updated_date='$updated_date'";
                    //Query to insert data
                    $query=$obj->insert_data($tbl_name,$data);
                    $res=$obj->execute_query($conn,$query);
                    if($res===true)
                    {
                        //Success Message
                        $_SESSION['add']="<div class='success'>New faculty successfully added.</div>";
                        header('location:'.SITEURL.'admin/index.php?page=faculties');
                    }
                    else
                    {
                        //Fail Message
                        $_SESSION['add']="<div class='error'>Failed to add new faculty. Try again.</div>";
                        header('location:'.SITEURL.'admin/index.php?page=add_faculty');
                    }
                }
            ?>
        </div>
    </div>
</div>
<!--Faculty Add Page Ends Here-->