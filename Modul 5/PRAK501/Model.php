<?php

class Model {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function insert($table, $data) {
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($data);
    }

    public function update($table, $data, $where) {
        $setParts = [];
        foreach ($data as $column => $value) {
            $setParts[] = "$column = :$column";
        }
        $setClause = implode(", ", $setParts);

        $whereParts = [];
        foreach ($where as $column => $value) {
            $whereParts[] = "$column = :where_$column";
        }
        $whereClause = implode(" AND ", $whereParts);

        $sql = "UPDATE $table SET $setClause WHERE $whereClause";
        $stmt = $this->pdo->prepare($sql);

        foreach ($where as $column => $value) {
            $data["where_$column"] = $value;
        }

        return $stmt->execute($data);
    }

    public function delete($table, $where) {
        $whereParts = [];
        foreach ($where as $column => $value) {
            $whereParts[] = "$column = :$column";
        }
        $whereClause = implode(" AND ", $whereParts);
        $sql = "DELETE FROM $table WHERE $whereClause";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($where);
    }

    public function getData($table, $where = [], $columns = ['*'], $orderBy = '') {
    $columns = implode(", ", $columns);
    $sql = "SELECT $columns FROM $table";

    if (!empty($where)) {
        $whereParts = [];
        foreach ($where as $column => $value) {
            $whereParts[] = "$column = :$column";
        }
        $whereClause = implode(" AND ", $whereParts);
        $sql .= " WHERE $whereClause";
    }

    if (!empty($orderBy)) {
        $sql .= " $orderBy";
    }

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($where);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function customQuery($query, $params = [])
    {
    $stmt = $this->pdo->prepare($query);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>