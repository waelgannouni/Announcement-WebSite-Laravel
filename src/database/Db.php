<?php
namespace Tayara\DataBase;

use Exception;
use PDO;


class Db
{

  private $PDOInstance = null;
 
  private static $instance = null;
 
  const DEFAULT_SQL_USER = 'root';

  const DEFAULT_SQL_HOST = 'localhost';
 
  const DEFAULT_SQL_PASS = '';

  const DEFAULT_SQL_DTB = 'ROOP';
 

  private function __construct()
  {
    $this->PDOInstance = new PDO('mysql:dbname='.self::DEFAULT_SQL_DTB.';host='.self::DEFAULT_SQL_HOST,self::DEFAULT_SQL_USER ,self::DEFAULT_SQL_PASS);      
  }
 
  public function __clone() {
    throw new Exception('You can not clone this class', 1);
  }

  public static function getInstance()
  {  
    if(is_null(self::$instance))
    {
      self::$instance = new Db();
    }
    return self::$instance;
  }
 
  public function query(string $query,array $args)
   {
    try {
      // QUERYING DATA
      $data = $this->PDOInstance->prepare($query);
      $data->execute($args);

        // FETCHING DATA
        $results = $data->fetchAll(PDO::FETCH_ASSOC);

    } catch(Exception $error) {
      // ERROR
      return $error;
    }
    // RETURNING DATA
    return $results;
   }

   public function insertQuery(string $query,array $args)
   {
    try {
      // QUERYING DATA
      $data = $this->PDOInstance->prepare($query);
      $data->execute($args);

    } catch(Exception $error) {
      // ERROR
      throw $error;
    }
    // RETURNING DATA
    return $data;
   }
}