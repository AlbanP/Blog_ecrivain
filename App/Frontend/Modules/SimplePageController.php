<?php
namespace App\Frontend\Modules;

use \PiFram\BackController;
use \PiFram\HTTPRequest;
use \Entity\Comment;

class SimplePageController extends BackController {
  
  public function executeMentionsLegales(){
    $this->newPage('mentionsLegales');
    $this->page->addVar('title', 'Mentions légales');
  }
}