<?php
namespace Model;

use \PiFram\Manager;

abstract class PostManager extends Manager{
  abstract public function getList($posted);
  abstract public function getUnique($id);
}