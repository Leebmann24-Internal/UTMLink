<?php
require_once('./vendor/autoload.php');

class Database
{
    public $pdo;

    public function __construct()
    {

        try {
            require_once('./vendor/autoload.php');
            $dotenv = Dotenv\Dotenv::create(__DIR__)->load();
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
            die();
        }
        $this->database_host = $dotenv['database_host'];
        $this->database_name = $dotenv['database_name'];
        $this->database_user = $dotenv['database_user'];
        $this->database_password = $dotenv['database_password'];

        try {
            $this->pdo = new PDO("mysql:host=$this->database_host;dbname=$this->database_name;charset=utf8", "$this->database_user", "$this->database_password");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->pdo;
        }  catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
            die();
        }
    }
}
