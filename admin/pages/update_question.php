<!--Update Exam Question Page Starts Here-->
<?php 
    //Gets question data from db
    if(isset($_GET['id']))
    {
        $question_id=$_GET['id'];
        $tbl_name='tbl_question';
        $where="question_id=$question_id";
        $query=$obj->select_data($tbl_name,$where);
        $res=$obj->execute_query($conn,$query);
        $count_rows=$obj->num_rows($res);
        if($count_rows==1)
        {
            $row=$obj->fetch_data($res);
            $question=$row['question'];
            $first_answer=$row['first_answer'];
            $second_answer=$row['second_answer'];
            $third_answer=$row['third_answer'];
            $fourth_answer=$row['fourth_answer'];
            $fifth_answer=$row['fifth_answer'];
            $answer=$row['answer'];
            $reason=$row['reason'];
            $marks=$row['marks'];
            $category=$row['category'];
            $faculty_db=$row['faculty'];
            $is_active=$row['is_active'];
            $previous_image=$row['image_name'];
        }
        else
        {
            header('location:'.SITEURL.'admin/index.php?page=questions');
        }
    }
    else
    {
        header('location:'.SITEURL.'admin/index.php?page=questions');
    }
?>

<div class="main">
    <div class="content">
        <div class="report">
            <!--Form to update data-->
            <form method="post" action="" class="forms" enctype="multipart/form-data">
                <h2>Update Question</h2>
                <!--Session check-->
                <?php 
                    if(isset($_SESSION['validation']))
                    {
                        echo $_SESSION['validation'];
                        unset($_SESSION['validation']);
                    }
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                ?>
                <!--Question details-->
                <p class="instructions">Question Details</p>
                <span class="name">Question</span><br />
                <textarea name="question" required="true"><?php echo $question; ?></textarea> <br />
                <script>
                    CKEDITOR.replace( 'question' );
                </script>
                <?php 
                    if($previous_image!="")
                    {
                        ?>
                        <span class="name">Previous Image</span>
                        <img src="<?php echo SITEURL; ?>images/questions/<?php echo $previous_image; ?>" /> <br />
                        <?php
                    }
                ?>
                <input type="hidden" name="previous_image" value="<?php echo $previous_image; ?>" />
                <span class="name">New Image</span>
                <input type="file" name="image" /><br />

                <!--Question answers-->
                <p class="instructions">Question Answers:</p>
                <span class="name">First Answer</span>
                <input type="text" name="first_answer" value="<?php echo $first_answer;; ?>" required="true" />
                <br />
                <span class="name">Second Answer</span>
                <input type="text" name="second_answer" value="<?php echo $second_answer; ?>" required="true" />
                <br />
                <span class="name">Third Answer</span>
                <input type="text" name="third_answer" value="<?php echo $third_answer; ?>" required="true" />
                <br />
                <span class="name">Fourth Answer</span>
                <input type="text" name="fourth_answer" value="<?php echo $fourth_answer; ?>" required="true" />
                <br />
                <span class="name">Fifth Answer</span>
                <input type="text" name="fifth_answer" value="<?php echo $fifth_answer; ?>" required="true" />
                <br />
                
                <span class="name">Answer</span>
                <select name="answer" style=" margin-top: 1em !important;">
                    <option <?php if($answer==1){echo "selected='seleccted'";} ?> value="1">First Answer</option>
                    <option <?php if($answer==2){echo "selected='seleccted'";} ?> value="2">Second Answer</option>
                    <option <?php if($answer==3){echo "selected='seleccted'";} ?> value="3">Third Answer</option>
                    <option <?php if($answer==4){echo "selected='seleccted'";} ?> value="4">Fourth Answer</option>
                    <option <?php if($answer==5){echo "selected='seleccted'";} ?> value="5">Fifth Answer</option>
                </select>
                <br />
                <!--Question feedback-->               
                <p class="instructions">Question Feedback:</p>
                
                <span class="name">Reason</span><br />
                <textarea name="reason" ><?php echo $reason; ?></textarea>
                <script>
                    CKEDITOR.replace( 'reason' );
                </script>
                <br />
                
                <!--Extra details-->
                <p class="instructions">Question Details:</p>
                <span class="name">Mark Allocation</span>
                <input type="text" name="marks" value="<?php echo $marks; ?>" />
                <br />
                <span class="name">Subject</span>
                <select name="category" style=" margin-top: 1em !important;">
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
                <input <?php if($is_active=='yes'){echo "checked='checked'";} ?> type="radio" name="is_active" value="yes" style=" margin-top: 1em !important;" /> Yes 
                <input <?php if($is_active=='no'){echo "checked='checked'";} ?> type="radio" name="is_active" value="no" style=" margin-top: 1em !important;"/> No
                <br />

                <div  style="margin-top: 1em !important;"></div>
                <span class="name">Scheduled Date</span>
                <input type="date" name="active_date">
                <div  style="margin-top: 1em !important;"></div>

                <input type="submit" name="submit" value="UPDATE" class="btn-update2" />
                <a href="<?php echo SITEURL; ?>admin/index.php?page=questions"><button type="button" class="btn-delete">CANCEL</button></a>
            </form>
            <!--Submits updated data-->
            <?php 
                if(isset($_POST['submit']))
                {
                    //gets values from input fields and sanitizes data
                    $question=$obj->sanitize($conn,$_POST['question']);
                    $first_answer=$obj->sanitize($conn,$_POST['first_answer']);
                    $second_answer=$obj->sanitize($conn,$_POST['second_answer']);
                    $third_answer=$obj->sanitize($conn,$_POST['third_answer']);
                    $fourth_answer=$obj->sanitize($conn,$_POST['fourth_answer']);
                    $fifth_answer=$obj->sanitize($conn,$_POST['fifth_answer']);
                    $answer=$obj->sanitize($conn,$_POST['answer']);
                    $reason=$obj->sanitize($conn,$_POST['reason']);
                    $marks=$obj->sanitize($conn,$_POST['marks']);
                    $category=$obj->sanitize($conn,$_POST['category']);
                    $faculty=$obj->sanitize($conn,$_POST['faculty']);
                    $previous_image=$_POST['previous_image'];
                    $active_date=$_POST['active_date'];
                    if(isset($_POST['is_active']))
                    {
                        $is_active=$_POST['is_active'];
                    }
                    else
                    {
                        $is_active="yes";
                    }
                    $updated_date=date('Y-m-d');

                    //Managing question images
                    if($_FILES['image']['name']!="")
                    {
                        //Getting File Extension
                        $ext=end(explode('.',$_FILES['image']['name']));
                        //Checking if the file type is valid or not (must be image)
                        $valid_file=$obj->check_image_type($ext);
                        if($valid_file==false)
                        {
                            $_SESSION['invalid']="<div class='error'>Invalid Image type. Please use JPG or PNG or GIF file type.</div>";
                            header('location:'.SITEURL.'admin/index.php?page=update_question&id='.$question_id);
                            die();
                        }
                        //Removing Previous Image
                        if($previous_image!="")
                        {
                            $path="../images/questions/".$previous_image;
                            $remove=$obj->remove_file($path);
                            if($remove==false)
                            {
                                $_SESSION['remove_book']="Failed to remove previous Image. Try again.";
                                header('location:'.SITEURL.'admin/index.php?page=update_question&id='.$question_id);
                                die();
                            }
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
                            header('location:'.SITEURL.'admin/index.php?page=update_question&id='.$question_id);
                            die();
                        }
                    }
                    else
                    {
                        $image_name=$previous_image;
                    }
                    
                    //Validation
                    if(($question==null)or($first_answer==null)or($second_answer==null)or($third_answer==null)or($fourth_answer==null)or($answer==null))
                    {
                        $_SESSION['validation']="<div class='error'>Either Question or One of the Answers field is empty.</div>";
                        header('location:'.SITEURL.'admin/index.php?page=update_question&id='.$question_id);
                    }

                    //Adding updated data to the db
                    $tbl_name="tbl_question";
                    $data="
                            question='$question',
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
                            updated_date='$updated_date',
                            image_name='$image_name',
                            active_date='$active_date'
                    ";
                    $where="question_id='$question_id'";
                    $query=$obj->update_data($tbl_name,$data,$where);
                    $res=$obj->execute_query($conn,$query);
                    if($res===true)
                    {
                        //success
                        $_SESSION['update']="<div class='success'>Question successfully updated.</div>";
                        header('location:'.SITEURL.'admin/index.php?page=questions');
                    }
                    else
                    {
                        //fail
                        $_SESSION['update']="<div class='error'>Failed to update question.</div>";
                        header('location:'.SITEURL.'admin/index.php?page=update_question&id='.$question_id);
                    }
                }
            ?>
        </div>
    </div>
</div>
<!--Update Exam Question Page Ends Here-->