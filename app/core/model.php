<?php

/**
 * Model class
 */

abstract class Model extends Database
{
    protected string $table;
    protected array $allowed_columns;
    protected array $errors;

    protected abstract function insert_hook(array $data): array;

    public function insert(array $data): int
    {
        $data = $this->insert_hook($data);

        // Remove unwanted columns
        $keys = array_keys($data);
        foreach ($keys as $key) {
            if (!in_array($key, $this->allowed_columns))
                unset($data[$key]);
        }

        // Building query
        $query = "INSERT INTO $this->table ";
        $query .= "(" . implode(',', array_keys($data)) . ") ";
        $query .= "VALUES (:" . implode(',:', array_keys($data)) . ")";


        $id = $this->iud($query, $data);
        return $id;
    }

    public function select($data): array|object|bool
    {

        $keys = array_keys($data);
        $query = "SELECT * FROM $this->table WHERE ";

        foreach ($keys as $key) {
            $query .= "$key = :$key && ";
        }

        $query = trim($query, " && ");

        $result = $this->get($query, $data);
        if (is_array($result) || is_object($result)) {
            return $result;
        }
        return false;
    }

    public function get_errors(): array {
        return $this->errors;
    }
}
