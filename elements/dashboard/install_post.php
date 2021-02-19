<?php

defined('C5_EXECUTE') or die('Access Denied.');

use Concrete\Core\Page\Page;
use Concrete\Core\Support\Facade\Package;

/** @var \Concrete\Core\Entity\Package $package */
$package = Package::getByHandle('blog_module');
?>
<p><?php echo t('Congratulations, the add-on has been installed!'); ?></p>
<br>

<p>
    <?php echo t('Composer can be used to add new blog posts.'); ?>
</p>
<br>

<?php
$blogPage = Page::getByPath('/blog');
if (is_object($blogPage)) {
    echo '<a class="btn btn-primary" href="' . $blogPage->getCollectionLink() . '">' . t('Visit Blog') . '</a>';
}
