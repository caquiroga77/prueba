<?php
class database
{
private static $dbName = 'nombre_de_la_basededatos';
private static $dbHost = 'localhost';
private static $dbUsername = 'nombre_de_usuario';
private static $dbUserPassword = 'contraseña';

private static $cont = null;

public function __construct() {
die('Init-Función no permitida');
}
public static function connect() {
// Permitir solo una conexión para la totalidad del acceso
if ( null == self::$cont )
{
  try
  {
    self::$cont = new PDO( "mysql:host=".self::$dbHost.";"."dbnombre=".self::$dbName, self::$dbUsername, self::$dbUserPassword);
  }
  catch(PDOException $e)
  {
    die($e->getMessage());
  }
}
return self::$cont;
}

public static function disconnect()
{
self::$cont = null;
}
}
