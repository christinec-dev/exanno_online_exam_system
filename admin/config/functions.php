<?php     
    //reusable database functions
    include('database.php');
    
    class Functions extends Database
    {
        //will encrypt passwords
        function uniqid()
        {
            $uniq= md5(uniqid(rand(0000,9999),TRUE));
            return $uniq;
        }

        //will sanitize user input for security
        public function sanitize($conn,$data)
        {
            $clean=mysqli_real_escape_string($conn,$data);
            return $clean;
        }
    }
?>