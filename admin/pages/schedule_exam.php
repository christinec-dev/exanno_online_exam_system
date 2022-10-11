<!--Examination Schedule Add Page Starts Here-->
<div class="main">
    <div class="content">
        <div class="report">
        <!--Schedule input form-->
            <form method="post" action="" class="forms" enctype="multipart/form-data">
                <h2>Schedule Examination</h2>
                <!--Session check-->
                <?php 
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
                    if(isset($_SESSION['invalid']))
                    {
                        echo $_SESSION['invalid'];
                        unset($_SESSION['invalid']);
                    }

                    if(isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }

                ?>
                <!--Schedule-->
                <span class="name">Subject</span>
                <select name="category" style=" margin-top: 1em !important;">
                    <?php 
                        //Get faculties from database
                        $tbl_name="tbl_faculty";
                        $query=$obj->select_data($tbl_name);
                        $res=$obj->execute_query($conn,$query);
                        $count_rows=$obj->num_rows($res);
                        if($count_rows>0)
                        {
                            while($row=$obj->fetch_data($res))
                            {
                                $faculty_id=$row['faculty_id'];
                                $subject_one=$row['subject_one'];
                                $subject_two=$row['subject_two'];
                                $subject_three=$row['subject_three'];
                                $subject_four=$row['subject_four'];
                                $subject_five=$row['subject_five'];
                                ?>
                                <option value="<?php echo $subject_one; ?>"><?php echo $subject_one; ?></option>
                                <option value="<?php echo $subject_two; ?>"><?php echo $subject_two; ?></option>
                                <option value="<?php echo $subject_three; ?>"><?php echo $subject_three; ?></option>
                                <option value="<?php echo $subject_four; ?>"><?php echo $subject_four; ?></option>
                                <option value="<?php echo $subject_five; ?>"><?php echo $subject_five; ?></option>
                                <?php
                            }
                        }
                        else
                        {
                            ?>
                            <option value="0">Uncategorized</option>
                            <?php
                        }
                    ?>
                </select>
                <br />
                <span class="name">Scheduled Date</span>
                <input type="date" name="active_date">
                <div  style="margin-top: 1em !important;"></div>
                <input type="submit" name="submit" value="Schedule Exam" class="btn-update2" />
                <a href="<?php echo SITEURL; ?>admin/index.php?page=Schedules"><button type="button" class="btn-delete">CANCEL</button></a>
            </form>
            <!--Mass Schedule Exam-->
            <?php 
                if(isset($_POST['submit']))
                {
                    $category=$obj->sanitize($conn,$_POST['category']);
                    $active_date=$obj->sanitize($conn,$_POST['active_date']);
                    $tbl_name='tbl_question';
                    $data="category='$category',
                            active_date='$active_date'
                            ";
                    //insert data to db table
                    $where="category='$category'";
                    $query=$obj->update_data($tbl_name,$data,$where);
                    $res=$obj->execute_query($conn,$query);
                    if($res===true)
                    {
                        //success
                        $_SESSION['add']="<div class='success'>Exam successfully scheduled.</div>";
                        header('location:'.SITEURL.'admin/index.php?page=Schedules');
                    }
                    else
                    {
                        //fail
                        $_SESSION['add']="<div class='error'>Failed to schedule exam. Try again.</div>";
                        header('location:'.SITEURL.'admin/index.php?page=schedule');
                    }
                }
            ?>
        </div>
    </div>
</div>

<!--Examination Schedule Add Page Ends Here-->