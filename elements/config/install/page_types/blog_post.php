<?php

defined('C5_EXECUTE') or die('Access Denied.');

/** @var array $data */

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<concrete5-cif version="1.0">
    <pagetypes>
        <pagetype name="Blog Post" handle="blog_post" package="blog_module" launch-in-composer="1"
                  is-frequently-added="1">
            <pagetemplates type="custom" default="<?php echo $data['bpPageTemplate']; ?>">
                <pagetemplate handle="<?php echo $data['bpPageTemplate']; ?>"/>
            </pagetemplates>
            <target handle="page_type" package="blog_module" pagetype="blog_index" form-factor=""/>
            <composer>
                <formlayout>
                    <set name="General" description="">
                        <control custom-template="" required="1" custom-label="" description=""
                                 type="core_page_property" handle="name"/>
                        <control custom-template="" custom-label="" description="" type="core_page_property"
                                 handle="url_slug"/>
                        <control custom-template="" custom-label="Date/Time" description="" type="core_page_property"
                                 handle="date_time"/>
                        <control custom-template="" custom-label="Location" description="" type="core_page_property"
                                 handle="publish_target"/>
                    </set>
                    <set name="Organizing" description="">
                        <control custom-template="" custom-label="Categories" description="" type="collection_attribute"
                                 handle="blog_categories"/>
                        <control custom-template="" custom-label="" description="" type="collection_attribute"
                                 handle="tags"/>
                    </set>
                    <set name="Content" description="">
                        <control custom-template="" custom-label="" description="" type="core_page_property"
                                 handle="description"/>
                        <control custom-template="" custom-label="" description="" type="collection_attribute"
                                 handle="thumbnail"/>
                        <control custom-template="" custom-label="" description="" output-control-id="470d4ba6"
                                 type="block" handle="content"/>
                    </set>
                </formlayout>
                <output>
                    <pagetemplate handle="<?php echo $data['bpPageTemplate']; ?>">
                        <page name="" path="" filename="" pagetype="blog_post"
                              template="<?php echo $data['bpPageTemplate']; ?>" description="" package="blog_module"
                              root="true">
                            <area name="<?php echo $data['bpTitleArea']; ?>">
                                <blocks>
                                    <?php
                                    if (isset($data['bpPageTitle'])): ?>
                                        <block type="page_title" name="" custom-template="byline.php"
                                               mc-block-id="c3f2f0c0">
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
                                    <?php
                                    endif;
                                    ?>
                                </blocks>
                            </area>

                            <area name="<?php echo $data['bpContentArea']; ?>">
                                <blocks>
                                    <?php
                                    if (isset($data['bpTextIntro'])): ?>
                                        <block type="page_attribute_display" name="" mc-block-id="89de67d0">
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
                                                <marginBottom>20px</marginBottom>
                                                <marginLeft/>
                                                <marginRight/>
                                                <rotate/>
                                                <boxShadowHorizontal/>
                                                <boxShadowVertical/>
                                                <boxShadowBlur/>
                                                <boxShadowSpread/>
                                                <boxShadowColor/>
                                                <customClass/>
                                                <customID/>
                                                <customElementAttribute/>
                                                <hideOnExtraSmallDevice/>
                                                <hideOnSmallDevice/>
                                                <hideOnMediumDevice/>
                                                <hideOnLargeDevice/>
                                            </style>
                                            <data table="btPageAttributeDisplay">
                                                <record>
                                                    <attributeHandle>rpv_pageDescription</attributeHandle>
                                                    <attributeTitleText/>
                                                    <displayTag>b</displayTag>
                                                    <dateFormat>n/j/y, g:i A</dateFormat>
                                                    <thumbnailHeight>250</thumbnailHeight>
                                                    <thumbnailWidth>250</thumbnailWidth>
                                                    <delimiter>break</delimiter>
                                                </record>
                                            </data>
                                        </block>
                                    <?php
                                    endif;
                                    ?>
                                    <block type="core_page_type_composer_control_output" name="" mc-block-id="885895d3">
                                        <control output-control-id="470d4ba6"/>
                                    </block>
                                </blocks>
                            </area>

                            <?php
                            if (isset($data['bpTags'])): ?>
                                <area name="<?php echo $data['bpTagsArea']; ?>">
                                    <blocks>
                                        <block type="tags" name="" mc-block-id="8e75297f">
                                            <data table="btTags">
                                                <record>
                                                    <title><![CDATA[Tags]]></title>

                                                    <!--
                                                    We can't use {ccm:export:page:/blog} because the site may be multilingual and /blog may not yet exist.
                                                    We'll have to use an on_page_add listener to fix this.
                                                    -->
                                                    <targetCID>0</targetCID>
                                                    <displayMode><![CDATA[page]]></displayMode>
                                                    <cloudCount><![CDATA[0]]></cloudCount>
                                                </record>
                                            </data>
                                        </block>
                                    </blocks>
                                </area>
                            <?php
                            endif;
                            ?>

                            <area name="<?php echo $data['bpNavigationArea']; ?>">
                                <blocks>
                                    <?php
                                    // If no results are shown, it's probably because two pages have been added in the same minute.
                                    // It'll cause this query to return 'false': select Pages.cID from Pages inner join CollectionVersions cv on Pages.cID = cv.cID where cvIsApproved = 1 and cvDatePublic > '2018-07-05 05:36:00' and cParentID = 322 order by cvDatePublic asc
                                    if (isset($data['bpNavigation'])): ?>
                                        <block type="next_previous" name="" mc-block-id="90038c9c">
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
                                            <data table="btNextPrevious">
                                                <record>
                                                    <nextLabel><![CDATA[Next Post]]></nextLabel>
                                                    <previousLabel><![CDATA[Previous Post]]></previousLabel>
                                                    <parentLabel><![CDATA[]]></parentLabel>
                                                    <loopSequence><![CDATA[0]]></loopSequence>
                                                    <orderBy><![CDATA[chrono_desc]]></orderBy>
                                                </record>
                                            </data>
                                        </block>
                                    <?php
                                    endif;
                                    ?>
                                </blocks>
                            </area>

                            <area name="<?php echo $data['bpShareArea']; ?>">
                                <blocks>
                                    <?php
                                    if (isset($data['bpShare'])): ?>
                                        <block type="share_this_page" name="" mc-block-id="77c3a9d5">
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
                                                <service>facebook</service>
                                                <service>twitter</service>
                                                <service>linkedin</service>
                                                <service>email</service>
                                            </data>
                                        </block>
                                    <?php
                                    endif;
                                    ?>
                                </blocks>
                            </area>

                            <?php
                            if (isset($data['bpConversation'])): ?>
                                <area name="<?php echo $data['bpConversationArea']; ?>">
                                    <blocks>
                                        <block type="horizontal_rule" name="" mc-block-id="2f218aa5"/>
                                        <block type="core_conversation" name="" mc-block-id="47b3af50">
                                            <data table="btCoreConversation">
                                                <record>
                                                    <cnvID><![CDATA[1]]></cnvID>
                                                    <enablePosting><![CDATA[1]]></enablePosting>
                                                    <paginate><![CDATA[1]]></paginate>
                                                    <itemsPerPage><![CDATA[50]]></itemsPerPage>
                                                    <displayMode><![CDATA[threaded]]></displayMode>
                                                    <orderBy><![CDATA[date_asc]]></orderBy>
                                                    <enableOrdering><![CDATA[0]]></enableOrdering>
                                                    <enableCommentRating><![CDATA[1]]></enableCommentRating>
                                                    <enableTopCommentReviews><![CDATA[0]]></enableTopCommentReviews>
                                                    <displaySocialLinks><![CDATA[0]]></displaySocialLinks>
                                                    <reviewAggregateAttributeKey><![CDATA[0]]></reviewAggregateAttributeKey>
                                                    <displayPostingForm><![CDATA[top]]></displayPostingForm>
                                                    <addMessageLabel><![CDATA[Add Message]]></addMessageLabel>
                                                    <dateFormat><![CDATA[default]]></dateFormat>
                                                    <customDateFormat><![CDATA[]]></customDateFormat>
                                                </record>
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
