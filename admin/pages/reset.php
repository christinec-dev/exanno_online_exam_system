<!-- Reset Password Form for Admins-->
<div class="main">
    <div class="login">
        <form method="post" action="">
            <h2>Reset Password</h2>
            <!--------------Session check----------------------->
            <?php 
                if(isset($_SESSION['invalid']))
                {
                    echo $_SESSION['invalid'];
                    unset($_SESSION['invalid']);
                }
            ?>
            <!--------------Input fields----------------------->
            <input type="text" name="username" placeholder="Username" required="true" />
            <input type="submit" name="submit" value="Reset" class="btn-go" />    
            <p><a class="btn-reset" href="../page=login">Return to Dashboard</a></p>
        </form>

        <?php 
            if(isset($_POST['submit']))
            {
                //Gets Login values from the form
                $username=$obj->sanitize($conn,$_POST['username']);

                //Check Login values against database
                $tbl_name="tbl_admin";
                $where="username='$username'";
                $query=$obj->select_data($tbl_name, $where);
                $res=$obj->execute_query($conn,$query);
                $count_rows=$obj->num_rows($res);
                //will send password reset to user
                if($count_rows> 0)
                {
                    $_SESSION['admin']=$username;
                    $r = mysqli_fetch_assoc($res);
                    $password = $r['password'];
                    $reset_password=md5($obj->sanitize($conn,$password));
                    $to = $r['email'];
                    $subject = "Your Recovered Password";
                    $message = "Please use this temporary password to login: " . $reset_password;
                    $headers = 'From: <admin@exanno.co.za>' . "\r\n";
                    if(mail($to, $subject, $message, $headers)){
                        $_SESSION['invalid']="<div class='success'>Please check your email for your password reset.</div>";
                    }else{
                        $_SESSION['invalid']="<div class='error'>Invalid username. Please try again.</div>";
                    }
                }
                else
                {
                    $_SESSION['invalid']="<div class='error'>Invalid username. Please try again.</div>";
                }
            }
        ?>
    </div>
</div>
<!-- Reset Password Form for Admins-->
