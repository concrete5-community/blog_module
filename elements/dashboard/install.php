<?php

defined('C5_EXECUTE') or die('Access Denied.');

use Concrete\Core\Support\Facade\Application;
use A3020\BlogModule\Installer\Service;
use Concrete\Core\Support\Facade\Url;

$app = Application::getFacadeApplication();
$form = $app->make('helper/form');

// Container doesn't load classes yet
require_once __DIR__ .'/../../src/BlogModule/Installer/Service.php';

/** @var Service $service **/
$service = $app->make(Service::class);

$areaTooltipHelp = t('Select in which area you want the block to be installed.') . ' ' .
    t('Is an area missing from the template you selected? Please browse to a page first that has this page template to make sure the Areas are available in the database.') . ' '.
    t('Unfortunately there is not an easy way to grab all available areas from the page template files.');
?>

<?php
if ($files = $service->getNewPageTemplates()) {
    ?>
    <div class="alert alert-warning">
        <?php
        echo t('It seems your theme has uninstalled Page Templates. Would you like to inspect / install them first?');
        ?>

        <ul>
            <?php
            foreach ($files as $file) {
                echo '<li>' . e($file->getHandle()) . '</li>';
            }
            ?>
        </ul>
        <br>

        <a class="btn btn-sm btn-primary" href="<?php echo Url::to('/dashboard/pages/themes/inspect/' . $service->getThemeId()) ?>">
            <?php echo t('Inspect theme'); ?>
        </a>
    </div>
    <?php
}

if ($components = $service->getFormerBlogComponents()) {
    ?>
    <div class="alert alert-warning">
        <?php
        echo t('It seems you have blog components installed already. Please remove the following component(s) first to prevent collisions:');
        ?>

        <ul>
            <?php
            foreach ($components as $component) {
                echo '<li>' . $component['type'] . ' - ' . $component['name'] . '</li>';
            }
            ?>
        </ul>
        <br>
    </div>
    <?php
}
?>

<fieldset>
    <legend><?php echo t('General'); ?></legend>

    <div class="form-group">
        <div class="checkbox">
            <label>
                <?php
                echo $form->checkbox('isMultilingual', 1, $service->isMultilingual());
                ?>

                <?php echo t('I have a multilingual website or plan to have one'); ?>
            </label>
        </div>

        <div class="checkbox">
            <label>
                <?php
                echo $form->checkbox('addBlogPage', 1, true);
                ?>

                <?php echo t('Add a Blog index page'); ?>
            </label>
        </div>
    </div>
</fieldset>

<fieldset style="background: rgba(6,255,136,0.05)">
    <h3><?php echo t('Blog Index - Defaults'); ?></h3>
    <br>

    <div class="form-group">
        <label class="control-label launch-tooltip"
               title="<?php echo t('Go to the %s page to add or inspect page templates.', t('Page Templates')) ?>">
            <?php
            echo t('Which Page Template would you like to use?');
            ?>
        </label>

        <?php
        echo $form->select('biPageTemplate', $service->getPageTemplateOptions(), 'right_sidebar');
        ?>
    </div>

    <hr>

    <div class="well">
        <div class="form-group">
            <div class="checkbox">
                <label class="control-label launch-tooltip"
                       title="<?php echo t("Add a 'Page Title' block above the page list.") ?>">
                    <?php
                    echo $form->checkbox('biPageTitle', 1, true);
                    ?>

                    <?php
                    echo t("Add title block");
                    ?>
                </label>
            </div>
        </div>

        <div class="form-group bi-title-area">
            <label class="control-label launch-tooltip"
                   title="<?php echo $areaTooltipHelp ?>"
                   for="biTitleArea">
                <?php
                echo $form->label('biTitleArea', t("Add to"));
                ?>
            </label>

            <?php
            $hasPageHeaderArea = in_array('Page Header', $service->getAreaOptions());
            echo $form->select('biTitleArea', $service->getAreaOptions(), $hasPageHeaderArea ? 'Page Header' : 'Main');
            ?>
        </div>
    </div>

    <div class="well">
        <div class="form-group">
            <div class="checkbox">
                <label class="control-label launch-tooltip"
                   title="<?php echo t("Add a 'Page List' block that shows blog posts.") ?>">
                    <?php
                    echo $form->checkbox('biBlogList', 1, true);
                    ?>

                    <?php
                    echo t("Add blog list block");
                    ?>
                </label>
            </div>
        </div>

        <div class="form-group bi-blog-list-area">
            <label class="control-label launch-tooltip"
                   title="<?php echo $areaTooltipHelp ?>"
                   for="biBlogListArea">
                <?php
                echo $form->label('biBlogListArea', t("Add to"));
                ?>
            </label>

            <?php
            echo $form->select('biBlogListArea', $service->getAreaOptions(), 'Main');
            ?>
        </div>
    </div>

    <div class="well">
        <div class="form-group">
            <div class="checkbox">
                <label class="control-label launch-tooltip"
                   title="<?php echo t("Add a 'Topics' block that shows the blog categories. When a category is clicked, only posts from that category are shown.") ?>">
                    <?php
                    echo $form->checkbox('biCategories', 1, true);
                    ?>

                    <?php
                    echo t("Add categories block");
                    ?>
                </label>
            </div>
        </div>

        <div class="form-group bi-categories">
            <label class="control-label launch-tooltip"
                   title="<?php echo t("Each category will be added to the 'Blog' topic tree.") ?>">
                <?php
                echo t('Add the following blog categories');
                ?>
            </label>

            <?php
            echo $form->textarea('categories', null, [
                'placeholder' => t('One category per line'),
            ]);
            ?>
        </div>

        <div class="form-group bi-categories-area">
            <label class="control-label launch-tooltip"
                   title="<?php echo $areaTooltipHelp ?>"
                   for="biCategoriesArea">
                <?php
                echo $form->label('biCategoriesArea', t("Add to"));
                ?>
            </label>

            <?php
            $hasSidebarArea = in_array('Sidebar', $service->getAreaOptions());
            echo $form->select('biCategoriesArea', $service->getAreaOptions(), $hasSidebarArea ? 'Sidebar' : 'Main');
            ?>
        </div>
    </div>
</fieldset>

<fieldset style="background: rgba(255,153,51,0.05)">
    <h3><?php echo t('Blog Post - Defaults'); ?></h3>
    <br>

    <div class="form-group">
        <label class="control-label launch-tooltip"
               title="<?php echo t('Go to the %s page to add or inspect page templates.', t('Page Templates')) ?>">
            <?php
            echo t('Which Page Template would you like to use?');
            ?>
        </label>

        <?php
        echo $form->select('bpPageTemplate', $service->getPageTemplateOptions(), 'right_sidebar');
        ?>
    </div>

    <hr>

    <div class="well">
        <div class="form-group">
            <div class="checkbox">
                <label class="control-label launch-tooltip"
                   title="<?php echo t('Add a block to show the name of the blog post.') ?>">
                    <?php
                    echo $form->checkbox('bpPageTitle', 1, true);
                    ?>

                    <?php
                    echo t('Add title block');
                    ?>
                </label>
            </div>
        </div>

        <div class="form-group bp-title-area">
            <label class="control-label launch-tooltip"
                   title="<?php echo $areaTooltipHelp ?>"
                   for="bpTitleArea">
                <?php
                echo $form->label('bpTitleArea', t("Add to"));
                ?>
            </label>

            <?php
            $hasPageHeaderArea = in_array('Page Header', $service->getAreaOptions());
            echo $form->select('bpTitleArea', $service->getAreaOptions(), $hasPageHeaderArea ? 'Page Header' : 'Main');
            ?>
        </div>
    </div>

    <div class="well">
        <div class="form-group">
            <div class="checkbox">
                <label class="control-label launch-tooltip"
                   title="<?php echo t('Add a block to show the description of the blog post.') ?>">
                    <?php
                    echo $form->checkbox('bpTextIntro', 1, true);
                    ?>

                    <?php
                    echo t("Add text intro block");
                    ?>
                </label>
            </div>

            <div class="checkbox">
                <label class="control-label launch-tooltip"
                       title="<?php echo t('Add a content block to show the blog post. This block is mandatory.') ?>">
                    <?php
                    echo $form->checkbox('bpBlogContent', 1, true, [
                        'readonly' => 'readonly',
                        'disabled' => 'disabled',
                    ]);
                    ?>

                    <?php
                    echo t('Add content block');
                    ?>
                </label>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label launch-tooltip"
                   title="<?php echo $areaTooltipHelp ?>"
                   for="bpContentArea">
                <?php
                echo $form->label('bpContentArea', t("Add to"));
                ?>
            </label>

            <?php
            echo $form->select('bpContentArea', $service->getAreaOptions(), 'Main');
            ?>
        </div>
    </div>

    <div class="well">
        <div class="form-group">
            <div class="checkbox">
                <label class="control-label launch-tooltip"
                       title="<?php echo t("Add a 'Tags' block. When clicked on a tag, only blog posts with that tag are shown.") ?>">
                    <?php
                    echo $form->checkbox('bpTags', 1, true);
                    ?>

                    <?php
                    echo t('Add tags block');
                    ?>
                </label>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label launch-tooltip"
                   title="<?php echo $areaTooltipHelp ?>"
                   for="bpTagsArea">
                <?php
                echo $form->label('bpTagsArea', t('Add to'));
                ?>
            </label>

            <?php
            echo $form->select('bpTagsArea', $service->getAreaOptions(), 'Main');
            ?>
        </div>
    </div>

    <div class="well">
        <div class="form-group">
            <div class="checkbox">
                <label class="control-label launch-tooltip"
                       title="<?php echo t("Add a 'Next & Previous' navigation block to automatically link to other blog posts.") ?>">
                    <?php
                    echo $form->checkbox('bpNavigation', 1, true);
                    ?>

                    <?php
                    echo t('Add next/previous block');
                    ?>
                </label>
            </div>
        </div>

        <div class="form-group bp-navigation-area">
            <label class="control-label launch-tooltip"
                   title="<?php echo $areaTooltipHelp ?>"
                   for="bpNavigationArea">
                <?php
                echo $form->label('bpNavigationArea', t("Add to"));
                ?>
            </label>

            <?php
            $hasSidebarArea = in_array('Sidebar', $service->getAreaOptions());
            echo $form->select('bpNavigationArea', $service->getAreaOptions(), $hasSidebarArea ? 'Sidebar' : 'Main');
            ?>
        </div>
    </div>

    <div class="well">
        <div class="form-group">
            <div class="checkbox">
                <label class="control-label launch-tooltip"
                       title="<?php echo t("Add a '%s' block to easily share a blog post to a social network.", t('Share This Page')) ?>">
                    <?php
                    echo $form->checkbox('bpShare', 1, true);
                    ?>

                    <?php
                    echo t("Add share page block");
                    ?>
                </label>
            </div>
        </div>

        <div class="form-group bp-share-area">
            <label class="control-label launch-tooltip"
                   title="<?php echo $areaTooltipHelp ?>"
                   for="bpShareArea">
                <?php
                echo $form->label('bpShareArea', t('Add to'));
                ?>
            </label>

            <?php
            $hasSidebarArea = in_array('Sidebar', $service->getAreaOptions());
            echo $form->select('bpShareArea', $service->getAreaOptions(), $hasSidebarArea ? 'Sidebar' : 'Main');
            ?>
        </div>
    </div>

    <div class="well">
        <div class="form-group">
            <div class="checkbox">
                <label class="control-label launch-tooltip"
                       title="<?php echo t('The conversation blocks allows visitors to leave a comment.') ?>">
                    <?php
                    echo $form->checkbox('bpConversation', 1, true);
                    ?>

                    <?php
                    echo t('Add conversation block');
                    ?>
                </label>
            </div>
        </div>

        <div class="form-group bp-conversation-area">
            <label class="control-label launch-tooltip"
                   title="<?php echo $areaTooltipHelp ?>"
                   for="bpConversationArea">
                <?php
                echo $form->label('bpConversationArea', t("Add to"));
                ?>
            </label>

            <?php
            $hasFooterArea = in_array('Page Footer', $service->getAreaOptions());
            echo $form->select('bpConversationArea', $service->getAreaOptions(), $hasFooterArea ? 'Page Footer' : 'Main');
            ?>
        </div>
    </div>
</fieldset>

<script>
$(document).ready(function() {
    // Blog Post
    $('#bpPageTitle').change(function() {
       $('.bp-title-area').toggle($(this).is(':checked'));
    });

    $('#bpNavigation').change(function() {
        $('.bp-navigation-area').toggle($(this).is(':checked'));
    });

    $('#bpShare').change(function() {
        $('.bp-share-area').toggle($(this).is(':checked'));
    });

    $('#bpConversation').change(function() {
        $('.bp-conversation-area').toggle($(this).is(':checked'));
    });

    // Blog Index
    $('#biPageTitle').change(function() {
        $('.bi-title-area').toggle($(this).is(':checked'));
    });

    $('#biBlogList').change(function() {
        $('.bi-blog-list-area').toggle($(this).is(':checked'));
    });

    $('#biCategories').change(function() {
        $('.bi-categories, .bi-categories-area').toggle($(this).is(':checked'));
    });
});
</script>
