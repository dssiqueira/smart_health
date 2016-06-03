<?php
include('config.php');
class user {
    public $uid;
    public $email;
    public $nome;
    public $path_image;
    
    public function getUserByEmail($email){
        $search = new mysqlConnection;
        $user = new user;
        $query  = 'SELECT uid, email, name, path_image FROM USER WHERE email = "' . $email . '"';
        $result = $search->mysqlQuery($query);
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $user->uid          = $row["uid"];
                $user->email        = $row["email"];
                $user->nome         = $row["name"];
                $user->path_image   = $row["path_image"];
            }
        } 
        
        return $user;
    } 
    
    public function insertUser($email, $name, $path_image){
        $insert = new mysqlConnection;
        $query  = 'INSERT INTO USER(email, name, path_image) VALUES ("' . $email . '","' . $name . '","' . $path_image .'")';
        $insert->mysqlQuery($query);
    }
}
?>