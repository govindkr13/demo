<?php
$this->title = 'Update User' . $user->first_name;

$this->renderPartial('user/_form', ['model' => $model]);
