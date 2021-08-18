<?php


namespace app\models;

use core\App;
use core\Model;
use PDO;

class User extends Model
{
    public $id;
    public $first_name;
    public $last_name;
    public $dob;
    public $contact_no;


    public static function tableName()
    {
        return 'user';
    }

    public function attributes(): array
    {
        return ['id', 'first_name', 'last_name', 'dob', 'contact_no'];
    }

    public function labels(): array
    {
        return [
            'id' => 'Id',
            'first_name' => 'First name',
            'last_name' => 'Last name',
            'dob' => 'DOB',
            'contact_no' => 'Contact No',
        ];
    }

    public function rules()
    {
        return [
            'first_name' => [self::RULE_REQUIRED],
            'last_name' => [self::RULE_REQUIRED],
            'dob' => [self::RULE_REQUIRED],
            'contact_no' => [self::RULE_REQUIRED],
        ];
    }

    public static function getList($pageSize = 10, $page = 1)
    {

        $sql = "SELECT count(*) FROM user";
        $statement = self::prepare($sql);
        $statement->execute();
        $total = $statement->fetchColumn();

        $pages = ceil($total / $pageSize);
        $offset = ($page - 1) * $pageSize;
        
        // Prepare the paged query
        $statement = self::prepare("SELECT * from user ORDER BY id LIMIT :limit OFFSET :offset");
        $statement->bindParam(':limit', $pageSize, PDO::PARAM_INT);
        $statement->bindParam(':offset', $offset, PDO::PARAM_INT);
        $statement->execute();

        $users = $statement->fetchAll(PDO::FETCH_CLASS, static::class);
        
        return [$pages, $users];
    }
}
