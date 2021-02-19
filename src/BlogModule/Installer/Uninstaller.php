<?php

namespace A3020\BlogModule\Installer;

use Concrete\Core\Http\Request;
use Concrete\Core\Page\PageList;

class Uninstaller
{
    /**
     * @var \Concrete\Core\Http\Request
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function uninstall()
    {
        if ($this->request->request->get('deleteBlogIndexPages', true)) {
            $this->deleteBlogIndexPages();
        }

        if ($this->request->request->get('deleteBlogPostPages', true)) {
            $this->deleteBlogPostPages();
        }
    }

    private function deleteBlogIndexPages()
    {
        $pl = new PageList();
        $pl->filterByPageTypeHandle('blog_index');

        /** @var \Concrete\Core\Page\Page $page */
        foreach ($pl->getResults() as $page) {
            $page->delete();
        }
    }

    private function deleteBlogPostPages()
    {
        $pl = new PageList();
        $pl->filterByPageTypeHandle('blog_post');

        /** @var \Concrete\Core\Page\Page $page */
        foreach ($pl->getResults() as $page) {
            $page->delete();
        }
    }
}
