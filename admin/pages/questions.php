<!--Exam Question Management Starts Here-->
<div class="main">
    <div class="content">
        <div class="report">
            <h2>Question Manager</h2>
                <a href="<?php echo SITEURL; ?>admin/index.php?page=add_question">
                    <button type="button" class="btn-add">Add Question</button>
                </a>
                <a href="<?php echo SITEURL; ?>admin/index.php?page=schedule">
                    <button type="button" class="btn-add">Schedule Exam</button>
                </a>
                <!--Search individual record-->
                <div class="row search-tbl">
                    <div class="col-2">
                        <p class="feedback">Search Record:</p>
                    </div>
                    <div class="col-10">
                        <input type="text" id="searchInput" onkeyup="searchRecord()" placeholder="Enter a record ID, subject, etc. For example: 'Math'.">
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
            <!--Lists Added Questions Details-->
            <table style="text-align:left" id="searchTable">
                <tr>
                    <th>S.N.</th>
                    <th>Faculty ID</th>
                    <th>Subject</th>
                    <th>Question</th>
                    <th>Marks</th>
                    <th>Scheduled Date</th>
                    <th>Actions</th>
                </tr>
                
                <?php 
                    //Getting Data From Database
                    $tbl_name="tbl_question ORDER BY question_id DESC";
                    $query=$obj->select_data($tbl_name);
                    $res=$obj->execute_query($conn,$query);
                    $count_rows=$obj->num_rows($res);
                    $sn=1;
                    if($count_rows>0)
                    {
                        while($row=$obj->fetch_data($res))
                        {
                            $question_id=$row['question_id'];
                            $faculty=$row['faculty'];
                            $category=$row['category'];
                            $question=$row['question'];
                            $marks=$row['marks'];
                            $active_date=$row['active_date'];
                            ?>
                            <tr>
                                <td><?php echo $sn++; ?>. </td>                   
                                <td><?php echo $faculty; ?></td></td>                    
                                <td><?php echo $category; ?></td></td>
                                <td style="width: 400px; text-align:justify"><?php echo $question; ?></td>
                                <td style="text-align:center"><?php echo $marks; ?></td>
                                <td><?php echo $active_date; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/index.php?page=update_question&id=<?php echo $question_id; ?>"><button type="button" class="btn-update2">UPDATE</button></a> 
                                    <a href="<?php echo SITEURL; ?>admin/pages/delete.php?id=<?php echo $question_id; ?>&page=questions"><button type="button" class="btn-delete" onclick="return confirm('Are you sure?')">DELETE</button></a>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    else
                    {
                        echo "<tr><td colspan='6'><div class='error'>No questions have been added.</div></td></tr>";
                    }
                ?>
                
            </table>
        </div>
    </div>
</div>
<!--Exam Question Management Ends Here-->

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