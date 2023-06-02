<?php
namespace Pangio;

use PDO;
use PDOException;

class Database {
    private Config $config;
    private array $databaseConfig;
    private string $connectionString;

    protected string $select;
    protected string $from;
    protected string $where;
    protected string $query;

    public function __construct() {
        $this->config = new Config();
        $this->databaseConfig = $this->config->getDatabaseConfig();
        $this->connectionString = $this->buildConnectionString();
    }

    public function connect() :PDO {
        try {
            $connection = new PDO($this->connectionString, $this->databaseConfig['username'], $this->databaseConfig['password']);
            $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
        catch (PDOException $exception) {
            die($exception->getMessage());
        }

        return $connection;
    }

    public function select(string $select) :void {
        $this->select = $select;
    }

    public function from(string $table) :void {
        $this->from = $table;
    }

    public function where(string $where) :void {
        $this->where = $where;
    }

    public function buildQuery() :void {
        $this->query = 'SELECT ' . $this->select . ' FROM ' . $this->from . ' ' . $this->where;
    }

    public function execute() :array {
        $db = $this->connect();
        $statement = $db->prepare($this->query);
        $statement->execute();

        $elements = [];
        while($row = $statement->fetch()) {
            $elements[] = $row;
        }

        return $elements;
    }

    public function getLastQuery() :string {
        return $this->query;
    }

    /* Private Methods */
    private function buildConnectionString() :string {
        $host = $this->databaseConfig['host'];
        $database = $this->databaseConfig['database'];

        return 'mysql:host=' . $host . ';dbname=' . $database . ';';
    }
}