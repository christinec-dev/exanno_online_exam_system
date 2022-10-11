<!--Examination Question Add Page Starts Here-->
<div class="main">
    <div class="content">
        <div class="report">
        <!--Question input form-->
            <form method="post" action="" class="forms" enctype="multipart/form-data">
                <h2>Add Question</h2>
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
                <!--Question-->
                <p class="instructions">Question:</p>
                <textarea name="question" placeholder="Add Your Question" required="true"></textarea> <br />
                <script>
                    CKEDITOR.replace( 'question' );
                </script>
                <span class="name">Image (Optional)</span>
                <input type="file" name="image" /><br />

                <!--Question answers-->
                <p class="instructions">Question Answers:</p>
                <span class="name">Answer One</span>
                <input type="text" name="first_answer" placeholder="Answer One" required="true" /><br />
                <span class="name">Answer Two</span>
                <input type="text" name="second_answer" placeholder="Answer Two" required="true" /><br />
                <span class="name">Answer Three</span>
                <input type="text" name="third_answer" placeholder="Answer Three" required="true" /><br />
                <span class="name">Answer Four</span>
                <input type="text" name="fourth_answer" placeholder="Answer Four" required="true" /><br />
                <span class="name">Answer Five</span>
                <input type="text" name="fifth_answer" placeholder="Answer Five" required="true" /><br />
                
                <span class="name">Correct Answer:</span>
                <select name="answer" style=" margin-top: 1em !important;">
                    <option value="1">Answer One</option>
                    <option value="2">Answer Two</option>
                    <option value="3">Answer Three</option>
                    <option value="4">Answer Four</option>
                    <option value="5">Answer Five</option>
                </select>
                <br />
                
                <!--Question feedback-->
                <p class="instructions">Question Feedback:</p> 
                <span>Reason:</span>
                <textarea name="reason" placeholder="Reason to be the answer"></textarea>
                <script>
                    CKEDITOR.replace( 'reason' );
                </script>
                <br />

                <!--Question details-->
                <p class="instructions">Question Details:</p>
                <span class="name">Mark Allocation</span>
                <input type="text" name="marks" placeholder="Marks Allocated to Question" />
                <br />
                <span class="name">Question Subject</span>
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
                
                <!--Faculty details-->
                <span class="name">Faculty</span>
                <select name="faculty" style=" margin-top: 1em !important;">
                    <?php 
                        //Get Faculties from database
                        $tbl_name="tbl_faculty";
                        $query=$obj->select_data($tbl_name);
                        $res=$obj->execute_query($conn,$query);
                        $count_rows=$obj->num_rows($res);
                        if($count_rows>0)
                        {
                            while($row=$obj->fetch_data($res))
                            {
                                $faculty_id=$row['faculty_id'];
                                $faculty_name=$row['faculty_name'];
                                ?>
                                <option value="<?php echo $faculty_id; ?>"><?php echo $faculty_name; ?></option>
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

                <span class="name">Active Question?</span>
                <input type="radio" name="is_active" value="yes" style="margin-top: 1em !important;"/> Yes 
                <input type="radio" name="is_active" value="no" style="margin-top: 1em !important;"/> No <br />
                <div  style="margin-top: 1em !important;"></div>
                
                <span class="name">Scheduled Date</span>
                <input type="date" name="active_date">

                <div  style="margin-top: 1em !important;"></div>
                <input type="submit" name="submit" value="ADD QUESTION" class="btn-update2" />
                <a href="<?php echo SITEURL; ?>admin/index.php?page=questions"><button type="button" class="btn-delete">CANCEL</button></a>
            </form>
            <!--Add question to db-->
            <?php 
                if(isset($_POST['submit']))
                {
                    //Managing Question Images
                    if($_FILES['image']['name']!="")
                    {
                        //Getting File Extension
                        $ext=end(explode('.',$_FILES['image']['name']));
                        //Checking if the file type is valid or not (must be image)
                        $valid_file=$obj->check_image_type($ext);
                        if($valid_file==false)
                        {
                            $_SESSION['invalid']="<div class='error'>Invalid Image type. Please use JPG or PNG or GIF file type.</div>";
                            header('location:'.SITEURL.'admin/index.php?page=add_question');
                            die();
                        }
                        //Uploading if the file is valid
                        $new_name='Exam_Question_'.$obj->uniqid();
                        $image_name=$new_name.'.'.$ext;
                        $source=$_FILES['image']['tmp_name'];
                        $destination="../images/questions/".$image_name;
                        $upload=$obj->upload_file($source,$destination);
                        if($upload==false)
                        {
                            $_SESSION['upload']="<div class='error'>Failed to upload question image. Try again.</div>";
                            header('location:'.SITEURL.'admin/index.php?page=add_question');
                            die();
                        }
                    }
                    else
                    {
                        $image_name="";
                    }
                    //Get all values from the forms & santizing input
                    $question=$obj->sanitize($conn,$_POST['question']);
                    $first_answer=$obj->sanitize($conn,$_POST['first_answer']);
                    $second_answer=$obj->sanitize($conn,$_POST['second_answer']);
                    $third_answer=$obj->sanitize($conn,$_POST['third_answer']);
                    $fourth_answer=$obj->sanitize($conn,$_POST['fourth_answer']);
                    $fifth_answer=$obj->sanitize($conn,$_POST['fifth_answer']);
                    $faculty=$obj->sanitize($conn,$_POST['faculty']);
                    if(isset($_POST['is_active']))
                    {
                        $is_active=$_POST['is_active'];
                    }
                    else
                    {
                        $is_active='yes';
                    }
                    $answer=$obj->sanitize($conn,$_POST['answer']);
                    $reason=$obj->sanitize($conn,$_POST['reason']);
                    $marks=$obj->sanitize($conn,$_POST['marks']);
                    $category=$obj->sanitize($conn,$_POST['category']);
                    $added_date=date('Y-m-d');
                    $updated_date=date('Y-m-d');
                    $active_date=$obj->sanitize($conn,$_POST['active_date']);
                    $tbl_name='tbl_question';
                    $data="question='$question',
                            first_answer='$first_answer',
                            second_answer='$second_answer',
                            third_answer='$third_answer',
                            fourth_answer='$fourth_answer',
                            fifth_answer='$fifth_answer',
                            answer='$answer',
                            reason='$reason',
                            marks='$marks',
                            category='$category',
                            faculty='$faculty',
                            is_active='$is_active',
                            added_date='$added_date',
                            updated_date='$updated_date',
                            image_name='$image_name',
                            active_date='$active_date'
                            ";
                    //insert data to db table
                    $query=$obj->insert_data($tbl_name,$data);
                    $res=$obj->execute_query($conn,$query);
                    if($res===true)
                    {
                        //success
                        $_SESSION['add']="<div class='success'>Question successfully added.</div>";
                        header('location:'.SITEURL.'admin/index.php?page=questions');
                    }
                    else
                    {
                        //fail
                        $_SESSION['add']="<div class='error'>Failed to add question. Try again.</div>";
                        header('location:'.SITEURL.'admin/index.php?page=add_question');
                    }
                }
            ?>
        </div>
    </div>
</div>
<!--Examination Question Add Page Ends Here-->