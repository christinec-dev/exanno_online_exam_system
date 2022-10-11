<?php 
    //gets session detail from admin table and fills in input fields
    if(isset($_SESSION['admin']))
    {
        $username=$_SESSION['admin'];
        $tbl_name="tbl_admin";
        $where="username='$username'";
        $query=$obj->select_data($tbl_name,$where);
        $res=$obj->execute_query($conn,$query);
        $count_rows=$obj->num_rows($res);
        if($count_rows==1)
        {
            $row=$obj->fetch_data($res);
            $admin_id=$row['admin_id'];
            $admin_name=$row['admin_name'];
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
<!--Admin Profile Details Page Starts Here-->
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
                           $admin_name=$obj->sanitize($conn,$_POST['admin_name']);
                           $email=$obj->sanitize($conn,$_POST['email']);         
                           $username=$obj->sanitize($conn,$_POST['username']);
                           $contact=$obj->sanitize($conn,$_POST['contact']);
                           $current_password=$obj->sanitize($conn,$_POST['current_password']);

                           if(($admin_name=="")or($email=="")or($username=="")or($contact=="")or($current_password==""))
                           {
                                $_SESSION['validation']="<div class='error'>App Name or Email or Username or Contact or Password is Empty.</div>";
                                header('location:'.SITEURL.'/index.php?page=settings');
                           }

                           if($current_password==$password)
                           {
                                $tbl_name="tbl_admin";
                                $data="admin_name='$admin_name',
                                last_name='$last_name',
                                email='$email',
                                username='$username',
                                contact='$contact'";
                            
                            $where="admin_id=$admin_id";
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
                                        echo $_SESSION['admin']; 
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
                        <input type="text" name="admin_name" value="<?php echo $admin_name; ?>" required="true" /><br />
                   
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
                            //Get details from form                          
                            $admin_name=$obj->sanitize($conn,$_POST['admin_name']);          
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
                                        header('location:'.SITEURL.'/admin?page=settings');
                                    }
                                    else if(!preg_match("@[0-9]@",$_POST["new_password"])) {
                                        $_SESSION['password']="<div class='error'>Your Password Must Contain At Least 1 Number! Try again.</div>";
                                        header('location:'.SITEURL.'/admin?page=settings');
                                    }
                                    else if(!preg_match("@[A-Z]@",$_POST["new_password"])) {
                                        $_SESSION['password']="<div class='error'>Your Password Must Contain At Least 1 Capital Letter! Try again.</div>";
                                        header('location:'.SITEURL.'/admin?page=settings');
                                    }
                                    else if(!preg_match("@[a-z]@",$_POST["new_password"])) {
                                        $_SESSION['password']="<div class='error'>Your Password Must Contain At Least 1 Lowercase Letter! Try again.</div>";
                                        header('location:'.SITEURL.'/admin?page=settings');
                                    } 
                                    else{
                                    $tbl_name='tbl_admin';
                                    $data="password='$new_password', 
                                    admin_name='$admin_name', 
                                    email='$email', username='$username',
                                    contact='$contact'";
                                    $where="admin_id='$admin_id'";
                                    $query=$obj->update_data($tbl_name,$data,$where);
                                    $res=$obj->execute_query($conn,$query);
                                    if($res==true)
                                    {
                                        //notify user that details were updated
                                        $_SESSION['password']="<div class='success'>Details changed successfully.</div>";
                                        header('location:'.SITEURL.'/admin?page=settings');
                                    }
                                    else
                                    {
                                        //error handling
                                        $_SESSION['password']="<div class='error'>Failed to change details. Try again.</div>";
                                        header('location:'.SITEURL.'/admin?page=settings');
                                    }
                                }
                                }
                                else
                                {
                                    //notify user passwords don't match/too weak
                                    $_SESSION['not_match']="<div class='error'>New Password and Confirm Password did not match or password is too weak. Please try again.</div>";
                                    header('location:'.SITEURL.'/admin?page=settings');
                                }
                            }
                            else
                            {
                                //Notify user that current password is incorrect
                                $_SESSION['not_match']="<div class='error'>Current Password did not match.</div>";
                                header('location:'.SITEURL.'/admin?page=settings');
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    <!--Admin Profile Details Page Starts Here-->
