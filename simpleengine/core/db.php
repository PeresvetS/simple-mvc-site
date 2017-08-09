<?php


namespace simpleengine\core;

use \simpleengine\core\Application;

class Db
{
    private $pdo;

    /**
     * __construct
     * @param string $connection_name 
     */
    public function __construct(string $connection_name = "DB")
    {
        $app = Application::instance();

        try {
            $pass = $app->get($connection_name)["DB_PASS"];
            $user = $app->get($connection_name)["DB_USER"];
            $name = $app->get($connection_name)["DB_NAME"];
            $host = $app->get($connection_name)["DB_HOST"];
            $charset = $app->get($connection_name)["DB_CHARSET"];
            $dsn = 'mysql:dbname='.$name.';host='.$host.";charset=".$charset;

            $this->pdo = new \PDO($dsn, $user, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(\PDOException $e){
            echo "Can't connect to database";
        }
    }


    /**
     * getArrayBySqlQuery
     * @param string $sql
     * @param array $param 
     * @return array 
     */
    public function getAssocResult(string $sql, $params = []) : array
    {
        $statement = $this->pdo->prepare($sql);
        $statement->execute($params);
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }


    /**
     * getRowResult
     * @param string $sql 
     * @param array $params 
     * @return string 
     */
    public function getRowResult(string $sql, array $params = []) : string
    {
        $arrayResult = getAssocResult($sql);
        if(isset($arrayResult[0])) {
            return $arrayResult[0];
        }
        return false;
    }



    /**
     * executeQuery
     * @param string $sql 
     * @return bool 
     */
    public function executeQuery(string $sql) : bool
    {
        $statement = $this->pdo->prepare($sql);
        return $statement->execute();

    }

}