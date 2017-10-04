<?php
namespace App\Backend\Modules;

use \PiFram\BackController;
use \PiFram\HTTPRequest;
use \Entity\User;

class UserController extends BackController{
  public function executeIndex(HTTPRequest $request){
    $this->newPage('index');
    $this->page->addVar('title', 'Connexion');
    if ($request->postExists('name') && $request->postExists('pass')){
      $name = $request->postData('name');
      $pass_hache = sha1($request->postData('pass'));
      $user = $this->managers->getManagerOf('User')->userUnique($name); 
      if ($pass_hache == $user->pass()){
        $this->app->session()->setAuthenticated(true);
        $this->app->httpResponse()->redirect('.');
      } else {
        $this->app->session()->setFlash('L\'identifiant ou le mot de passe est incorrect.');
      }
    }
  }
  public function executeDeconnexion(HTTPRequest $request){
    $this->app->session()->quit();
    $this->app->httpResponse()->redirect('/');
  }
  public function executeManageUser(HTTPRequest $request){
    $this->newPage('manageUser');
    $user = $this->managers->getManagerOf('User');
    $this->page->addVar('title', 'Gestion des utilisateurs');
    $this->page->addVar('numberUser',$user->countUser());
    $this->page->addVar('listUser',$user->getListOf());
  }
  public function executeAdd(HTTPRequest $request){
    if ($request->postExists('name') && $request->postExists('pass') && $request->postExists('email')){ $this->processForm($request);};
  }
  public function executeUpdate(HTTPRequest $request){
      $this->processCheckPass($request);
      exit ("<p>Pas encore fonctionel. Bientôt !</p>");
      //$this->managers->getManagerOf('User')->userUnique($request->postData('id'));
      //$this->managers->getManagerOf('User')->modify($request->postData('id')); 
  }
  public function executeDelete(HTTPRequest $request){
      $this->processCheckPass($request);
      $this->managers->getManagerOf('User')->delete($request->postData('id'));      
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
    } else {
      return $user->erreurs();
    }
    //echo null;
  }
  public function processCheckPass($request){
    if (empty($request->postData('pass'))) { exit("<p>Vous devez saisir le mot de passe !</p>");}
    $passHache = sha1($request->postData('pass'));
    $userPassHache = $this->managers->getManagerOf('User')->userPass($request->postData('id'));
    if ($userPassHache != $passHache){ exit("<p>Mauvais mot de passe</p>");}
  }
}