<?php

namespace Core;

class Request
{
    public $__errors = [], $__rules = [], $__messages = [];
    static private $__db, $__object;

    public function __construct()
    {
        if (self::$__db == null) {
            self::$__db = new Database();
        }
    }

    public function rules($rules = [])
    {
        $this->__rules = $rules;
    }

    public function errors($field = "")
    {
        if (!empty($this->__errors[$field])) {
            return reset($this->__errors[$field]);
        }
        $errors = [];
        foreach ($this->__errors as $key => $value) {
            $errors[$key] = reset($value);
        }
        return $errors;
    }

    public function messages($messages = [])
    {
        $this->__messages = $messages;
    }

    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isPost()
    {
        return $this->getMethod() == "post" ? true : false;
    }

    public function isGet()
    {
        return $this->getMethod() == "get" ? true : false;
    }

    public function getFields()
    {
        $dataFields = [];
        if ($this->isPost()) {
            foreach ($_POST as $key => $value) {
                if (is_array($value)) {
                    $dataFields[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                } else {
                    $dataFields[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }
        }

        if ($this->isGet()) {
            foreach ($_GET as $key => $value) {
                if (is_array($value)) {
                    $dataFields[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                } else {
                    $dataFields[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }
        }
        return $dataFields;
    }

    public function setError($fieldName = "", $ruleName = "")
    {
        return $this->__errors[$fieldName][$ruleName] = $this->__messages["$fieldName.$ruleName"];
    }

    public function validation($callback = "")
    {
        if (!empty($callback) && self::$__object == null) {
            $object = new $callback;
            $this->rules($object->rules());
            $this->messages($object->messages());
            self::$__object = true;
        }

        $check = true;
        if (!empty($this->__rules)) {
            $dataFields = $this->getFields();
            foreach ($this->__rules as $fieldName => $ruleItem) {
                $ruleItemArr = explode("|", $ruleItem);
                foreach ($ruleItemArr as $rule) {
                    $dataFields[$fieldName] = trim($dataFields[$fieldName]);
                    $ruleName = "";
                    $ruleValue = "";
                    $ruleArr = explode(":", $rule);
                    $ruleName = reset($ruleArr);
                    if (!empty($ruleArr[1])) {
                        $ruleValue = $ruleArr[1];
                    }

                    if ($ruleName == "required") {
                        if (empty($dataFields[$fieldName])) {
                            $this->setError($fieldName, $ruleName);
                            $check = false;
                        }
                    }

                    if ($ruleName == "min") {
                        if (strlen($dataFields[$fieldName]) < $ruleValue) {
                            $this->setError($fieldName, $ruleName);
                            $check = false;
                        }
                    }

                    if ($ruleName == "max") {
                        if (strlen($dataFields[$fieldName]) > $ruleValue) {
                            $this->setError($fieldName, $ruleName);
                            $check = false;
                        }
                    }

                    if ($ruleName == "email") {
                        if (!filter_var($dataFields[$fieldName], FILTER_VALIDATE_EMAIL)) {
                            $this->setError($fieldName, $ruleName);
                            $check = false;
                        }
                    }

                    if ($ruleName == "number") {
                        if (!filter_var($dataFields[$fieldName], FILTER_VALIDATE_INT)) {
                            $this->setError($fieldName, $ruleName);
                            $check = false;
                        }
                    }

                    if ($ruleName == "match") {
                        if ($dataFields[$fieldName] != $dataFields[$ruleValue]) {
                            $this->setError($fieldName, $ruleName);
                            $check = false;
                        }
                    }

                    // callback
                    $pattern = "~^callback_(.+?)$~is";
                    if (preg_match($pattern, $ruleName, $matches)) {
                        if (!empty($matches[1])) {
                            $controller = Route::getCurrentController();
                            if (method_exists($controller, $matches[1])) {
                                $checkCallback = call_user_func_array([$controller, $matches[1]], [$dataFields[$fieldName]]);
                                if (!$checkCallback) {
                                    $this->setError($fieldName, $ruleName);
                                    $check = false;
                                }
                            }
                        }
                    }

                    if ($ruleName == "unique") {
                        $table = $ruleValue;
                        if (count($ruleArr) == 2) {
                            $sql = "SELECT * FROM $table WHERE $fieldName = '$dataFields[$fieldName]'";
                        } elseif (count($ruleArr) == 3) {
                            $fieldCheck =  str_replace("=", "<>", $ruleArr[2]);
                            $sql = "SELECT * FROM $table WHERE $fieldName = '$dataFields[$fieldName]' AND $fieldCheck";
                        }
                        $checkUniquer = self::$__db->query($sql)->rowCount();
                        if ($checkUniquer) {
                            $this->setError($fieldName, $ruleName);
                            $check = false;
                        }
                    }
                }
            }
        }
        $sessionKey = Session::isInvalid();
        Session::flash($sessionKey . "_error", $this->errors());
        Session::flash($sessionKey . "_old", $this->getFields());
        if (!$check) {
            $callback = Session::flash("callback");
            return Response::redirect($callback);
        }
        return $check;
    }
}
