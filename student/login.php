
    <!--Student Login Page Starts Here-->
    <div class="main">
        <div class="login">
            <form method="post" action="">
                <h2>Login | Student</h2>
                <!--------------Checks if session is valid for student or not----------------------->
                <?php 
                    if(isset($_SESSION['invalid']))
                    {
                        echo $_SESSION['invalid'];
                        unset($_SESSION['invalid']);
                        if(isset($_SESSION['validation']))
                        {
                            echo $_SESSION['validation'];
                            unset($_SESSION['vaidation']);
                        }
                        if(isset($_SESSION['fail']))
                        {
                            echo $_SESSION['fail'];
                            unset($_SESSION['fail']);
                        }
                        if(isset($_SESSION['xss']))
                        {
                            echo $_SESSION['xss'];
                            unset($_SESSION['xss']);
                        }

                    }  
                ?>
                <!--------------Login input fields----------------------->
                <input type="text" name="username" placeholder="Enter Username" required="true" />
                <input type="password" name="password" placeholder="Enter Password" required="true" />
                <input type="submit" name="submit" value="LOG IN" class="btn-go" />
                <p>Forgot Password? <a class="btn-reset" href="index.php?page=reset">Reset Password</a></p>
            </form>
            <!--------------Input Validation----------------------->
            <?php 
                if(isset($_POST['submit']))
                {
                    //sanitize input to protect from xss
                    $username=$obj->sanitize($conn,$_POST['username']);
                    $password=md5($obj->sanitize($conn,$_POST['password']));

                    //select details from student table
                    $tbl_name="tbl_student";
                    $where="username='$username' && password='$password'";
                    $query=$obj->select_data($tbl_name, $where);
                    $res=$obj->execute_query($conn,$query);
                    $count_rows=$obj->num_rows($res);
                    //if details are valid, log user in
                    if($count_rows>0)
                    {
                        $_SESSION['student']=$username;
                        $_SESSION['login']="<div class='success'>Login Successful! Welcome back $username.</div>";
                        header('location:'.SITEURL.'index.php?page=welcome');
                    }
                    //if details aren't valid, notify and redirect
                    else
                    {
                        $_SESSION['invalid']="<div class='error'>Invalid Username or Password. Please try again.</div>";
                        header('location:'.SITEURL.'index.php?page=login');
                    }
                }
            ?>
        </div>
    </div>
    <!--Student Login Page Ends Here-->
