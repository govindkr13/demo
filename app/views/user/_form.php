<form id="user-registration" action="" method="POST">
    
    <div class="row">
        ` <label><?= $model->getLabel('first_name') ?></label>
        <input type="text" name="first_name" value="<?= $model->first_name ?>" />
        <span class="error"><?= $model->hasError('first_name', true) ?></span>
    </div>

    <div class="row">
        <label><?= $model->getLabel('last_name') ?></label>
        <input type="text" name="last_name" value="<?= $model->last_name ?>" />
        <span class="error"><?= $model->hasError('last_name', true) ?></span>
    </div>

    <div class="row">
        <label><?= $model->getLabel('dob') ?></label>
        <input type="text" name="dob" value="<?= $model->dob ?>" />
        <span class="error"><?= $model->hasError('last_name', true) ?></span>
    </div>

    <div class="row">
        <label><?= $model->getLabel('contact_no') ?></label>
        <input type="text" name="contact_no" value="<?= $model->contact_no ?>" />
        <span class="error"><?= $model->hasError('contact_no', true) ?></span>
    </div>

    <div class="row">
        <input type="submit" value="Submit" />
    </div>

</form>