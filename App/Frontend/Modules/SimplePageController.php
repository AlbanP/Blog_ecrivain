<?php
namespace App\Frontend\Modules;

use \PiFram\BackController;
use \PiFram\HTTPRequest;
use \Entity\Comment;

class SimplePageController extends BackController
{
    // Page for "Mentions legales"
    public function executeMentionsLegales()
    {
        $this->newPage('mentionsLegales');
        $this->page->addVar('title', 'Mentions légales');
    }
}
