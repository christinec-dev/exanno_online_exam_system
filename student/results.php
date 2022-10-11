<!--Student Results Page Starts Here-->
    <div class="main">
            <div class="content">
                <div class="report">
                    <h2>Results Manager</h2>
                    <!--Searchbar for indivual records-->
                    <div class="row search-tbl">
                        <div class="col-2">
                            <p class="feedback">Search Result:</p>
                        </div>
                        <div class="col-10">
                            <input type="text" id="searchInput" onkeyup="searchRecord()" placeholder="Enter date added, subject, etc. For example: 'Math'.">
                        </div>
                    </div>
                    <?php 
                        if(isset($_SESSION['delete']))
                        {
                            echo $_SESSION['delete'];
                            unset($_SESSION['delete']);
                        }
                    ?>
                    <!--Prints current user details-->
                    <div class="row"  style="margin-bottom:3%">
                        <div class="col-lg-2 col-12">  
                        <span class="details">Current User:</span>
                            <span class="heavy">
                                <?php 
                                    echo $_SESSION['student']; 
                                ?>
                            </span>
                        </div> 
                        <div class="col-lg-4 col-12">
                            <span class="details">Current Date:</span>
                            <?php 
                                echo date("Y-m-d h:i:sa");
                            ?>
                        </div>
                    </div>
                    <!--Prints current student recorded results-->
                    <table id="searchTable">
                        <tr>
                            <th>S.N.</th>
                            <th>Student Name</th>
                            <th>Date Added</th>
                            <th>Subject</th>
                            <th>Mark</th>
                            <th>Faculty</th>
                        </tr>
                        <?php 
                            $tbl_name="tbl_result_summary ORDER BY added_date DESC";
                            $query=$obj->select_data($tbl_name);
                            $res=$obj->execute_query($conn,$query);
                            $count_rows=$obj->num_rows($res);
                            $sn=1;
                            if($count_rows>0)
                            {
                                while($row=$obj->fetch_data($res))
                                {
                                    $summary_id=$row['summary_id'];
                                    $student_id=$row['student_id'];
                                    $subject=$row['subject'];
                                    $marks=$row['marks'];
                                    $added_date=$row['added_date'];
                                    ?>
                                    <tr>
                                        <td><?php echo $sn++; ?>. </td>
                                        <td>
                                            <?php 
                                                $tbl_name="tbl_student";
                                                $full_name=$obj->get_fullname($tbl_name,$student_id,$conn);
                                                echo $full_name;
                                            ?>
                                        </td>
                                        <td><?php echo $added_date; ?></td>
                                        <td><?php echo $subject; ?></td>
                                        <td><?php echo $marks; ?>%</td>
                                        <td>
                                            <?php 
                                                $tbl="tbl_student";
                                                $tbl2="tbl_faculty";
                                                $faculty=$obj->get_faculty($tbl,$student_id,$conn);
                                                echo $faculty_name=$obj->get_facultyname($tbl2,$faculty,$conn);
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            else
                            {
                                //if no results have been recorded
                                echo "<tr><td colspan='7'><span class='error'>No Results Found Yet.</span></td></tr>";
                            }
                        ?>
                    </table>  
                    <!--Navigation-->
                    <a href="<?php echo SITEURL; ?>index.php?page=welcome">
                        <button type="button" class="btn-exit">DASHBOARD </button>
                    </a>
                    <a href="<?php echo SITEURL; ?>index.php?page=logout">
                        <button type="button" class="btn-exit" onclick="return confirm('Are you sure you want to log out?')">LOGOUT</button>
                    </a> 
                    <a href="">
                        <button type="button" class="btn-exit" onclick="return window.print();">PRINT RESULTS</button>
                    </a>    
                </div>
            </div>
        </div>

<!--search for individual records-->
<script>
    function searchRecord() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("searchTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 1; i < tr.length; i++) {
            if (tr[i].textContent.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
</script>
<!--Student Results Page Ends Here-->