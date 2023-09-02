<?php

class Database
{

    private function connect(): object
    {
        $conn_str = DB_DRIVER . ":hostname=" . DB_HOST . ";dbname=" . DB_NAME;
        try {
            return new PDO($conn_str, DB_USER, DB_PASSWORD);
        } catch (Exception $e) {
            error_log($e->getMessage());
            exit('Please check database configuration.');
        }
    }

    public function iud(string $sql, array $params = []): int
    {
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        try {
            $conn->beginTransaction();
            $stmt->execute($params);
            $id = $conn->lastInsertId();
            $conn->commit();
            return $id;
        } catch (PDOException $e) {
            $conn->rollback();
            print "Error!: " . $e->getMessage() . "</br>";
        }
        return 0;
    }

    public function get(string $sql, array $params = [], int $fetch_type = PDO::FETCH_OBJ): array|object|bool
    {
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);

        if (!$stmt->execute($params)) {
            return false;
        }
        $result = $stmt->fetchAll($fetch_type);

        if ($result && count($result) > 0)
            return $result;

        return false;
    }

    public function reset_id(string $table): bool
    {
        $result = $this->get("SELECT MAX(ID) AS max_id FROM `$table`");
        $new_id = ++$result[0]["max_id"];
        return $this->ddl("ALTER TABLE `$table` AUTO_INCREMENT=$new_id");
    }

    public function ddl(string $sql, array $data = []): mixed
    {
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        try {
            $stmt->execute($data);
            return true;
        } catch (PDOException $e) {
            print "Error: " . $e->getMessage();
            return false;
        }
    }
}
