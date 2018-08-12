<?php
    session_start();
    class Database{


        // 1.prepare mysql credentials
        private $server = "localhost";
        private $user = "root";
        private $password = "";
        private $database = "bookdb";
        private $conn;

        // 2. execute the connection during instantiation
        function __construct(){
            $this->conn = new mysqli($this->server, $this->user, $this->password, $this->database);
            
            if($this->conn){
                echo "MySQL Connection Successful";
            }            
        }


        public function add_user($username, $email, $password, $level){
            $enc_pass = sha1($password);
            
            $sql= "INSERT INTO `tbl_users` (`user_username`,`user_email`,`user_password`,`user_level_id`,`user_date_registered`) VALUES ('$username', '$email', '$enc_pass', '$level',NOW())";
            $this->conn->query($sql);
        }

        public function get_all_users(){
            $sql=" SELECT `user_id`, `user_username`, `user_email`, `user_date_registered` FROM `tbl_users` WHERE `user_is_deleted`='1'";
            return $this->conn->query($sql);
        }

        public function delete_user($id){
            
            // $sql="DELETE FROM `tbl_users` WHERE `user_id`='$id'";

            $sql="UPDATE `tbl_users` SET `user_is_deleted`='0' WHERE `user_is_deleted`='1'";
            $this->conn->query($sql);
        }


    }


?>