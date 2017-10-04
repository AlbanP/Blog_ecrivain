<?php
namespace App\Backend;

use \PiFram\Application;

class BackendApplication extends Application{
  public function __construct(){
    parent::__construct();
    $this->name = 'Backend';
  }
  public function run(){
    if ($this->session->isAuthenticated()){
      $controller = $this->getController();
    } else {
      $controller = new Modules\UserController($this, 'Connexion', 'index');
    }
    $controller->execute();
    if (!empty($controller->page())){
      $this->httpResponse->setPage($controller->page());
      $this->httpResponse->send();
    } else {
      exit;
    }
  }
}