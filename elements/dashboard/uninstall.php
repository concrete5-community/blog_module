<?php

defined('C5_EXECUTE') or die('Access Denied.');

use Concrete\Core\Support\Facade\Application;

$app = Application::getFacadeApplication();
$form = $app->make('helper/form');
?>

<div class="form-group">
    <div class="checkbox">
        <label>
            <?php
            echo $form->checkbox('deleteBlogIndexPages', 1, true);
            ?>

            <?php echo t('Delete Blog Index pages'); ?>
        </label>
    </div>

    <div class="checkbox">
        <label>
            <?php
            echo $form->checkbox('deleteBlogPostPages', 1, true);
            ?>
            <?php echo t('Delete Blog Post pages'); ?>
        </label>
    </div>
</div>
