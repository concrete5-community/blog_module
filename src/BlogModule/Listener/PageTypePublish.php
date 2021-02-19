<?php

namespace A3020\BlogModule\Listener;

use Concrete\Core\Database\Connection\Connection;
use Concrete\Core\Logging\Logger;
use Concrete\Core\Page\Page;
use Concrete\Core\Page\Type\Event;
use Exception;

class PageTypePublish
{
    /**
     * @var Connection
     */
    private $db;

    /**
     * @var Logger
     */
    private $logger;

    public function __construct(Connection $db, Logger $logger)
    {
        $this->db = $db;
        $this->logger = $logger;
    }

    /**
     * @param Event $event
     */
    public function handle(Event $event)
    {
        /** @var \Concrete\Core\Page\Type\Type $pageType */
        $pageType = $event->getPageTypeObject();

        // Only continue if the page is a blog post
        if (!$pageType->getPageTypeHandle() === 'blog_post') {
            return;
        }

        try {
            $this->fixTagsBlock(
                $event->getPageObject()
            );
        } catch (Exception $e) {
            $this->logger->addError($e->getMessage());
        }
    }

    /**
     * The tags should link to a parent page
     *
     * Because the website might be multilingual
     * the parent id can't be set in page types.
     *
     * @param \Concrete\Core\Page\Page $page
     *
     * @throws \Doctrine\DBAL\DBALException
     */
    private function fixTagsBlock(Page $page)
    {
        // Get *all* blocks on the page (at this point we don't know the area name)
        // getBlocks is part of the Collection class
        $blocks = $page->getBlocks();

        /** @var \Concrete\Core\Block\Block $block */
        foreach ($blocks as $block) {
            if ($block->getBlockTypeHandle() !== 'tags') {
                continue;
            }

            // We 'detach' it from the page type defaults
            // by duplicating it and then removing the aliased block.
            $newBlock = $block->duplicate($page);
            $block->deleteBlock();

            // Make sure the block record is refreshed, otherwise the Edit dialog will show outdated info.
            // There is no API method for this yet. See https://github.com/concrete5/concrete5/pull/6851.
            $this->db->executeQuery('UPDATE Blocks SET btCachedBlockRecord = NULL WHERE bID = ?', [
                $newBlock->getBlockID(),
            ]);

            // Make sure the tags blocks points to the parent page.
            // E.g. /de/blog/test-blog should point to /de/blog
            $this->db
                ->executeQuery('UPDATE btTags SET targetCID = ? WHERE bID = ?', [
                    $page->getCollectionParentID(),
                    $newBlock->getBlockID(),
                ]);
        }
    }
}
