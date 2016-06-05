<?php
include('config.php');
class user {
    public $uid;
    public $email;
    public $name;
    public $path_image;
    
    public function getUserByEmail($email){
        $search = new mysqlConnection;
        $user = new user;
        $query  = 'SELECT uid, email, name, path_image FROM user WHERE email = "' . $email . '"';
        $result = $search->mysqlQuery($query);
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $user->uid          = $row["uid"];
                $user->email        = $row["email"];
                $user->name         = $row["name"];
                $user->path_image   = $row["path_image"];
            }
        } 
        
        return $user;
    } 
    
    public function insertUser($email, $name, $path_image){
        $insert = new mysqlConnection;
        $query  = 'INSERT INTO user(email, name, path_image) VALUES ("' . $email . '","' . $name . '","' . $path_image .'")';
        $insert->mysqlQuery($query);
    }
}
?>