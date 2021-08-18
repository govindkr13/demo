
<?php

echo '<pre>';
print_r($model);
echo '</pre>';
?>

<form id="user-registration" action="" method="POST">
    First Name : <input type="text" name="first_name" value="<?=$model->first_name?>"/>
    Last Name : <input type="text" name="last_name" value="<?=$model->last_name?>"/>
    DOB : <input type="text" name="dob" value="<?=$model->dob?>"/>
    <?=$model->getLabel('contact_no') ?> : <input type="text" name="contact_no" value="<?=$model->contact_no?>"/>

    <input type="submit" value="Submit"/>
</form>
