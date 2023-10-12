<?php

/**
 * Model class
 */

class Model extends Database
{
    protected string $table;
    protected array $insert_columns;
    protected array $select_columns;
    protected array $update_columns;
    protected array $errors;


    public function get_errors(): array
    {
        return $this->errors;
    }

    protected function insert_hook(array $data): array
    {
        return $data;
    }

    public function insert(array $data): int
    {
        $data = $this->insert_hook($data);

        // Remove unwanted columns
        $keys = array_keys($data);
        foreach ($keys as $key) {
            if (!in_array($key, $this->insert_columns))
                unset($data[$key]);
        }

        // Building query
        $query = "INSERT INTO $this->table ";
        $query .= "(" . implode(',', array_keys($data)) . ") ";
        $query .= "VALUES (:" . implode(',:', array_keys($data)) . ")";


        $id = $this->iud($query, $data);
        return $id;
    }

    public function update(int $id, array $data, array $update_columns = []): void
    {
        if (empty($update_columns)) {
            $update_columns = $this->update_columns;
        }


        $keys = array_keys($data);
        $query = "UPDATE $this->table SET ";

        foreach ($keys as $key) {
            $query .= "$key=:$key, ";
        }
        $query = trim($query, ", ");
        $query .= " WHERE id=:id";
        $data['id'] = $id;
        $this->iud($query, $data);
    }

    public function delete($data): void
    {
        $query = "DELETE FROM .$this->table WHERE ";
        $keys = array_keys($data);
        foreach ($keys as $key) {
            $query .= "$key=:$key && ";
        }
        $query = trim($query, ' && ');
        $this->iud($query, $data);
    }

    public function select(array $data, array $select_columns = []): array|null
    {
        if (empty($select_columns)) {
            $select_columns = $this->select_columns;
        }

        $keys = array_keys($data);
        $query = "SELECT " . implode(',', $select_columns) . " FROM $this->table WHERE ";

        foreach ($keys as $key) {
            $query .= "$key = :$key && ";
        }

        $query = trim($query, " && ");

        $result = $this->get($query, $data);
        if (is_array($result) && !empty($result)) {
            return $result;
        }
        return null;
    }

    public function selectOne(array $data, array $select_columns = []): array|object|null
    {
        if (empty($select_columns)) {
            $select_columns = $this->select_columns;
        }

        $keys = array_keys($data);
        $query = "SELECT " . implode(',', $select_columns) . " FROM $this->table WHERE ";

        foreach ($keys as $key) {
            $query .= "$key = :$key && ";
        }

        $query = trim($query, " && ");
        $query .= " ORDER BY id DESC LIMIT 1";

        $result = $this->get($query, $data);
        if (is_array($result) && !empty($result)) {
            return $result[0];
        }
        return null;
    }

    public function selectAll(array $select_columns = [], int $limit = 1000): array|null
    {
        if (empty($select_columns)) {
            $select_columns = $this->select_columns;
        }
        $query = "SELECT " . implode(',', $select_columns) . " FROM $this->table";
        $result = $this->get($query);
        if (is_array($result) && !empty($result)) {
            return $result;
        }
        return null;
    }
}
