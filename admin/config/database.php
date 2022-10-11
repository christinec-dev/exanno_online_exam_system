<?php 
    //db connection credentials
    include('credentials.php');
    
    //Database class will provide reusable functions to be used throughout program
    Class Database
    {
        //************* Functions for DB Connection *******************************/
        //function to connect to db using credentials
        public function db_connect()
        {
            $conn=mysqli_connect(LOCALHOST,USERNAME,PASSWORD) or die(mysqli_error());
            return $conn;
        }
        
        //function to select the db using credentials
        public function db_select($conn)
        {
            $db_select=mysqli_select_db($conn,DBNAME) or die(die('Error: ' . mysqli_error($conn)));
            return $db_select;
        }
        
        //function to select random table row data from db using credentials
        public function select_random_row($tbl_name,$where,$limit)
        {
            $query="SELECT * FROM $tbl_name";
            if($where!="")
            {
                $query.=" WHERE $where  ORDER BY RAND()";
            }
            return $query;
        }
        
        //function to count table rows of db using credentials               
        public function num_rows($res)
        {
            $num_rows=mysqli_num_rows($res);
            return $num_rows;
        }

        //function to fetch table rows of db using credentials                      
        public function fetch_data($res)
        {
            $row=mysqli_fetch_assoc($res);
            return $row;
        }
        
        //function to get total number of rows from db table using credenials
        public function get_total_rows($tbl_name,$conn)
        {
            $query="SELECT * FROM $tbl_name";
            $res=mysqli_query($conn,$query) or die(mysqli_error($conn));
            $rows=mysqli_num_rows($res);
            return $rows;
        }
        //************* Functions for DB Queries *******************************/
        //function to select table data from db using credentials
        public function select_data($tbl_name,$where="",$other="")
        {
            $query="SELECT * FROM $tbl_name";
            if($where!="")
            {
                $query.=" WHERE $where";
            }
            if($other!="")
            {
                $query.=' '.$other;
            }
            return $query;
        }

        //function to insert table data from db using credentials
        public function insert_data($tbl_name,$data)
        {
            $query="INSERT INTO $tbl_name SET $data";
            return $query;
        }

        //function to update table data from db using credentials
        public function update_data($tbl_name,$data,$where="")
        {
            $query="UPDATE $tbl_name SET $data WHERE $where";
            return $query;
        }

        //function to delete table data from db using credentials       
        public function delete_data($tbl_name,$where)
        {
            $query="DELETE FROM $tbl_name WHERE $where";
            return $query;
        }

        //function to execute db queries using credentials
        public function execute_query($conn,$query)
        {
            $res=mysqli_query($conn,$query) or die(mysqli_error($conn));
            return $res;
        }

        //************* Functions for DB File Upload *******************************/
        //function to validate file types for question and image upload using credentials (must be image type, not file type)               
        public function check_image_type($ext)
        {
            $valid=array('jpg','png','gif','JPG','PNG','GIF','JPEG');
            if(in_array($ext,$valid))
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        //function to upload images to system using credentials
        public function upload_file($source,$destination)
        {
            $upload=move_uploaded_file($source,$destination);
            return $upload;
        }

        //function to delete images from system using credentials
        public function remove_file($path)
        {
            $remove=unlink($path);
            return $remove;
        }

        //************* Functions for Student Queries *******************************/
        //function to get student id from db table using credenials
        public function get_userid($tbl_name,$username,$conn)
        {
            $query="SELECT student_id FROM $tbl_name WHERE username='$username'";
            $res=mysqli_query($conn,$query) or die(mysqli_error($conn));
            $row=mysqli_fetch_assoc($res);
            $student_id=$row['student_id'];
            return $student_id;
        }

        //function to get student assigned faculty from db table using credenials
        public function get_faculty($tbl_name,$student_id,$conn)
        {
            $query="SELECT faculty FROM $tbl_name WHERE student_id='$student_id'";
            $res=mysqli_query($conn,$query) or die(mysqli_error($conn));
            $row=mysqli_fetch_assoc($res);
            $faculty=$row['faculty'];
            return $faculty;
        }

        //function to get student name from db table using credenials
        public function get_fullname($tbl_name,$student_id,$conn)
        {
            $query="SELECT first_name,last_name FROM $tbl_name WHERE student_id='$student_id'";
            $res=mysqli_query($conn,$query) or die(mysqli_error($conn));
            $row=mysqli_fetch_assoc($res);
            $first_name=$row['first_name'];
            $last_name=$row['last_name'];
            $full_name=$first_name.' '.$last_name;
            return $full_name;
        }

        //************* Functions for Faculty Queries *******************************/
        //function to get faculty from db table using credenials
        public function get_facultyname($tbl_name,$faculty_id,$conn)
        {
            $query="SELECT faculty_name FROM $tbl_name WHERE faculty_id='$faculty_id'";
            $res=mysqli_query($conn,$query) or die(mysqli_error($conn));
            $row=mysqli_fetch_assoc($res);
            $faculty_name=$row['faculty_name'];
            return $faculty_name;
        }

        //function to get faculty question one from db table using credenials
        public function get_subjectone($tbl_name2,$conn)
        {
            $query="SELECT * FROM $tbl_name2";
            $res=mysqli_query($conn,$query) or die(mysqli_error($conn));
            $row=mysqli_fetch_assoc($res);
            $subject_one=$row['subject_one'];
            return $subject_one;
        }

        //function to get faculty question two from db table using credenials
        public function get_subjectwo($tbl_name2,$conn)
        {
            $query="SELECT * FROM $tbl_name2";
            $res=mysqli_query($conn,$query) or die(mysqli_error($conn));
            $row=mysqli_fetch_assoc($res);
            $subject_two=$row['subject_two'];
            return $subject_two;
        }

        //function to get faculty question three from db table using credenials
        public function get_subjecthree($tbl_name2,$conn)
        {
            $query="SELECT * FROM $tbl_name2";
            $res=mysqli_query($conn,$query) or die(mysqli_error($conn));
            $row=mysqli_fetch_assoc($res);
            $subject_three=$row['subject_three'];
            return $subject_three;
        }

        //function to get faculty question four from db table using credenials
        public function get_subjectfour($tbl_name2,$conn)
        {
            $query="SELECT * FROM $tbl_name2";
            $res=mysqli_query($conn,$query) or die(mysqli_error($conn));
            $row=mysqli_fetch_assoc($res);
            $subject_four=$row['subject_four'];
            return $subject_four;
        }

        //function to get faculty question five from db table using credenials
        public function get_subjectfive($tbl_name2,$conn)
        {
            $query="SELECT * FROM $tbl_name2";
            $res=mysqli_query($conn,$query) or die(mysqli_error($conn));
            $row=mysqli_fetch_assoc($res);
            $subject_five=$row['subject_five'];
            return $subject_five;
        }
    }
?>