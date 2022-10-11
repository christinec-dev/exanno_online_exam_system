<!--Student Scheduled Subjects Page Starts Here-->
<div class="main">
            <div class="content">
                <div class="report">
                    <h2>Scheduled Examinations</h2>
                    <table id="searchTable">
                        <tr>
                            <th>Faculty ID</th>
                            <th>Faculty</th>
                            <th>Subject</th>
                            <th>Exam Duration</th>
                            <th>No. of Questions</th>
                            <th>Attempts Allowed</th>
                            <th>Examination Date</th>
                            <th>Actions</th>
                        </tr>
                        <!--------------Prints user details & date----------------------->                       
                        <div class="row">
                                <div class="col-lg-2 col-12">  
                                <span class="details">Current User:</span>
                                <span class="heavy">
                                    <?php 
                                        echo $_SESSION['student']; 
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
                        <!--------------Input field to search for exam----------------------->                       
                        <div class="row search-tbl">
                                <div class="col-lg-2 col-12">
                                    <p class="feedback">Search Examination:</p>
                                </div>
                                <div class="col-lg-10 col-12">
                                    <input type="text" id="searchInput" onkeyup="searchRecord()" placeholder="Enter a date, subject, etc. For example: 'Math'." width='100%'>
                                </div>
                        </div>
                        <!--------------Prints user's scheduled exam details----------------------->
                        <?php 
                            //Gets all the faculties from db
                            $tbl_name="tbl_faculty ORDER BY faculty_id";
                            $query=$obj->select_data($tbl_name);
                            $res=$obj->execute_query($conn,$query);
                            $count_rows=$obj->num_rows($res);
                            $sn=1;
                            $today = date("Y-m-d");

                            if($count_rows>0)
                            {
                                while($row=$obj->fetch_data($res))
                                {
                                    //set faculty details
                                    $faculty_id=$row['faculty_id'];
                                    $faculty_name=$row['faculty_name'];
                                    $time_duration=$row['time_duration'];
                                    $subject_one=$row['subject_one'];
                                    $subject_two=$row['subject_two'];
                                    $subject_three=$row['subject_three'];
                                    $subject_four=$row['subject_four'];
                                    $subject_five=$row['subject_five'];
                                    $qns_per_page=$row['qns_per_set'];

                                    //Gets student's assigned faculty with exam attempt
                                    $tbl_name2="tbl_student";          
                                    $where="faculty='$faculty_id' LIMIT 1";
                                    $query=$obj->select_data($tbl_name2,$where);
                                    $res=$obj->execute_query($conn,$query);
                                    $count_rows2=$obj->num_rows($res); 
                                    if($count_rows2>0)
                                    {
                                        while($row=$obj->fetch_data($res))
                                        {
                                    ?>
                                    <!--------------Prints Subject 1----------------------->
                                    <tr>
                                        <td><?php echo $sn++; ?> </td>
                                        <td><?php echo $faculty_name; ?></td>
                                        <td><?php echo $subject_one; ?></td>
                                        <td><?php echo $time_duration; ?>mins (3hrs)</td>
                                        <td><?php echo $qns_per_page; ?></td>       
                                        <td><?php echo"1"; ?></td>                                 
                                        <td>
                                        <?php  
                                            //Gets the scheduled exam from Question table to get scheduled date
                                            $tbl_name="tbl_question";          
                                            $where="category='$subject_one' LIMIT 1";
                                            $query=$obj->select_data($tbl_name,$where);
                                            $res=$obj->execute_query($conn,$query);
                                            $count_rows=$obj->num_rows($res); 
                                            if($count_rows>0)
                                            {
                                                while($row=$obj->fetch_data($res))
                                                {
                                                    $active_date=$row['active_date'];     
                                                    $active_date = $active_date;
                                                    echo $active_date;
                                                }     
                                            }
                                        ?>
                                        </td>
                                        <td>
                                        <?php                                         
                                            //Activates/Disables exam attempt button based on scheduled date
                                            if ($today != $active_date || $today < $active_date || $today > $active_date) {
                                                echo '<a href=""><button type="button" class="inactive" disabled>INACTIVE</button></a>';
                                                }
                                            else{
                                                echo '<a href="index.php?page=question"><button type="button" class="btn-update">START EXAM</button></a>';
                                            }
                                        ?>
                                        </td>
                                    </tr>  
                                    <tr>                                    
                                        <!--------------Prints Subject 2----------------------->
                                        <td><?php echo ""; ?> </td>
                                        <td><?php echo  "";?></td>
                                        <td><?php echo $subject_two; ?></td>
                                        <td><?php echo $time_duration; ?>mins (3hrs)</td>
                                        <td><?php echo $qns_per_page; ?></td>   
                                        <td><?php echo"1"; ?></td>                                   
                                        <td>
                                        <?php  
                                            //Gets the scheduled exam from Question table to get scheduled date
                                            $tbl_name="tbl_question";          
                                            $where="category='$subject_two' LIMIT 1";
                                            $query=$obj->select_data($tbl_name,$where);
                                            $res=$obj->execute_query($conn,$query);
                                            $count_rows=$obj->num_rows($res); 
                                            if($count_rows > 0)
                                            {
                                                while($row=$obj->fetch_data($res))
                                                {
                                                    $active_date=$row['active_date'];     
                                                    $date_active = $active_date;
                                                    echo $date_active;
                                                }     
                                            }
                                        ?>
                                        </td>
                                        <td>
                                        <?php                                             
                                            //Activates/Disables exam attempt button based on scheduled date
                                            if ($today != $date_active || $today < $date_active || $today > $date_active) {
                                                echo '<a href=""><button type="button" class="inactive" disabled>INACTIVE</button></a>';
                                                }
                                            else{
                                                echo '<a href="index.php?page=question2"><button type="button" class="btn-update">START EXAM</button></a>';
                                            }
                                        ?>
                                        </td>
                                    </tr>
                                    <tr>                                    
                                        <!--------------Prints Subject 3----------------------->
                                        <td><?php echo ""; ?> </td>
                                        <td><?php echo  "";?></td>
                                        <td><?php echo $subject_three; ?></td>
                                        <td><?php echo $time_duration; ?>mins (3hrs)</td>
                                        <td><?php echo $qns_per_page; ?></td>
                                        <td><?php echo"1"; ?></td>                                   
                                        <td>
                                        <?php  
                                            //Gets the scheduled exam from Question table to get scheduled date
                                            $tbl_name="tbl_question";          
                                            $where="category='$subject_three' LIMIT 1";
                                            $query=$obj->select_data($tbl_name,$where);
                                            $res=$obj->execute_query($conn,$query);
                                            $count_rows=$obj->num_rows($res); 
                                            if($count_rows>0)
                                            {
                                                while($row=$obj->fetch_data($res))
                                                {
                                                    $active_date=$row['active_date'];     
                                                    $date_active = $active_date;
                                                    echo $date_active;
                                                }     
                                            }
                                        ?>
                                        </td>
                                        <td>
                                        <?php 
                                            //Activates/Disables exam attempt button based on scheduled date
                                            if ($today != $date_active || $today < $date_active || $today > $date_active) {
                                                echo '<a href=""><button type="button" class="inactive" disabled>INACTIVE</button></a>';
                                                }
                                            else{
                                                echo '<a href="index.php?page=question3"><button type="button" class="btn-update">START EXAM</button></a>';
                                            }
                                        ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <!--------------Prints Subject 4----------------------->
                                        <td><?php echo ""; ?> </td>
                                        <td><?php echo  "";?></td>
                                        <td><?php echo $subject_four; ?></td>
                                        <td><?php echo $time_duration; ?>mins (3hrs)</td>
                                        <td><?php echo $qns_per_page; ?></td>
                                        <td><?php echo"1"; ?></td>                                   
                                        <td>
                                        <?php  
                                            //Gets the scheduled exam from Question table to get scheduled date
                                            $tbl_name="tbl_question";          
                                            $where="category='$subject_four' LIMIT 1";
                                            $query=$obj->select_data($tbl_name,$where);
                                            $res=$obj->execute_query($conn,$query);
                                            $count_rows=$obj->num_rows($res); 
                                            if($count_rows>0)
                                            {
                                                while($row=$obj->fetch_data($res))
                                                {
                                                    $active_date=$row['active_date'];     
                                                    $date_active = $active_date;
                                                    echo $date_active;
                                                }     
                                            }
                                        ?>
                                        </td>
                                        <td>
                                        <?php 
                                            //Activates/Disables exam attempt button based on scheduled date
                                            if ($today != $date_active || $today < $date_active || $today > $date_active) {
                                                echo '<a href=""><button type="button" class="inactive" disabled>INACTIVE</button></a>';
                                                }
                                            else{
                                                echo '<a href="index.php?page=question4"><button type="button" class="btn-update">START EXAM</button></a>';
                                            }
                                        ?>                                        
                                        </td>
                                    </tr>
                                    <tr>
                                        <!--------------Prints Subject 5----------------------->
                                        <td><?php echo ""; ?> </td>
                                        <td><?php echo  "";?></td>
                                        <td><?php echo $subject_five; ?></td>
                                        <td><?php echo $time_duration; ?>mins (3hrs)</td>
                                        <td><?php echo $qns_per_page; ?></td>
                                        <td><?php echo"1"; ?></td>                                   
                                        <td>
                                        <?php  
                                            //Gets the scheduled exam from Question table to get scheduled date
                                            $tbl_name="tbl_question";          
                                            $where="category='$subject_five' LIMIT 1";
                                            $query=$obj->select_data($tbl_name,$where);
                                            $res=$obj->execute_query($conn,$query);
                                            $count_rows=$obj->num_rows($res); 
                                            if($count_rows>0)
                                            {
                                                while($row=$obj->fetch_data($res))
                                                {
                                                    $active_date=$row['active_date'];     
                                                    $date_active =  $active_date;
                                                    echo $date_active;
                                                }     
                                            }
                                        ?>
                                        </td>
                                        <td>
                                        <?php 
                                            //Activates/Disables exam attempt button based on scheduled date
                                            if ($today != $date_active || $today < $date_active || $today > $date_active) {
                                                echo '<a href=""><button type="button" class="inactive" disabled>INACTIVE</button></a>';
                                                }
                                            else{
                                                echo '<a href="index.php?page=question5"><button type="button" class="btn-update">START EXAM</button></a>';
                                            }
                                        ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }   
                        }     
                    }
                        else
                        {
                            //if no subjects or faculties have been listed yet, notify student
                            echo "<tr><td colspan='6'><div class='error'>No faculties/subjects have been added.</div></td></tr>";
                        }
                        ?>
                    </table> 
                    <!--------------Navigation----------------------->
                    <a href="<?php echo SITEURL; ?>index.php?page=welcome">
                        <button type="button" class="btn-exit">DASHBOARD </button>
                    </a>
                    <a href="<?php echo SITEURL; ?>index.php?page=logout">
                        <button type="button" class="btn-exit" onclick="return confirm('Are you sure you want to log out?')">LOGOUT</button>
                    </a>    
                </div>
            </div>
        </div>
    <!--Student Scheduled Subjects Page Ends Here-->
        
<!--Script to search for individual records via user input-->
<script>
    function searchRecord() {
        //Variable declaration
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("searchTable");
        tr = table.getElementsByTagName("tr");
        //Loop through table rows to hide/display search queries
        for (i = 1; i < tr.length; i++) {
            if (tr[i].textContent.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
</script>