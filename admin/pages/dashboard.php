<!--Main Admin Dashboard Starts Here-->
        <div class="main">
            <div class="content">
                <div class="report">
                    <h2>Admininstator Dashboard</h2>
                    <!--------------Prints user details & date----------------------->
                    <div class="row" style="margin-bottom: 2%">
                            <div class="col-lg-2 col-12">  
                                <span class="details">Current User:</span>
                                <span class="heavy">
                                    <?php 
                                        echo $_SESSION['admin']; 
                                    ?>
                                </span>
                            </div> 
                            <div class="col-lg-10 col-12">
                                <span class="details">Current Date:</span>
                                <?php 
                                    echo date("Y-m-d h:i:sa");
                                ?>
                            </div>
                    </div>
                    <!--------------Check if login session successful or login failed----------------------->
                    <?php 
                        if(isset($_SESSION['success']))
                        {
                            echo $_SESSION['success'];
                            unset($_SESSION['success']);
                        }
                        if(isset($_SESSION['fail']))
                        {
                            echo $_SESSION['fail'];
                            unset($_SESSION['fail']);
                        }
                    ?>

                    <!--------------Admin Card Navigation----------------------->
                    <div class="clearfix">  
                        <a href="<?php echo SITEURL; ?>admin/index.php?page=admins">
                            <div class="dash-tile">
                                <h1><?php echo $obj->get_total_rows('tbl_admin',$conn); ?></h1>
                                <span>System Administrators</span>
                            </div>
                        </a>
                        <a href="<?php echo SITEURL; ?>admin/index.php?page=students">
                            <div class="dash-tile">
                                <h1><?php echo $obj->get_total_rows('tbl_student',$conn); ?></h1>
                                <span>Students</span>
                            </div>
                        </a>
                        <a href="<?php echo SITEURL; ?>admin/index.php?page=faculties">
                            <div class="dash-tile">
                                <h1><?php echo $obj->get_total_rows('tbl_faculty',$conn); ?></h1>
                                <span>Faculties</span>
                            </div>
                        </a>
                        <a href="<?php echo SITEURL; ?>admin/index.php?page=questions">
                            <div class="dash-tile">
                                <h1><?php echo $obj->get_total_rows('tbl_question',$conn); ?></h1>
                                <span>Questions/Examinations</span>
                            </div>
                        </a>
                        <a href="<?php echo SITEURL; ?>admin/index.php?page=results">
                            <div class="dash-tile">
                                <h1><?php echo $obj->get_total_rows('tbl_result_summary',$conn); ?></h1>
                                <span>Student Results</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <!--Main Admin Dashboard Ends Here-->