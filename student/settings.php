<?php 
    //gets session detail from student table and fills in input fields
    if(isset($_SESSION['student']))
    {
        $username=$_SESSION['student'];
        $tbl_name="tbl_student";
        $where="username='$username'";
        $query=$obj->select_data($tbl_name,$where);
        $res=$obj->execute_query($conn,$query);
        $count_rows=$obj->num_rows($res);
        if($count_rows==1)
        {
            $row=$obj->fetch_data($res);
            $student_id=$row['student_id'];
            $first_name=$row['first_name'];
            $last_name=$row['last_name'];
            $email=$row['email'];
            $username=$row['username'];
            $password=$row['password'];
            $contact=$row['contact'];
        }
        else
        {
            header('location:'.SITEURL.'/login.php');
        }
    }
    else
    {
        header('location:'.SITEURL.'/index.php?page=logout');
    }
?>
<!--Student Profile Details Page Starts Here-->
        <div class="main">
            <div class="content">
                <div class="report">
                        <!--------------Session validation----------------------->
                        <?php 
                            if(isset($_SESSION['update']))
                            {
                                echo $_SESSION['update'];
                                unset($_SESSION['update']);
                            }
                            if(isset($_SESSION['invalid']))
                            {
                                echo $_SESSION['invalid'];
                                unset($_SESSION['invalid']);
                            }
                            if(isset($_SESSION['password']))
                            {
                                echo $_SESSION['password'];
                                unset($_SESSION['password']);
                            }
                            if(isset($_SESSION['not_match']))
                            {
                                echo $_SESSION['not_match'];
                                unset($_SESSION['not_match']);
                            }
                        ?>
                    
                    <!--------------Input validation----------------------->
                    <?php 
                        if(isset($_POST['submit']))
                        {
                           $first_name=$obj->sanitize($conn,$_POST['first_name']);
                           $last_name=$obj->sanitize($conn,$_POST['last_name']);
                           $email=$obj->sanitize($conn,$_POST['email']);         
                           $username=$obj->sanitize($conn,$_POST['username']);
                           $contact=$obj->sanitize($conn,$_POST['contact']);
                           $current_password=$obj->sanitize($conn,$_POST['current_password']);
                           
                           if(($first_name=="")or($last_name=="")or($email=="")or($username=="")or($contact=="")or($current_password==""))
                           {
                                $_SESSION['validation']="<div class='error'>App Name or Email or Username or Contact or Password is Empty.</div>";
                                header('location:'.SITEURL.'/index.php?page=settings');
                           }

                           if($current_password==$password)
                           {
                                $tbl_name="tbl_student";
                                $data="first_name='$first_name',
                                last_name='$last_name',
                                email='$email',
                                username='$username',
                                contact='$contact'";
                            
                            $where="student_id=$student_id";
                            $query=$obj->update_data($tbl_name,$data,$where);
                            $res=$obj->execute_query($conn,$query);
                            if($res===true)
                            {
                                $_SESSION['update']="<div class='success'>User details successfully updated.</div>";
                                header('location:'.SITEURL.'/index.php?page=settings');
                            }
                            else
                            {
                                $_SESSION['update']="<div class='error'>Failed to update user details.</div>";
                                header('location:'.SITEURL.'/index.php?page=settings');
                            }
                           }
                           else{
                            $_SESSION['invalid']="<div class='error'>Current Password did not match.</div>";
                                header('location:'.SITEURL.'/index.php?page=settings');
                           }
                        }
                    ?>
                </div>
                
                <!--------------User input fields----------------------->
                <div class="report">
                    <form method="post" action="" class="forms">
                        <h2>Update Profile</h2>
                        <div class="row"  style="margin-bottom:3%">
                            <div class="col-2">  <span class="details">Current User:</span>
                                <span class="heavy">
                                    <?php 
                                        echo $_SESSION['student']; 
                                    ?>
                                </span>
                            </div> 
                            <div class="col-4">  
                                <span class="details">Current Date:</span>
                                <?php 
                                    echo date("Y-m-d h:i:sa");
                                ?>
                            </div>
                        </div>

                        <span class="name">First Name</span>
                        <input type="text" name="first_name" value="<?php echo $first_name; ?>" required="true" /><br />
                        
                        <span class="name">Last Name</span>
                        <input type="text" name="last_name" value="<?php echo $last_name; ?>" required="true" /><br />

                        <span class="name">Email Address</span>
                        <input type="email" name="email" value="<?php echo $email; ?>" required="true" /><br />
                        
                        <span class="name">Username</span>
                        <input type="text" name="username" value="<?php echo $username; ?>" required="true" /><br />
                        
                        <span class="name">Contact Number</span>
                        <input type="tel" name="contact"  value="<?php echo $contact; ?>" required="true" /><br />

                        <span class="name">Current Password</span>
                        <input type="password" name="current_password" placeholder="Current Password" required="true" /><br />
                        
                        <span class="name">New Password</span>
                        <input type="password" name="new_password" placeholder="New Password" required="true" /><br />
                        
                        <span class="name">Confirm Password</span>
                        <input type="password" name="confirm_password" placeholder="Confirm Password" required="true" /><br />

                        <input type="submit" name="update" value="UPDATE PROFILE" class="btn-settings"/>
                        <a href="<?php echo SITEURL; ?>/index.php"><button type="button" class="btn-delete">CANCEL</button></a>
                    </form>
                    
                    <?php 
                        if(isset($_POST['update']))
                        {
                            //Gets new details from  the formm                          
                            $first_name=$obj->sanitize($conn,$_POST['first_name']);                            
                            $last_name=$obj->sanitize($conn,$_POST['last_name']);
                            $email=$obj->sanitize($conn,$_POST['email']);
                            $username=$obj->sanitize($conn,$_POST['username']);
                            $contact=$obj->sanitize($conn,$_POST['contact']);
                            $new_password=md5($obj->sanitize($conn,$_POST['new_password']));
                            $confirm_password=md5($obj->sanitize($conn,$_POST['confirm_password']));
                            $current_password=md5($obj->sanitize($conn,$_POST['current_password']));
                            
                            //Update new data in db
                            if($current_password==$password)
                            {
                                if($new_password==$confirm_password)
                                {
                                    if (strlen($_POST["new_password"]) <= '8') {
                                        $_SESSION['password']="<div class='error'>Your Password Must Contain At Least 8 Characters! Try again.</div>";
                                        header('location:'.SITEURL.'/index.php?page=settings');
                                    }
                                    else if(!preg_match("@[0-9]@",$_POST["new_password"])) {
                                        $_SESSION['password']="<div class='error'>Your Password Must Contain At Least 1 Number! Try again.</div>";
                                        header('location:'.SITEURL.'/index.php?page=settings');
                                    }
                                    else if(!preg_match("@[A-Z]@",$_POST["new_password"])) {
                                        $_SESSION['password']="<div class='error'>Your Password Must Contain At Least 1 Capital Letter! Try again.</div>";
                                        header('location:'.SITEURL.'/index.php?page=settings');
                                    }
                                    else if(!preg_match("@[a-z]@",$_POST["new_password"])) {
                                        $_SESSION['password']="<div class='error'>Your Password Must Contain At Least 1 Lowercase Letter! Try again.</div>";
                                        header('location:'.SITEURL.'/index.php?page=settings');
                                    } 
                                    else{
                                    $tbl_name='tbl_student';
                                    $data="password='$new_password', 
                                    first_name='$first_name', 
                                    last_name='$last_name', 
                                    email='$email', username='$username',
                                    contact='$contact'";
                                    $where="student_id='$student_id'";
                                    $query=$obj->update_data($tbl_name,$data,$where);
                                    $res=$obj->execute_query($conn,$query);

                                    if($res==true)
                                    {
                                        //notify user that details were updated
                                        $_SESSION['password']="<div class='success'>Details changed successfully.</div>";
                                        header('location:'.SITEURL.'/index.php?page=settings');
                                    }
                                    else
                                    {
                                        //error handling
                                        $_SESSION['password']="<div class='error'>Failed to change details. Try again.</div>";
                                        header('location:'.SITEURL.'/index.php?page=settings');
                                    }
                                }
                            }
                                else
                                {
                                    //notify user passwords don't match
                                    $_SESSION['not_match']="<div class='error'>New Password and Confirm Password did not match.</div>";
                                    header('location:'.SITEURL.'/index.php?page=settings');
                                }
                            }
                            else
                            {
                                //Notify user that current password is incorrect
                                $_SESSION['not_match']="<div class='error'>Current Password did not match.</div>";
                                header('location:'.SITEURL.'/index.php?page=settings');
                            }
                        }
                    
                    ?>
                </div>
            </div>
        </div>
    <!--Student Profile Details Page Ends Here-->