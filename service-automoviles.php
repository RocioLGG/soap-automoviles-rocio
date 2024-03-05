<?php
include 'GestionAutomoviles.php';

class server {
    private $con;
    private $IsAuthenticated;

    public function __construct() {
        $this->con = (is_null($this->con)) ? self::connect() : $this->con;
        $this->IsAuthenticated = false;
    }

    static function connect() {
        try {
            $user = "root";
            $pass = "root";
            $dbname = "coches";
            $host = "127.0.0.1";

            $con = new PDO("mysql:host=$host; dbname=$dbname", $user, $pass);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $con;
        } catch (PDOException $e) {
            print "<p>Error: " . $e->getMessage() . "</p>\n";
            return null;
        }
    }

    public function authenticate($header_params) {
        if ($header_params->username === 'ies' && $header_params->password == 'daw') {
            $this->IsAuthenticated = true;
            return true;
        } else {
            throw new SoapFault('Wrong user/pass combination', 401);
        }
    }
}

$params = array('uri' => 'http://localhost/soap-automoviles-rocio/service-automoviles.php');
$server = new SoapServer(null, $params);
$server->setClass('server');
$server->handle();
?>