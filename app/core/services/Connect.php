<?php

namespace core\services;

class Connect
{
    protected $pdo;
    public static $instanse;
    public function __construct()
    {
        $dbConfig = (require __DIR__ . '/../../settings.php')['db'];
        $this->pdo = new \PDO(
            'mysql:host=' . $dbConfig['host']. ';dbname=' . $dbConfig['dbname'],
            $dbConfig['user'],
            $dbConfig['password']
        );
        $this->pdo->exec('SET NAMES UTF8');
    }
    public function query(string $sql, array $params=[]) : ?array
    {
        $stmt = $this->pdo->prepare($sql);
        $res = $stmt->execute($params);
        if($res === false)
        {
            return null;
        }
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public static function getInstanse() : ?self
    {
        if(self::$instanse === null)
        {
            return self::$instanse = new self();
        }
        return self::$instanse;
    }
}