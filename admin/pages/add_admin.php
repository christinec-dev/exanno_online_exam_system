<!--Admin Add Page Starts Here-->

<div class="main">

    <div class="content">

        <div class="report">

            <!--Admin User input form-->

            <form method="post" action="" class="forms">

                <h2>Add Administrator</h2>

                <!--Session check-->

                <?php 

                    if(isset($_SESSION['validation']))

                    {

                        echo $_SESSION['validation'];

                        unset($_SESSION['validation']);

                    }

                    if(isset($_SESSION['add']))

                 input type="password" name="password"

                        echo $_SESSION['add'];

                        unset($_SESSION['add']);

                    }

                ?>

                <span class="name">Name</span> 

                <input type="text" name="admin_name" placeholder="Admin Name" required="true" /> 

                <br />

                <span class="name">Email Address</span>

                <input type="email" name="email" placeholder="Email Address" required="true" />

                <br />

                <span class="name">Username</span>

                <input type="text" name="username" placeholder="Username" required="true" />

                <br />

                <span class="name">Password</span>

                <input type="text" name="password" placeholder="Password" required="true" />

                <br />

                <span class="name">Contact Number</span>

                <input type="tel" name="contact" placeholder="Contact Number" />

                <br />

                <span class="name">Admin Image</span>

                <input type="file" name="image" />

                <br />

                <input type="submit" name="submit" value="ADD ADMINISTRATOR" class="btn-add" style="margin-left: 15%;" />

                <a href="<?php echo SITEURL; ?>admin/index.php?page=admins"><button type="button" class="btn-delete">CANCEL</button></a>

            </form>

            <!--Add admin user to db-->

            <?php 

                if(isset($_POST['submit']))

                {

                    //Getting values from the form & sanitizing input

                    $admin_name=$obj->sanitize($conn,$_POST['admin_name']);

                    $email=$obj->sanitize($conn,$_POST['email']);

                    $username=$obj->sanitize($conn,$_POST['username']);

                    $password=md5($obj->sanitize($conn,$_POST['password']));

                    $contact=$obj->sanitize($conn,$_POST['contact']);

                    $image_name=$obj->sanitize($conn,$_POST['image_name']);

                    $added_date=date('Y-m-d');

                    $updated_date=date('Y-m-d');

                    //Managing admin images

                    if($_FILES['image']['name']!="")

                    {

                        //Getting file extension

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

                    //Backend Validation, checking whether the input fields are empty or not

                    if(($admin_name||$email||$username||$password)==null)

                    {

                        $_SESSION['validation']="<div class='error'>Name, or Email or Username or Password is Empty.</div>";

                        header('location:'.SITEURL.'admin/index.php?page=add_admin');

                    }

                    //Adding to the database

                    $tbl_name='tbl_admin';

                    $data="admin_name='$admin_name',

                            email='$email',

                            username='$username',

                            password='$password',

                            contact='$contact',

                            added_date='$added_date',

                            updated_date='$updated_date',

                            image_name='$image_name'";

                    $query=$obj->insert_data($tbl_name,$data);

                    $res=$obj->execute_query($conn,$query);

                    if($res===true)

                    {

                        //success

                        $_SESSION['add']="<div class='success'>New administrator successfully added.</div>";

                        header('location:'.SITEURL.'admin/index.php?page=admins');

                    }

                    else

                    {

                        //fail

                        $_SESSION['add']="<div class='error'>Failed to add new administrator. Try again.</div>";

                        header('location:'.SITEURL.'admin/index.php?page=add_admin');

                    }

                }

            ?>

        </div>

    </div>

</div>

<!--Admin Add Page Ends Here-->