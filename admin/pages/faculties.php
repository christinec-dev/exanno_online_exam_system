<!--Faculties Management Page Starts Here-->
<div class="main">
    <div class="content">
        <div class="report">
            <h2>Faculty Manager</h2>
            <a href="<?php echo SITEURL; ?>admin/index.php?page=add_faculty">
                <button type="button" class="btn-add">Add Faculty</button>
            </a>
            <!--Search individual record-->
            <div class="row search-tbl">
                    <div class="col-lg-2 col-12">  
                        <p class="feedback">Search Record:</p>
                    </div>
                    <div class="col-lg-10 col-12">
                        <input type="text" id="searchInput" onkeyup="searchRecord()" placeholder="Enter a record ID, title, etc. For example: 'BScIT'.">
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
            <!--Lists Faculty Details-->
            <table id="searchTable">
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Subject 1</th>
                    <th>Subject 2</th>
                    <th>Subject 3</th>
                    <th>Subject 4</th>
                    <th>Subject 5</th>
                    <th>Actions</th>
                </tr>
                
                <?php 
                    //Getting all the faculties from database
                    $tbl_name="tbl_faculty ORDER BY faculty_id DESC";
                    $query=$obj->select_data($tbl_name);
                    $res=$obj->execute_query($conn,$query);
                    $count_rows=$obj->num_rows($res);
                    $sn=1;
                    if($count_rows>0)
                    {
                        while($row=$obj->fetch_data($res))
                        {
                            $faculty_id=$row['faculty_id'];
                            $faculty_name=$row['faculty_name'];
                            $subject_one=$row['subject_one'];
                            $subject_two=$row['subject_two'];
                            $subject_three=$row['subject_three'];
                            $subject_four=$row['subject_four'];
                            $subject_five=$row['subject_five'];
                            ?>
                            <tr>
                                <td><?php echo $sn++; ?>. </td>
                                <td><?php echo $faculty_name; ?></td>
                                <td><?php echo $subject_one; ?></td>
                                <td><?php echo $subject_two; ?></td>
                                <td><?php echo $subject_three; ?></td>
                                <td><?php echo $subject_four; ?></td>
                                <td><?php echo $subject_five; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/index.php?page=update_faculty&id=<?php echo $faculty_id; ?>"><button type="button" class="btn-update2">UPDATE</button></a> 
                                    <a href="<?php echo SITEURL; ?>admin/pages/delete.php?id=<?php echo $faculty_id; ?>&page=faculties"><button type="button" class="btn-delete" onclick="return confirm('Are you sure?')">DELETE</button></a>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    else
                    {
                        echo "<tr><td colspan='6'><div class='error'>No faculties have beenadded.</div></td></tr>";
                    }
                ?>
                
                
            </table>
        </div>
    </div>
</div>
<!--Faculties Management Page Ends Here-->

<!--Search for individual records-->
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