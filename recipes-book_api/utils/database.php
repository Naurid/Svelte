<?php


class Database {
    private $host = 'localhost';
    private $user = 'username';
    private $password = 'password';
    private $database = 'dbname';
    private $conn;
    
    public function __construct($hostName = 'default') {
        global $serverConfig;
        
        
        $this->host = $serverConfig[$hostName]['server'];
        $this->user = $serverConfig[$hostName]['user'];
        $this->password = $serverConfig[$hostName]['password'];
        $this->database = $serverConfig[$hostName]['db'];
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->database}";
            $this->conn = new PDO($dsn, $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            finish([
                "responseCode"=>400,
                "message"=>"une erreur avec la dataBase est survenue ! Réessayez plus tard."
            ]);
        }
    }

    public function create($table, $data) {
        $keys = implode(',', array_keys($data));
        echo $keys;
        $values = ':' . implode(',:', array_keys($data));
        $sql = "INSERT INTO $table ($keys) VALUES ($values)";
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data);
            return $this->conn->lastInsertId();
        } catch (\Throwable $th) {
            //throw $th;
            error_log($th->getMessage(),3, 'errors.log');
            finish([
                "responseCode"=>400,
                "message"=>"une erreur avec la dataBase est survenue ! Réessayez plus tard."
            ]);
        }
    }

    public function update($table, $dataset = [], $datawhere = [], $param = null, $dataParam = []) {
        $set = '';
        foreach ($dataset as $key => $value) {
            $set .= "$key=:$key,";
        }
        $set = rtrim($set, ',');

        $where = '';
        $sqlDataWhere = [];
        if ($datawhere) {
            foreach ($datawhere as $key => $value) {
                $where .= "$key=:where$key AND ";
                $sqlDataWhere['where'.$key]= $value;
            }
            $where = rtrim($where, ' AND ');
        }

        $sql = "UPDATE $table SET $set";
        if ($where !== '') {
            $sql .= " WHERE $where ";
        }
        if ($param) {
            $sql .= ' ' . $param;
        }

        try {
            $stmt = $this->conn->prepare($sql);
            $allData = $dataset + $sqlDataWhere + $dataParam;
            $stmt->execute($allData);
            return $stmt->rowCount();
        } catch (\Throwable $th) {
            error_log($th->getMessage(),3, 'errors.log');
            finish([
                "responseCode"=>400,
                "message"=>"une erreur avec la dataBase est survenue ! Réessayez plus tard."
            ]);
        }
    }

    public function delete($table, $datawhere) {
        $where = '';
        foreach ($datawhere as $key => $value) {
            $where .= "$key=:$key AND ";
        }
        $where = rtrim($where, ' AND ');

        $sql = "DELETE FROM $table  WHERE $where";
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($datawhere);
            return $stmt->rowCount();
        } catch (\Throwable $th) {
            error_log($th->getMessage(),3, 'errors.log');
                        finish([
                "responseCode"=>400,
                "message"=>"une erreur avec la dataBase est survenue ! Réessayez plus tard."
            ]);
        }
    }

    public function read($table, $columns = ['*'], $datawhere = [], $param = null, $data = []) {
        $temporyColumns = '';
        if (is_iterable($columns)) {
            foreach ($columns as $column) {
                $temporyColumns .= "$column, ";
            }
            $temporyColumns = rtrim($temporyColumns, ', ');
        }else{
            $temporyColumns = $columns;
        }
        $columns = $temporyColumns;

        $where = '';
        if ($datawhere) {
            foreach ($datawhere as $key => $value) {
                $where .= "$key=:$key AND ";
            }
            $where = rtrim($where, ' AND ');
        }
        $sql = "SELECT $columns FROM $table";
        if ($where) {
            $sql .= " WHERE $where ";
        }

        if ($param) {
            $sql .= ' ' . $param;
        }
        try {
            $stmt = $this->conn->prepare($sql);
            $allData = $datawhere + $data;
            // error_log( "-------------- test : " . json_encode($allData) . " - " . $table . "\n", 3, "errors.log");
            $stmt->execute($allData);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            error_log($th->getMessage(),3, 'errors.log');
            finish([
                "responseCode"=>400,
                "message"=>"une erreur avec la dataBase est survenue ! Réessayez plus tard."
            ]);

        }
    }
}
?>
