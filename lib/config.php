<?php
class mysqlConnection { 
    public $host        = 'mysql.comovejoomundo.com.br'; 
    public $database    = 'comovejoomundo07';
    public $user        = 'comovejoomundo07';
    public $pass        = 'S1t3Adm1n99';  
    
     
    public function mysqlQuery($sql){
        $my = new mysqlConnection;
        
        // Create connection
        $conn = new mysqli($my->host, $my->user, $my->pass, $my->database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $result = $conn->query($sql);
        $conn->close();
        
        return $result;
    }
} 

class apiStrava {
    public $client_id       = '11678';
    public $client_secret   = '8a0948c4b088f47697c44f206c343a4cf598341b';
}

class apiRuneeper {
    public $client_id       = '8ca1c685ee4a4ad88ffcddfe24f3d0cf';
    public $client_secret   = 'b82055792ae344aea00f5dc3c176727a';
}

?>