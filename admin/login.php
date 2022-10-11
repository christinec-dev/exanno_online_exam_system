<?php
ob_start(); 
//inits sessions and headers
include('config/session.php');
include('../reusables/header.php');
?>

<!--Admin Login Page Starts Here-->
        <div class="main">
            <div class="login">
                <form method="post" action="">
                    <h2>Login | Administator</h2>
                    <!--------------Checks if session is valid for admin or not----------------------->
                    <?php 
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
                    ?>
                    <!--------------Login input fields----------------------->
                    <input type="text" name="username" placeholder="Username" required="true" />
                    <input type="password" name="password" placeholder="Password" required="true" />
                    <input type="submit" name="submit" value="Log In" class="btn-go" />
                </form>
                <!--------------Input Validation----------------------->
                <?php
                if(isset($_POST['submit']))
                    {
                        //sanitize input to protect from xss
                        $username=$obj->sanitize($conn,$_POST['username']);
                        $password_db=md5($obj->sanitize($conn,$_POST['password']));

                        //if details aren't valid, notiy and redirect
                        if(($username=="")or($password=""))
                        {
                            $_SESSION['validation']="<div class='error'>Invalid Username or Password. Please try again.</div>";
                            header('location:'.SITEURL.'admin/login.php');
                        }

                        //select details from admin table
                        $tbl_name="tbl_admin";
                        $where="username='$username' AND password='$password_db'";
                        $query=$obj->select_data($tbl_name,$where);
                        $res=$obj->execute_query($conn,$query);
                        $count_rows=$obj->num_rows($res);
                        //if details are valid, log user in
                        if($count_rows>0)
                        {
                            $_SESSION['admin']=$username;
                            $_SESSION['success']="<div class='success'>Login Successful. Welcome ".$username." to the dashboard.</div>";
                            header('location:'.SITEURL.'admin/index.php');
                        }
                        //if details aren't valid, notify and redirect
                        else
                        {
                            $_SESSION['fail']="<div class='error'>Username or Password is invalid. Please try again.</div>";
                            header('location:'.SITEURL.'admin/login.php');
                        }
                    }
                ?>
            </div>
        </div>
    <!--Admin Login Page Ends Here-->

<?php
    //inits footer
    include('../reusables/footer.php');
?>