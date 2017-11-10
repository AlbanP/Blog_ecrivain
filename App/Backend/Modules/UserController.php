<?php
namespace App\Backend\Modules;

use \PiFram\BackController;
use \PiFram\HTTPRequest;
use \Entity\User;

class UserController extends BackController{
  public function executeIndex(HTTPRequest $request){
    $this->newPage('index');
    $this->page->setLayout('simpleLayout.php');
    $this->page->addVar('title', 'Connexion');
    $this->page->addVar('script', '<script src="/js/modal_tooltip.js"></script>');
    $name = $request->postData('name');
    $pass = $request->postData('pass');
    if (!empty($name) && !empty($pass)) {
      $user = $this->managers->getManagerOf('User')->userUnique($name); 
      if (isset($user)) {
        $pass_hache = sha1($pass);
        if ($pass_hache == $user->pass()){
          $this->app->session()->setAuthenticated(true);
          $this->app->session()->setAttribute('name',$name);
          $this->app->httpResponse()->redirect('.');
        }
      }
      $this->app->session()->setFlash('L\'identifiant ou le mot de passe est incorrect.');
    }
  }
  
  public function executeDeconnexion(){
    $this->app->session()->quit();
    $this->app->httpResponse()->redirect('/');
  }
  
  public function executeManageUser(){
    $this->newPage('manageUser');
    $this->page->addVar('title', 'Utilisateurs');
    $this->page->addVar('script', '<script src="/js/modalUser_tooltip.js"></script>');
    $this->page->addVar('listUser', $this->managers->getManagerOf('User')->getListOf());
  }
  
  public function executeAdd(HTTPRequest $request) {
    if ($request->postExists('name') && $request->postExists('pass')) {
      $user = $this->managers->getManagerOf('User')->userUnique($request->postData('name'));
      if ($user != null){
        $this->app->session()->setFlash('Ajout non enregistré car le <strong>NOM</strong> a déjà été affecté. Veuillez choisir un autre nom.' );
        $this->app->httpResponse()->redirect('/admin/user-manage.html');
      } else {
        $this->processForm($request);
      }
    }
  }
  
  /*
  public function executeUpdate(HTTPRequest $request){
    if ($request->postExists('id') && $request->postExists('pass')) {
      $valid = $this->processCheckPass($request);
      if ($valid) { 
        echo json_encode($this->managers->getManagerOf('User')->userById($request->postData('id')));
        return;
      } 
      echo 'false';
      return; 
    }

    return null;
  }
  */
  public function executeDelete(HTTPRequest $request){
    if ($request->postExists('id') && $request->postExists('pass')) {
      $valid = $this->processCheckPass($request);
      if ($valid) {
        $this->managers->getManagerOf('User')->delete($request->postData('id'));
        echo 'true';
        return; 
      }
      echo 'false';
      return; 
    }

    return null;
  }
  
  public function processForm(HTTPRequest $request){
    $passHache = sha1($request->postData('pass'));
    $user = new User([
      'name' => $request->postData('name'),
      'email' => $request->postData('email'),
      'pass' => $passHache,
      'role' => 'admin'
    ]);
    if ($request->postExists('id')){
      $user->setId($request->getData('id'));
    }
    if ($user->isValid()){
      $this->managers->getManagerOf('User')->save($user);
      $this->app->httpResponse()->redirect('/admin/user-manage.html');
    } else {
      
      return $user->erreurs();
    }
  }
  
  public function processCheckPass($request){
    $passHache = sha1($request->postData('pass'));
    $userPassHache = $this->managers->getManagerOf('User')->userPass($request->postData('id'));
    if ($userPassHache != $passHache){ 
      
      return false;
    }

    return true;
  }
}