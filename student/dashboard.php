<?php 
    //checks for student session
    include('check.php');
?>

<!-- Main Student Dashboard Starts Here-->
        <div class="main">
            <div class="content">
                <div class="welcome">
                    <!--------------Login session unset----------------------->
                    <?php 
                        if(isset($_SESSION['login']))
                        {
                            echo $_SESSION['login'];
                            unset($_SESSION['login']);
                        }
                    ?>
                    <!--------------Welcomes Student----------------------->    
                    Welcome  to the Exanno Dashboard <span class="heavy"><?php echo $_SESSION['student']; ?></span>! 
                    <br />

                    <div class="success">                                          
                        <div class="row">
                            <div class="col-12" style="text-align:left;">  
                                <span class="details">Current Date:</span>
                                <?php 
                                    echo date("Y-m-d h:i:sa");
                                ?>
                            </div>
                        </div>

                        <!--------------Dashboard Instructions----------------------->
                        <p class="instructions"> Please take note of the following guidelines when conducting your examination:</p>
                        <ol style="text-align:left;"> 
                            <li> Examinations will only be made available on their scheduled dates.</li>
                            <li> After you click on "Start Exam", the examination timer will start and it cannot be paused or stopped.</li>
                            <li> Once started, the exam is automated randomly and you won't be able to return to previous question, so answer carefully. 
                            <li> Each examination only allows for one attempt. You cannot re-attempt an exam unless with permission of system administrator.</li> 
                            <li> Please contact your student administrator if you are uncertain about anything related to this dashboard.</li>
                            </li>
                        </ol>
                    </div>
                    
                    <!--------------Student Navigation----------------------->                    
                    <a class="nav-btns" href="<?php echo SITEURL; ?>index.php?page=subjects">
                        <button type="button" class="btn-go"> EXAMINATIONS</button>
                    </a>
                    <a href="<?php echo SITEURL; ?>index.php?page=results">
                        <button type="button" class="btn-exit"> RESULTS</button>
                    </a>   
                    <a href="<?php echo SITEURL; ?>index.php?page=settings">
                        <button type="button" class="btn-exit">PROFILE SETTINGS</button>
                    </a>
                    <a href="<?php echo SITEURL; ?>index.php?page=logout">
                        <button type="button" class="btn-exit">LOGOUT</button>
                    </a>
                </div>
            </div>
        </div>
    <!--Main Student Dashboard Ends Here-->