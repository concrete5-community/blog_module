<?php

defined('C5_EXECUTE') or die('Access Denied.');

/** @var array $data */

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<concrete5-cif version="1.0">
    <pagetypes>
        <pagetype name="Blog Index" handle="blog_index" package="blog_module" launch-in-composer="1">
            <pagetemplates type="custom" default="<?php echo $data['biPageTemplate']; ?>">
                <pagetemplate handle="<?php echo $data['biPageTemplate']; ?>"/>
            </pagetemplates>
            <target handle="all" form-factor=""/>
            <composer>
                <formlayout>
                    <set name="General" description="">
                        <control custom-template="" required="1" custom-label="" description=""
                                 type="core_page_property" handle="name"/>
                        <control custom-template="" custom-label="" description="" type="core_page_property"
                                 handle="url_slug"/>
                        <control custom-template="" custom-label="" description="" type="core_page_property"
                                 handle="publish_target"/>
                    </set>
                </formlayout>
                <output>
                    <pagetemplate handle="<?php echo $data['biPageTemplate']; ?>">
                        <page name="" path="" filename="" pagetype="blog_index"
                              template="<?php echo $data['biPageTemplate']; ?>" description="" package=""
                              root="true">
                            <?php
                            if (isset($data['biPageTitle'])): ?>
                                <area name="<?php echo $data['biTitleArea']; ?>">
                                    <blocks>
                                        <block type="page_title" name="" mc-block-id="273d375f">
                                            <data table="btPageTitle">
                                                <record>
                                                    <useCustomTitle><![CDATA[0]]></useCustomTitle>
                                                    <useFilterTitle><![CDATA[0]]></useFilterTitle>
                                                    <useFilterTopic><![CDATA[0]]></useFilterTopic>
                                                    <useFilterTag><![CDATA[0]]></useFilterTag>
                                                    <useFilterDate><![CDATA[0]]></useFilterDate>
                                                    <topicTextFormat><![CDATA[0]]></topicTextFormat>
                                                    <tagTextFormat><![CDATA[upperWord]]></tagTextFormat>
                                                    <dateTextFormat><![CDATA[0]]></dateTextFormat>
                                                    <filterDateFormat><![CDATA[F Y]]></filterDateFormat>
                                                    <titleText><![CDATA[[Page Title]]]></titleText>
                                                    <formatting><![CDATA[h1]]></formatting>
                                                </record>
                                            </data>
                                        </block>
                                    </blocks>
                                </area>
                                <?php
                            endif;
                            ?>

                            <?php
                            if (isset($data['biBlogList'])): ?>
                                <area name="<?php echo $data['biBlogListArea']; ?>">
                                    <blocks>
                                        <block type="page_list" name="" mc-block-id="5b6c95a5">
                                            <data table="btPageList">
                                                <record>
                                                    <num><![CDATA[10]]></num>
                                                    <orderBy><![CDATA[chrono_desc]]></orderBy>

                                                    <!-- The parent id needs to be updated when the page is created / published -->
                                                    <cParentID>0</cParentID>
                                                    <cThis><![CDATA[1]]></cThis>
                                                    <cThisParent><![CDATA[0]]></cThisParent>
                                                    <useButtonForLink><![CDATA[0]]></useButtonForLink>
                                                    <buttonLinkText><![CDATA[]]></buttonLinkText>
                                                    <pageListTitle><![CDATA[]]></pageListTitle>
                                                    <filterByRelated><![CDATA[0]]></filterByRelated>
                                                    <filterByCustomTopic><![CDATA[0]]></filterByCustomTopic>
                                                    <filterDateOption><![CDATA[]]></filterDateOption>
                                                    <filterDateDays><![CDATA[0]]></filterDateDays>
                                                    <filterDateStart><![CDATA[]]></filterDateStart>
                                                    <filterDateEnd><![CDATA[]]></filterDateEnd>
                                                    <relatedTopicAttributeKeyHandle>
                                                        <![CDATA[]]></relatedTopicAttributeKeyHandle>
                                                    <customTopicAttributeKeyHandle>
                                                        <![CDATA[]]></customTopicAttributeKeyHandle>
                                                    <customTopicTreeNodeID><![CDATA[0]]></customTopicTreeNodeID>
                                                    <includeName><![CDATA[1]]></includeName>
                                                    <includeDescription><![CDATA[1]]></includeDescription>
                                                    <includeDate><![CDATA[1]]></includeDate>
                                                    <includeAllDescendents><![CDATA[0]]></includeAllDescendents>
                                                    <paginate><![CDATA[1]]></paginate>
                                                    <displayAliases><![CDATA[0]]></displayAliases>
                                                    <ignorePermissions><![CDATA[0]]></ignorePermissions>
                                                    <enableExternalFiltering><![CDATA[1]]></enableExternalFiltering>
                                                    <ptID>{ccm:export:pagetype:blog_post}</ptID>

                                                    <?php
                                                    // If website is multilingual, feeds need to be manually created.
                                                    // If not, the 'blog' page feed is used.
                                                    if (isset($data['isMultilingual'])) {
                                                        echo '<pfID>0</pfID>';
                                                    } else {
                                                        echo '<pfID>{ccm:export:pagefeed:blog}</pfID>';
                                                    }
                                                    ?>

                                                    <truncateSummaries><![CDATA[0]]></truncateSummaries>
                                                    <displayFeaturedOnly><![CDATA[0]]></displayFeaturedOnly>
                                                    <noResultsMessage><![CDATA[No blog posts found.]]></noResultsMessage>
                                                    <displayThumbnail><![CDATA[1]]></displayThumbnail>
                                                    <truncateChars><![CDATA[0]]></truncateChars>
                                                </record>
                                            </data>
                                        </block>
                                    </blocks>
                                </area>
                                <?php
                            endif;
                            ?>

                            <?php
                            if (isset($data['biCategories'])): ?>
                                <area name="<?php echo $data['biCategoriesArea'] ?>">
                                    <blocks>
                                        <block type="topic_list" name="" mc-block-id="57b5d33e">
                                            <style>
                                                <backgroundColor/>
                                                <backgroundRepeat>no-repeat</backgroundRepeat>
                                                <backgroundSize>auto</backgroundSize>
                                                <backgroundPosition>0% 0%</backgroundPosition>
                                                <borderWidth/>
                                                <borderColor/>
                                                <borderStyle/>
                                                <borderRadius/>
                                                <baseFontSize/>
                                                <alignment/>
                                                <textColor/>
                                                <linkColor/>
                                                <paddingTop/>
                                                <paddingBottom/>
                                                <paddingLeft/>
                                                <paddingRight/>
                                                <marginTop/>
                                                <marginBottom/>
                                                <marginLeft/>
                                                <marginRight/>
                                                <rotate/>
                                                <boxShadowHorizontal/>
                                                <boxShadowVertical/>
                                                <boxShadowBlur/>
                                                <boxShadowSpread/>
                                                <boxShadowColor/>
                                                <customClass>block-sidebar-wrapped</customClass>
                                                <customID/>
                                                <customElementAttribute/>
                                                <hideOnExtraSmallDevice/>
                                                <hideOnSmallDevice/>
                                                <hideOnMediumDevice/>
                                                <hideOnLargeDevice/>
                                            </style>
                                            <data>
                                                <mode>S</mode>
                                                <title>Categories</title>
                                                <topicAttributeKeyHandle>blog_categories</topicAttributeKeyHandle>
                                                <tree>Blog</tree>
                                                <cParentID/>
                                            </data>
                                        </block>
                                    </blocks>
                                </area>
                                <?php
                            endif;
                            ?>
                        </page>
                    </pagetemplate>
                </output>
            </composer>
        </pagetype>
    </pagetypes>
</concrete5-cif>
