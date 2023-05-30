<?php

class Connection{
    protected  static $database = DB_NAME;
    protected  static $port = 3306;
    protected  static $charset ="uft8";
    protected  static $user = DB_USER;
    protected  static $password = DB_PASSWORD;
    protected  static $host = DB_HOST;
    protected  static $cn;


    public static function connect(){
        try {
            self::$cn = new PDO("mysql:host=".self::$host.";dbname=".self::$database.";port=".self::$port.";".self::$charset,self::$user, self::$password);
            self::$cn->setAttribute(PDO::ATTR_CASE,PDO::CASE_LOWER);
            self::$cn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            self::$cn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
            
            return self::$cn;
        } catch (PDOException $e) {
            echo "Error al conectar a la BD" . $e->getMessage();
            
        }
        
    }
    
}
?>