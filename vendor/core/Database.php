<?php

namespace Core;

class Database extends Connection
{
    use QueryBuilder;
    private $__conn;
    public function __construct()
    {
        $this->__conn = Connection::getInstance();
    }

    public function insertData($data = [], $table = "")
    {
        $sql = "DESCRIBE $table";
        $checkField = $this->getRaw($sql);
        foreach ($checkField as $key => $value) {
            $fieldArr["field"][$key] = $value["Field"];
        }

        if (!empty($data)) {
            $fieldStr = "";
            $valueStr = "";
            foreach ($data as $key => $value) {
                if (in_array($key, $fieldArr['field'])) {
                    $fieldStr .= " $key,";
                    $valueStr .= " '$value',";
                }
            }
            $fieldStr = trim($fieldStr, ",");
            $valueStr = trim($valueStr, ",");
            $sql = "INSERT INTO $table ($fieldStr) VALUES($valueStr)";
            $status = $this->query($sql);
            $this->resetQuery();
        }
        return $status ? true : false;
    }

    public function updateData($data, $table,  $condition)
    {
        $sql = "DESCRIBE $table";
        $checkField = $this->getRaw($sql);
        foreach ($checkField as $key => $value) {
            $fieldArr["field"][$key] = $value["Field"];
        }
        
        if (!empty($data)) {
            $updateStr = "";
            foreach ($data as $key => $value) {
                if (in_array($key, $fieldArr['field'])) {
                    $updateStr .= " $key = '$value',";
                }
            }
            
            $updateStr = trim($updateStr, ",");
            $sql = "UPDATE $table SET  $updateStr $condition";
            $status = $this->query($sql);
            self::$comperator = "";
            $this->resetQuery();
        }
        return $status ? true : false;
    }

    public function deleteData($condition = "", $table = "")
    {
        if (!empty($condition)) {
            $sql = "DELETE FROM $table $condition";
            $status = $this->query($sql);
            self::$comperator = "";
            $this->resetQuery();
        }
        return $status ? true : false;
    }

    public function findData($field = "", $table = "", $primaryKey = "", $find = "")
    {
        if (!empty($find)) {
            $sql = "SELECT $field FROM $table WHERE  $primaryKey = '$find'";
            $result = $this->firstRaw($sql);
            $this->resetQuery();
            return $result;
        }
    }

    public function lastId()
    {
        $this->resetQuery();
        return $this->__conn->lastInsertId();
    }

    public function query($sql = "")
    {
        $stmt =  $this->__conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
}
