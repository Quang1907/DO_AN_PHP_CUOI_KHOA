<?php

namespace Core;

use PDO;

trait QueryBuilder

{
    static public $tableName = "";
    static public $fieldName = "*";
    static public $primaryKey = "";
    static public $comperator = "";
    static public $where = "";
    static public $orWhere = "";
    static public $limit = "";
    static public $orderBy = "";
    static public $join = "";
    static public $tableJoin = "";
    static public $db = "";

    static public function table($table = "")
    {
        self::$tableName = $table;
        return new static;
    }

    static public function select($select = "")
    {
        self::$fieldName = $select;
        return new static;
    }

    static public function where($field = "", $operator = "", $condition = "")
    {
        self::$comperator = empty(self::$comperator) ? " WHERE " : " AND ";
        if (empty($condition)) {
            $condition = $operator;
            $operator = "=";
        }
        if (!empty($operator) && !empty($field)) {
            self::$where .= self::$comperator . "$field $operator '$condition'";
        }
        return new static;
    }

    static public function orWhere($field = "", $operator = "", $condition = "")
    {
        self::$comperator = empty(self::$comperator) ? " WHERE " : " OR ";
        if (empty($condition)) {
            $condition = $operator;
            $operator = "=";
        }
        if (!empty($operator) && !empty($field)) {
            self::$orWhere .= self::$comperator . "$field $operator $condition";
        }
        return new static;
    }

    static public function limit($number =  "", $offset = 0)
    {
        if (!empty($number)) {
            self::$limit = " LIMIT $offset, $number";
        }
        return new static;
    }

    /**
     * orderBy("id", "desc")
     * orderBy("id asc, email desc")
     */
    static public function orderBy($field = "", $type = "ASC")
    {
        $fieldArr = explode(",", $field);
        if (count($fieldArr) > 1) {
            $orderBy = implode(",", $fieldArr);
            self::$orderBy = " ORDER BY $orderBy";
        } else {
            self::$orderBy = " ORDER BY $field $type";
        }
        return new static;
    }

    static public function join($tableJoin = "", $relationship = "")
    {
        if (!empty($tableJoin) && !empty($relationship)) {
            self::$tableJoin = $tableJoin;
            self::$join .= " INNER JOIN $tableJoin ON $relationship";
            // DESCRIBE user;
        }
        return new static;
    }

    static public function insert($data = [])
    {
        if (!empty(self::$tableName)) {
            $table = self::$tableName;
        } else {
            self::getTableStatic($table);
        }
        return self::Db()->insertData($data, $table);
    }

    static public function update($data = [])
    {
        self::getTableStatic($table);
        return self::Db()->updateData($data, $table, self::$where);
    }

    static public function delete()
    {
        self::getTableStatic($table);
        return self::Db()->deleteData(self::$where, $table);
    }

    static public function find($find = "")
    {
        if (!empty($find)) {
            self::getPrimaryKey($primaryKey);
            self::getTableStatic($table);
            $field = self::getFieldStatic();
            return self::Db()->findData($field, $table, $primaryKey, $find);
            // $sql = "SELECT " . self::getFieldStatic() . " FROM " . $table . " WHERE " . $primaryKey . " = '$find'";
        }
    }

    static private function getTableStatic(&$table)
    {
        $model = get_called_class();
        $class = new $model;
        $table = $class->table;
        if (empty($table)) {
            $table = str_replace("App\Models\\", "", $model);
        }
    }

    static public function getFieldStatic()
    {
        if (empty(self::$fieldName)) {
            $model = get_called_class();
            self::$fieldName =  (new $model)->field;
        }
        return self::$fieldName;
    }

    static private function getPrimaryKey(&$primaryKey)
    {
        $model = get_called_class();
        $class = new $model;
        $primaryKey = $class->primary;
    }

    static private function Db()
    {
        return new Database();
    }

    public function get()
    {
        $sql = "SELECT " . $this->getField() . " FROM " . $this->getTable() . self::$join . self::$where . self::$orWhere . self::$orderBy .  self::$limit;
        $result =  $this->getRaw($sql);
        $this->resetQuery();
        return $result;
    }

    static public function all()
    {
        self::getTableStatic($table);
        $field = self::getFieldStatic();
        $sql = "SELECT $field FROM $table";
        return self::Db()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // static public function getColumn()
    // {
    //     $sql = "DESCRIBE " . self::$tableName;
    // }

    public function first()
    {
        $sql = "SELECT " . $this->getField() . " FROM " . $this->getTable() . self::$join . self::$where . self::$orWhere . self::$orderBy .  self::$limit;
        $result =  $this->firstRaw($sql);
        $this->resetQuery();
        return $result;
    }

    public function count()
    {
        $sql = "SELECT " . $this->getField() . " FROM " . $this->getTable() . self::$join . self::$where . self::$orWhere . self::$orderBy .  self::$limit;
        $result =  $this->countColumn($sql);
        $this->resetQuery();
        return $result;
    }

    public function lastInsertId()
    {
        return $this->lastId();
    }

    public function describe()
    {
        $sql = "DESCRIBE " . self::$tableName;
        return $this->getRaw($sql);
    }

    public function getRaw($sql = "")
    {
        $result = $this->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function firstRaw($sql = "")
    {
        $result = $this->query($sql);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function countColumn($sql = "")
    {
        $result = $this->query($sql);
        return $result->rowCount();
    }

    public function getTable()
    {
        if (empty(self::$tableName)) {
            if (!empty($this->table)) {
                return $this->table;
            }
            $model = get_class($this);
            $table = str_replace("App\Models\\", "", $model);
            return $table;
        }
        return self::$tableName;
    }

    public function getField()
    {
        $fieldArr  = [];
        if (!empty($this->field)) {
            $fieldArr = explode(",", $this->field);
        }
        if (count($fieldArr) > 1) {
            $field = "";
            foreach ($fieldArr as $key => $value) {
                $field .= " " . $this->getTable() . ".$value,";
            }
            $field = trim($field, ",");
        } else {
            $field = reset($fieldArr);
        }
        return !empty(self::$fieldName) ? self::$fieldName : $field;
    }

    public function resetQuery()
    {
        self::$tableName = "";
        self::$fieldName = "*";
        self::$comperator = "";
        self::$where = "";
        self::$orWhere = "";
        self::$limit = "";
        self::$orderBy = "";
        self::$join = "";
        self::$tableJoin = "";
    }
}
