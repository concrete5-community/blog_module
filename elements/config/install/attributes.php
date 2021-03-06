<?php

defined('C5_EXECUTE') or die('Access Denied.');

/** @var array $data */

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<concrete5-cif version="1.0">
    <attributekeys>
        <!-- default attribute, so don't delete it when pkg is deinstalled -->
        <attributekey handle="thumbnail" name="Thumbnail" package="" searchable="1" indexed="1"
                      type="image_file"
                      category="collection">
            <type mode="file_manager"/>
        </attributekey>

        <!-- default attribute, so don't delete it when pkg is deinstalled -->
        <attributekey handle="tags" name="Tags" package="" searchable="1" indexed="1" type="select"
                      category="collection">
            <type allow-multiple-values="1" display-order="display_asc" display-multiple-values=""
                  allow-other-values="1" hide-none-option="">
                <options/>
            </type>
        </attributekey>

        <!-- 'default' attribute, so don't delete it when pkg is deinstalled -->
        <attributekey handle="exclude_subpages_from_nav" name="Exclude Sub-Pages From Nav" package="" searchable="1" indexed="1" type="boolean" category="collection">
            <type checked="0"/>
        </attributekey>

        <!-- custom attribute, delete when pkg is deinstalled -->
        <attributekey handle="blog_categories" name="Blog - Categories" package="blog_module" searchable="1" indexed="1"
                      type="topics" category="collection">
            <tree name="Blog" path="/" allow-multiple-values="1"/>
        </attributekey>
    </attributekeys>
</concrete5-cif>
