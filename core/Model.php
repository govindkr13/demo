<?php

namespace core;

use core\App;
use PDO;

abstract class Model
{
    const RULE_REQUIRED = 'required';

    public $errors = [];

    abstract public static function tableName();

    public function primaryKey(): string
    {
        return 'id';
    }

    public function loadData($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    public function attributes()
    {
        return [];
    }

    public function labels()
    {
        return [];
    }

    public function getLabel($attribute)
    {
        return $this->labels()[$attribute] ?? $attribute;
    }

    public function rules()
    {
        return [];
    }

    public function validate()
    {
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};
            foreach ($rules as $rule) {
                $ruleName = $rule;
                if (!is_string($rule)) {
                    $ruleName = $rule[0];
                }
                if ($ruleName === self::RULE_REQUIRED && !$value) {
                    $this->addErrorByRule($attribute, self::RULE_REQUIRED);
                }
            }
        }
        return empty($this->errors);
    }

    public function errorMessages()
    {
        return [
            self::RULE_REQUIRED => 'This field is required',
        ];
    }

    public function errorMessage($rule)
    {
        return $this->errorMessages()[$rule];
    }

    protected function addErrorByRule(string $attribute, string $rule, $params = [])
    {
        $params['field'] ?? $attribute;
        $errorMessage = $this->errorMessage($rule);
        foreach ($params as $key => $value) {
            $errorMessage = str_replace("{{$key}}", $value, $errorMessage);
        }
        $this->errors[$attribute][] = $errorMessage;
    }

    public function addError(string $attribute, string $message)
    {
        $this->errors[$attribute][] = $message;
    }

    public function hasError($attribute, $first = false)
    {
        if ($first) {
            return $this->errors[$attribute][0] ?? false;
        }

        return $this->errors[$attribute] ?? false;
    }

    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();

        $params = array_map(function ($attr) {
            return ":$attr";
        }, $attributes);

        // echo "INSERT INTO $tableName (" . implode(",", $attributes) . ") 
        // VALUES (" . implode(",", $params) . ")";
        // die;
        // echo '<pre>';
        // print_r($params);
        // die;

        $statement = self::prepare("INSERT INTO $tableName (" . implode(",", $attributes) . ") 
                VALUES (" . implode(",", $params) . ")");

        // print_r($statement);

        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }

        $statement->execute();
        return true;
    }

    public function update()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();

        $params = array_map(function ($attr) {
            return "$attr=:$attr";
        }, $attributes);

        $sql = "UPDATE {$tableName} SET " . implode(",", $params) . " WHERE id=:id";
        $statement = self::prepare($sql);
        foreach ($attributes as $attribute) {
            $data[$attribute] = $this->{$attribute};
            $statement->bindValue(":$attribute", $this->{$attribute});
        }

        // echo '<pre>';
        // print_r($data);
        // die;
        $statement->execute();
        return true;

        // $sql = "UPDATE {$tableName} SET " . implode(",", $attributes) . " WHERE id=:id";
        // $stmt= $pdo->prepare($sql);
        // $stmt->execute($data);
    }

    public static function prepare($sql)
    {
        return App::$app->db->prepare($sql);
    }

    public static function findOne($where)
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $sql = implode("AND", array_map(function ($attr) {
            return "$attr = :$attr";
        }, $attributes));

        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
        $statement->execute();
        return $statement->fetchObject(static::class);
    }

    public static function findAll()
    {
        $tableName = static::tableName();
        $statement = self::prepare("SELECT * FROM $tableName");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS, static::class);
    }
}
