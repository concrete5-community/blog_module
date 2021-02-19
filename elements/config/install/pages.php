<?php

defined('C5_EXECUTE') or die('Access Denied.');

/** @var array $data */

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<concrete5-cif version="1.0">
    <?php
    // Should a Blog index page be added?
    if (isset($data['addBlogPage'])): ?>
        <pages>
            <page name="Blog" path="/blog" filename="" pagetype="blog_index"
                  template="<?php echo $data['biPageTemplate']; ?>" description="">
            </page>
        </pages>
    <?php
    endif;
    ?>
</concrete5-cif>
