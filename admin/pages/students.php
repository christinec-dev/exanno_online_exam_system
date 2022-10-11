<!--Students Management Page Starts Here-->
<div class="main">
    <div class="content">
        <div class="report">
            <h2>Student Manager</h2>
            <a href="<?php echo SITEURL; ?>admin/index.php?page=add_student">
                <button type="button" class="btn-add">Add Student</button>
            </a>
            <!--Search individual record-->
            <div class="row search-tbl">
                    <div class="col-lg-2 col-12">  
                        <p class="feedback">Search Record:</p>
                    </div>
                    <div class="col-lg-10 col-12">
                        <input type="text" id="searchInput" onkeyup="searchRecord()" placeholder="Enter a record ID, name, etc. For example: 'John'.">
                    </div>
            </div>
            <!--Session check-->
            <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
            ?>
            <!--Lists Student Details-->
            <table id="searchTable">
                <tr>
                    <th>S.N.</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Faculty</th>
                    <th>Active Student</th>
                    <th>Actions</th>
                </tr>
            <?php 
                //Gets Data From Database
                $tbl_name="tbl_student ORDER BY student_id DESC";
                $query=$obj->select_data($tbl_name);
                $sn=1;
                $res=$obj->execute_query($conn,$query);
                $count_rows=$obj->num_rows($res);
                if($count_rows>0)
                {
                    while($row=$obj->fetch_data($res))
                    {
                        $student_id=$row['student_id'];
                        $first_name=$row['first_name'];
                        $last_name=$row['last_name'];
                        $full_name=$first_name.' '.$last_name;
                        $email=$row['email'];
                        $contact=$row['contact'];
                        $faculty=$row['faculty'];
                        $is_active=$row['is_active'];
                        ?>
                        <tr>
                            <td><?php echo $sn++; ?> </td>
                            <td><?php echo $full_name; ?></td>
                            <td><?php echo $email; ?></td>
                            <td><?php echo $contact; ?></td>
                            <td>
                                <?php 
                                    //Get FAculty Name from faculty_id
                                    $tbl_name2="tbl_faculty";
                                    $faculty_name=$obj->get_facultyname($tbl_name2,$faculty,$conn); 
                                    echo $faculty_name;
                                ?>
                            </td>
                            <td><?php echo $is_active; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/index.php?page=update_student&student_id=<?php echo $student_id; ?>"><button type="button" class="btn-update2">UPDATE</button></a> 
                                <a href="<?php echo SITEURL; ?>admin/pages/delete.php?id=<?php echo $student_id; ?>&page=students"><button type="button" class="btn-delete" onclick="return confirm('Are you sure?')">DELETE</button></a>
                            </td>
                        </tr>
                        <?php
                    }
                }
                else
                {
                    echo "<tr><td colspan='7'><div class='error'>No Students Added Yet.</div></tr></td>";
                }
            ?>
                
            </table>
        </div>
    </div>
</div>
<!--Students Management Page Ends Here-->

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