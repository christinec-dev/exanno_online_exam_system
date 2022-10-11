<?php 
    //if session is not set for admin, prompt login first
    if(!isset($_SESSION['admin']))
    {
        $_SESSION['xss']="<div class='error'>Please login to access the dashboard.</div>";
        header('location:'.SITEURL.'admin/login.php');
    } 
?>
<!--Admin Navigation Starts Here-->
        <nav class="menu">
            <div class="wrapper">
                <ul>
                    <a href="<?php echo SITEURL; ?>admin/index.php?page=home"><li>Dashboard</li></a>                    
                    <a href="<?php echo SITEURL; ?>admin/index.php?page=admins"><li>Manage Admins</li></a>
                    <a href="<?php echo SITEURL; ?>admin/index.php?page=students"><li>Manage Students</li></a>
                    <a href="<?php echo SITEURL; ?>admin/index.php?page=faculties"><li>Manage Faculties</li></a>
                    <a href="<?php echo SITEURL; ?>admin/index.php?page=questions"><li>Manage Examinations</li></a>
                    <a href="<?php echo SITEURL; ?>admin/index.php?page=results"><li>Manage Results</li></a>
                    <a href="<?php echo SITEURL; ?>admin/index.php?page=settings"><li>Edit Profile</li></a>        
                    <a href="<?php echo SITEURL; ?>admin/index.php?page=logout" onclick="return confirm('Are you sure?')"><li>Log Out</li></a>
                </ul>
            </div>
        </nav>
<!--Admin Navigation Ends Here-->