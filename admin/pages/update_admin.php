<!--Update Admin Page Starts Here-->
<?php 
    //gets admin details
    if(isset($_GET['admin_id']))
    {
        $admin_id=$_GET['admin_id'];
        $tbl_name='tbl_admin';
        $where="admin_id=$admin_id";
        $query=$obj->select_data($tbl_name,$where);
        $res=$obj->execute_query($conn,$query);
        $count_rows=$obj->num_rows($res);
        if($count_rows==1)
        {
            $row=$obj->fetch_data($res);
            $admin_name=$row['admin_name'];
            $email=$row['email'];
            $username=$row['username'];
            $password=$row['password'];
            $contact=$row['contact'];            
            $image_name=$row['image_name'];
        }
        else
        {
            header('location:'.SITEURL.'admin/index.php?page=admins');
        }
    }
    else
    {
        header('location:'.SITEURL.'admin/index.php?page=admins');
    }
?>
<div class="main">
    <div class="content">
        <div class="report">
            <!--Form to update data-->
            <form method="post" action="" class="forms">
                <h2>Update Administrator</h2>
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
                <span class="name">Admin Name</span> 
                <input type="text" name="admin_name" value="<?php echo $admin_name; ?>" required="true" /> <br />
                
                <span class="name">Email</span>
                <input type="email" name="email" value="<?php echo $email; ?>" required="true" /><br />
                
                <span class="name">Username</span>
                <input type="text" name="username" value="<?php echo $username; ?>" required="true" /><br />
                
                <span class="name">Password</span>
                <input type="password" name="password" value="<?php echo $password; ?>" required="true" /><br />
                
                <span class="name">Contact</span>
                <input type="tel" name="contact" value="<?php echo $contact; ?>" /><br />
            
                
                <span class="name">Admin Image</span>
                <input type="file" name="image" /><br />
                <input type="submit" name="submit" value="UPDATE " class="btn-add" style="margin-left: 15%;" />
                <a href="<?php echo SITEURL; ?>admin/index.php?page=admins"><button type="button" class="btn-delete">CANCEL</button></a>
            </form>
            <!--Submits updated data-->
            <?php 
                if(isset($_POST['submit']))
                {
                    $admin_name=$obj->sanitize($conn,$_POST['admin_name']);
                    $email=$obj->sanitize($conn,$_POST['email']);
                    $username=$obj->sanitize($conn,$_POST['username']);
                    $password=$obj->sanitize($conn,$_POST['password']);
                    $contact=$obj->sanitize($conn,$_POST['contact']);
                    $image_name=$obj->sanitize($conn,$_POST['image_name']);
                    $updated_date=date('Y-m-d');
                    
                    //Managing admin images
                    if($_FILES['image']['name']!="")
                    {
                        //Getting File Extension
                        $ext=end(explode('.',$_FILES['image']['name']));
                        //Checking if the file type is valid or not (must be image)
                        $valid_file=$obj->check_image_type($ext);
                        if($valid_file==false)
                        {
                            $_SESSION['invalid']="<div class='error'>Invalid Image type. Please use JPG or PNG or GIF file type.</div>";
                            header('location:'.SITEURL.'admin/index.php?page=add_admin');
                            die();
                        }
                        //Uploading if the file is valid
                        $new_name='admin_user'.$obj->uniqid();
                        $image_name=$new_name.'.'.$ext;
                        $source=$_FILES['image']['tmp_name'];
                        $destination="../images/admins/".$image_name;
                        $upload=$obj->upload_file($source,$destination);
                        if($upload==false)
                        {
                            $_SESSION['upload']="<div class='error'>Failed to upload admin image. Try again.</div>";
                            header('location:'.SITEURL.'admin/index.php?page=add_admin');
                            die();
                        }
                    }
                    else
                    {
                        $image_name="";
                    }
                    //Validation
                    if(($admin_name||$email||$username||$password)==null)
                    {
                        $_SESSION['validation']="<div class='error'>First Name or Last Name, or Email or Username or Password is Empty.</div>";
                        header('location:'.SITEURL.'admin/index.php?page=update_admin&admin_id='.$admin_id);
                    }
                    //Set table name to update
                    $tbl_name='tbl_admin';
                    //Add updated data to db table
                    $data="admin_name='$admin_name',
                            email='$email',
                            username='$username',
                            password='$password',
                            contact='$contact',
                            updated_date='$updated_date',
                            image_name='$image_name'
                            ";
                    $where="admin_id=$admin_id";
                    $query=$obj->update_data($tbl_name,$data,$where);
                    $res=$obj->execute_query($conn,$query);
                    if($res===true)
                    {
                        //success
                        $_SESSION['update']="<div class='success'>Administrator details successfully updated.</div>";
                        header('location:'.SITEURL.'admin/index.php?page=admins');
                    }
                    else
                    {
                        //fail
                        $_SESSION['update']="<div class='error'>Failed to update administrator details.</div>";
                        header('location:'.SITEURL.'admin/index.php?page=update_admin&admin_id='.$admin_id);
                    }
                }
            ?>
        </div>
    </div>
</div>
<!--Update Admin Page Ends Here-->