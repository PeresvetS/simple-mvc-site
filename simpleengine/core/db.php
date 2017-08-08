<?php


namespace simpleengine\core;

use \simpleengine\core\Application;

class Db
{
    private $pdo;

    public function __construct(string $connection_name = "DB")
    {
        $app = Application::instance();

        try{
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
    public function getArrayBySqlQuery(string $sql, $params)
    {
        $statement = $this->pdo->prepare($sql);
        $statement->execute($params);
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }
}