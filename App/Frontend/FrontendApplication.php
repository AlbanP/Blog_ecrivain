<?php
namespace App\Frontend;
 
use \PiFram\Application;
 
class FrontendApplication extends Application
{
    public function __construct()
    {
        parent::__construct();
        $this->name = 'Frontend';
    }
    
    public function run()
    {
        $controller = $this->getController();
        $controller->execute();
        if (!empty($controller->page())) {
            $this->httpResponse->setPage($controller->page());
            $this->httpResponse->send();
        } else {
            exit;
        }
    }
}
