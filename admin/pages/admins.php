<!--Admin Management Page Starts Here-->
<div class="main">
    <div class="content">
        <div class="report">
            <h2>Admin Manager</h2>
            <a href="<?php echo SITEURL; ?>admin/index.php?page=add_admin">
                <button type="button" class="btn-add">NEW ADMINISTRATOR</button>
            </a>
            <!--Search individual record-->
            <div class="row search-tbl">
                    <div class="col-lg-2 col-12">  
                        <p class="feedback">Search Record:</p>
                    </div>
                   <div class="col-lg-10 col-12">
                        <input type="text" id="searchInput" onkeyup="searchRecord()" placeholder="Enter a record ID, subject, etc. For example: 'John'.">
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
            <!--Lists Admin Details-->
            <table id="searchTable">
                <tr>
                    <th>ID</th>
                    <th>Administrator Name</th>
                    <th>Email Address</th>
                    <th>Contact Number</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            <!--Displaying All Data From Database-->
            <?php 
                $tbl_name="tbl_admin ORDER BY admin_id DESC";
                $query=$obj->select_data($tbl_name);
                $sn=1;
                $res=$obj->execute_query($conn,$query);
                $count_rows=$obj->num_rows($res);
                if($count_rows>0)
                {
                    while($row=$obj->fetch_data($res))
                    {
                        $admin_id=$row['admin_id'];
                        $admin_name=$row['admin_name'];
                        $email=$row['email'];
                        $contact=$row['contact'];                                
                        $image_name=$row['image_name'];

                        ?>
                        <tr>
                            <td><?php echo $sn++; ?> </td>
                            <td><?php echo $admin_name; ?></td>
                            <td><?php echo $email; ?></td>
                            <td><?php echo $contact; ?></td>
                        <td>
                        <?php 
                            if($image_name!="")
                            {
                                echo '<img src="../images/admins/<?php echo $image_name; ?>" alt="exanno image" style="max-width:4em; margin-left:30px"/>';
                            } else {
                                echo '<img src="../images/admins/default.png" alt="exanno image" style="max-width:4em; margin-left:30px"/>';
                            }
                        ?>
                        </td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/index.php?page=update_admin&admin_id=<?php echo $admin_id; ?>"><button type="button" class="btn-update2" >UPDATE</button></a> 
                            <a href="<?php echo SITEURL; ?>admin/pages/delete.php?id=<?php echo $admin_id; ?>&page=admins"><button type="button" class="btn-delete" onclick="return confirm('Are you sure?')">DELETE</button></a>
                        </td>
                        </tr>
                        <?php
                    }
                }
                else
                {
                    echo "<tr><td colspan='7'><div class='error'>No Administrators Added Yet.</div></tr></td>";
                }
            ?>
            </table>
        </div>
    </div>
</div>
<!--Admin Management Page Ends Here-->

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