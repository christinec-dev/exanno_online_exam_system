<!--Results Management Page Starts Here-->
<div class="main">
    <div class="content">
        <div class="report">
            <h2>Student Result Manager</h2>
            <!--Session check-->
            <?php 
                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
            ?>
            <!--Search individual record-->
            <div class="row search-tbl">
               <div class="col-lg-2 col-12">  
                    <p class="feedback">Search Record:</p>
                </div>
                <div class="col-lg-10 col-12">
                    <input type="text" id="searchInput" onkeyup="searchRecord()" placeholder="Enter a record ID, name, date, etc. For example: 'John'.">
                </div>
            </div>
            <!--Lists Results Details-->
            <table id="searchTable">
                <tr>
                    <th>S.N.</th>
                    <th>Full Name</th>
                    <th>Date Captured</th>
                    <th>Subject</th>
                    <th>Mark Acquired</th>
                    <th>Faculty</th>
                    <th>Actions</th>
                </tr>
                <?php 
                    //Getting Data From Database
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
                                <td><?php echo $marks*100/100; ?>%</td>
                                <td>
                                    <?php 
                                        //Get faculty from student ID
                                        $tbl="tbl_student";
                                        $tbl2="tbl_faculty";
                                        $faculty=$obj->get_faculty($tbl,$student_id,$conn);
                                        echo $faculty_name=$obj->get_facultyname($tbl2,$faculty,$conn);
                                    ?>
                                </td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/index.php?page=view_result&student_id=<?php echo $student_id; ?>&added_date=<?php echo $added_date; ?>"><button type="button" class="btn-update2">VIEW FEEDBACK</button></a> 
                                    <a href="<?php echo SITEURL; ?>admin/pages/delete_result.php?summary_id=<?php echo $summary_id; ?>&student_id=<?php echo $student_id; ?>&added_date=<?php echo $added_date; ?>"><button type="button" class="btn-delete" onclick="return confirm('Are you sure?')">DELETE</button></a> 
                                    <a href="<?php echo SITEURL;?>admin/index.php?page=update_results&summary_id=<?php echo $summary_id; ?>"><button type="button" class="btn-update2">UPDATE</button></a>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    else
                    {
                        echo "<tr><td colspan='7'><span class='error'>No Results Found Yet.</span></td></tr>";
                    }
                ?>
                
            </table>
        </div>
    </div>
</div>
<!--Results Management Page Ends Here-->

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