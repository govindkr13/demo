<form id="course" action="" method="POST">

    <div class="row">
        <label><?= $model->getLabel('name') ?></label>
        <input type="text" name="name" value="<?= $model->name ?>" />
        <span class="error"><?= $model->hasError('name', true) ?></span>
    </div>

    <div class="row">
        <label><?= $model->getLabel('detail') ?></label>
        <textarea type="text" name="detail"><?= $model->detail ?></textarea>
        <span class="error"><?= $model->hasError('detail', true) ?></span>
    </div>

    <div class="row">
        <input type="submit" value="Submit" />
    </div>

</form>