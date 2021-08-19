<?php


namespace app\models;

use core\Model;
use PDO;

class Course extends Model
{
    public $id;
    public $name;
    public $detail;

    public static function tableName()
    {
        return 'course';
    }

    public function attributes(): array
    {
        return ['name', 'detail'];
    }

    public function labels(): array
    {
        return [
            'name' => 'Course Name',
            'detail' => 'Course Detail',
        ];
    }

    public function rules()
    {
        return [
            'name' => [self::RULE_REQUIRED],
            'detail' => [self::RULE_REQUIRED],
        ];
    }

    public static function getList($pageSize = 10, $page = 1)
    {

        $sql = "SELECT count(*) FROM course";
        $statement = self::prepare($sql);
        $statement->execute();
        $total = $statement->fetchColumn();

        $pages = ceil($total / $pageSize);
        $offset = ($page - 1) * $pageSize;
        
        // Prepare the paged query
        $statement = self::prepare("SELECT * from course ORDER BY id LIMIT :limit OFFSET :offset");
        $statement->bindParam(':limit', $pageSize, PDO::PARAM_INT);
        $statement->bindParam(':offset', $offset, PDO::PARAM_INT);
        $statement->execute();

        $users = $statement->fetchAll(PDO::FETCH_CLASS, static::class);
        
        return [$pages, $users];
    }
}
