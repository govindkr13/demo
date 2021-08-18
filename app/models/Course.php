<?php


namespace app\models;

use core\Model;

class Course extends Model
{
    public $id;
    public $course_name;
    public $course_detail;

    public static function tableName()
    {
        return 'course';
    }

    public function attributes(): array
    {
        return ['course_name', 'course_detail'];
    }

    public function labels(): array
    {
        return [
            'course_name' => 'Course Name',
            'course_detail' => 'Course Detail',
        ];
    }

    public function rules()
    {
        return [
            'course_name' => [self::RULE_REQUIRED],
            'course_detail' => [self::RULE_REQUIRED],
        ];
    }
}
