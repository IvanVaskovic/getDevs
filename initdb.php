<?php 
    class FailInsertDev extends Exception {}
    class FailInsertCompany extends Exception {}
    class FailInsertUser extends Exception {}
    class FailUpdateDev extends Exception {}
    class FailUpdateUserPassword extends Exception {}
    class FailDeleteProfile extends Exception {}
    class FailDeleteUser extends Exception {}

    class Conection {
        private $conn;

        function __construct() {
            //connection to MySQL 
            $this->conn = new mysqli ("localhost","root","");
            if (!is_null($this->conn->connect_error)) {
                die ("Error: " . $this->conn->connect_error);
            }

            //database import
            $db = file_get_contents('./database/get_devs_db.sql');
            $this->conn->multi_query($db);
            while ($this->conn->next_result()) {        // flush multi_queries
                if (!$this->conn->more_results()) break;
            }

            //select database 
            $this->conn->select_db('get_devs_db');

            //stock user types:

            // admin   => email: admin@admin;       pass: admin
            // dev     => email: dev@dev;           pass: dev
            // company => email: company@company;   pass: company
        }

        private function prepareSelectUser() {
            return $this->conn->prepare("SELECT * FROM `users` WHERE `email`= ?");
        }

        private function prepareSelectDev() {
            return $this->conn->prepare("SELECT * FROM `devs` WHERE `email`= ?");
        }

        private function prepareSelectCompany() {
            return $this->conn->prepare("SELECT * FROM `companies` WHERE `email`= ?");
        }

        private function prepareDeleteUser() {
            return $this->conn->prepare("DELETE FROM `users` WHERE `id` = ?");
        }

        private function prepareDeleteDev() {
            return $this->conn->prepare("DELETE FROM `devs` WHERE `id` = ?");
        }

        private function prepareDeleteCompany() {
            return $this->conn->prepare("DELETE FROM `companies` WHERE `id` = ?");
        }

        function getDevID($email) {
            $prepared = $this->prepareSelectDev();
            $prepared->bind_param("s",$email);
            $prepared->execute();
            $res = $prepared->get_result();
            $row = $res->fetch_assoc();
            return $row['id'];
        }

        function getCompanyID($email) {
            $prepared = $this->prepareSelectCompany();
            $prepared->bind_param("s",$email);
            $prepared->execute();
            $res = $prepared->get_result();
            $row = $res->fetch_assoc();
            return $row['id'];
        }

        function getUser($email) {
            $prepared = $this->conn->prepare("SELECT `id`, `email`, `user_type`, `dev_id`, `company_id` FROM `users` WHERE `email` = ?");
            $prepared->bind_param("s",$email);
            $prepared->execute();
            $res = $prepared->get_result();
            $row = $res->fetch_assoc();
            return $row;
        }

        function getDev($email) {
            $prepared = $this->prepareSelectDev($email);
            $prepared->bind_param("s",$email);
            $prepared->execute();
            $res = $prepared->get_result();
            $row = $res->fetch_assoc();
            return $row;
        }

        function getCompany($email) {
            $prepared = $this->prepareSelectCompany($email);
            $prepared->bind_param("s",$email);
            $prepared->execute();
            $res = $prepared->get_result();
            $row = $res->fetch_assoc();
            return $row;
        }

        function validateUser($email, $pass): bool {
            $prepared = $this->prepareSelectUser();
            $prepared->bind_param("s",$email);
            $prepared->execute();
            $res = $prepared->get_result();
            if($res->num_rows == 1) {
                $row = $res->fetch_assoc();
                return password_verify($pass,$row['pass']);
            }
            return false;
        }

        function registerDev($name, $email, $pass, $phone, $location, $profile_picture, $price_per_hour, $javascript, $java, $net, $flutter, $python, $php, $description, $years_of_exp, $native_language, $linked_in): bool {
            
            //checking if user with that email already exists
            $prepared = $this->prepareSelectUser();
            $prepared->bind_param("s",$email);
            $prepared->execute();
            $res = $prepared->get_result();
            if($res->num_rows == 1) {
                return false;
            }

            //adding dev to database
            $insert_dev = $this->conn->prepare("INSERT INTO `devs` (`name`, `email`, `phone`, `location`, `profile_picture`, `price_per_hour`, `javascript`, `java`, `net`, `flutter`, `python`, `php`, `description`, `years_of_exp`, `native_language`, `linked_in`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $insert_dev->bind_param("sssssiiiiiiisiss", $name, $email, $phone, $location, $profile_picture, $price_per_hour, $javascript, $java, $net, $flutter, $python, $php, $description, $years_of_exp, $native_language, $linked_in);
            
            if ($insert_dev->execute() == false) throw new FailInsertDev("Failed Dev registration.");

            //get new dev ID
            $dev_id = $this->getDevID($email);

            //insert dev into users
            $user_type = "dev";
            $enc_pass = password_hash($pass,PASSWORD_BCRYPT);
            $insert_user = $this->conn->prepare("INSERT INTO `users` (`email`, `pass`, `user_type`, `dev_id`) VALUES (?,?,?,?)");
            $insert_user->bind_param("sssi", $email, $enc_pass, $user_type, $dev_id);
            
            if ($insert_user->execute() == false) throw new FailInsertUser("Failed User registration.");
            
            return true;
        }

        function registerCompany($name, $owner, $email, $pass, $phone, $location): bool {

            //checking if user with that email already exists
            $prepared = $this->prepareSelectUser();
            $prepared->bind_param("s",$email);
            $prepared->execute();
            $res = $prepared->get_result();
            if($res->num_rows == 1) {
                return false;
            }

            //adding company to database
            $insert_company = $this->conn->prepare("INSERT INTO `companies` (`name`, `owner`, `email`, `phone`, `location`) VALUES (?,?,?,?,?)");
            $insert_company->bind_param("sssss", $name, $owner, $email, $phone, $location);

            if ($insert_company->execute() == false) throw new FailInsertCompany("Failed Company registration.");

            //get new company ID
            $company_id = $this->getCompanyID($email);

            //insert company into users
            $user_type = "company";
            $enc_pass = password_hash($pass,PASSWORD_BCRYPT);
            $insert_user = $this->conn->prepare("INSERT INTO `users` (`email`, `pass`, `user_type`, `company_id`) VALUES (?,?,?,?)");
            $insert_user->bind_param("sssi", $email, $enc_pass, $user_type, $company_id);

            if ($insert_user->execute() == false) throw new FailInsertUser("Failed User registration.");

            return true;
        }

        function updateDev($name, $email, $phone, $location, $profile_picture, $price_per_hour, $javascript, $java, $net, $flutter, $python, $php, $description, $years_of_exp, $native_language, $linked_in) {

            //update dev
            $update_dev = $this->conn->prepare("UPDATE `devs` SET `name`=?,`phone`=?,`location`=?,`profile_picture`=?,`price_per_hour`=?,`javascript`=?,`java`=?,`net`=?,`flutter`=?,`python`=?,`php`=?,`description`=?,`years_of_exp`=?,`native_language`=?,`linked_in`=? WHERE `email` = ?");
            $update_dev->bind_param('ssssiiiiiiisisss', $name, $phone, $location, $profile_picture, $price_per_hour, $javascript, $java, $net, $flutter, $python, $php, $description, $years_of_exp, $native_language, $linked_in, $email);

            if ($update_dev->execute() == false) {
                throw new FailUpdateDev("Profile update failed");
                return false;
            }

            return true;
        }

        function updateUserPassword($email, $pass) {
            $enc_pass = password_hash($pass,PASSWORD_BCRYPT);
            $update_pass = $this->conn->prepare("UPDATE `users` SET `pass`= ? WHERE `email` = ?");
            $update_pass->bind_param("ss", $enc_pass, $email);

            if ($update_pass->execute() == false) {
                throw new FailUpdateUserPassword("Password update failed");
                return false;
            }

            return true;
        }

        function deleteUser($email) {
            $user = $this->getUser($email);
            $user_id = $user['id'];

            $prepared = $this->prepareDeleteUser();
            $prepared->bind_param("i", $user_id);
            if ($prepared->execute() == false) throw new FailDeleteUser("Couldn't delete user.");
            
            if ($user['user_type'] == 'dev') {
                $id = (int)$user['dev_id'];
                $prepared_2 = $this->prepareDeleteDev();
            } elseif($user['user_type'] == 'company') {
                $id = (int)$user['company_id'];
                $prepared_2 = $this->prepareDeleteCompany();
            } else {
                return false;
            }

            $prepared_2->bind_param("i",$id);
            if ($prepared_2->execute() == false) throw new FailDeleteProfile("Couldn't delete profile.");            

            return true;
        }

        function getLatestDevs() {
            $toReturn = array();
            $res = $this->conn->query("SELECT * FROM `devs` ORDER BY `id` DESC LIMIT 2");
            while ($row = $res->fetch_assoc()) {
                array_push($toReturn, $row);
            }
            return $toReturn;
        }

        function getDevelopersForPage($page) {
            switch ($page) {
                case 1:
                    $start = 0;
                    break;
                case 2:
                    $start = 7;
                    break;
                case 3:
                    $start = 14;
                    break;
                case 4:
                    $start = 21;
                    break;
            }

            $toReturn = array();
            $res = $this->conn->query("SELECT * FROM `devs` LIMIT $start,7");
            while ($row = $res->fetch_assoc()) {
                array_push($toReturn, $row);
            }
            return $toReturn;

        }

        function getCompaniesForPage($page) {
            switch ($page) {
                case 1:
                    $start = 0;
                    break;
                case 2:
                    $start = 6;
                    break;
            }

            $toReturn = array();
            $res = $this->conn->query("SELECT * FROM `companies` LIMIT $start,6");
            while ($row = $res->fetch_assoc()) {
                array_push($toReturn, $row);
            }
            return $toReturn;

        }

    }

    $conn = new Conection();
    
