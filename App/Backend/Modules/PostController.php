<?php
namespace App\Backend\Modules;

use \PiFram\BackController;
use \PiFram\HTTPRequest;
use \Entity\Post;

class PostController extends BackController
{
    // Dashboard present list of posts and comments reported
    public function executeDashboard()
    {
        $this->newPage('dashboard');
        $this->page->addVar('title', 'Tableau de bord');
        $this->page->addVar('script', '<script src="/js/manageComments.js"></script><script src="/js/modal_tooltip.js"></script>');
        $managerPost = $this->managers->getManagerOf('Post');
        $managerComment = $this->managers->getManagerOf('Comment');
        $this->page->addVar('listPost', $managerPost->getList('all', 'dateDesc'));
        $this->page->addVar('numberPost', $managerPost->countPost('posted'));
        $this->page->addVar('numberCommentAll', $managerComment->countComment('all', 'all'));
        $this->page->addVar('numberCommentReport', $managerComment->countComment('all', 'report'));
        $this->page->addVar('commentReported', $managerComment->getReported());
    }
    // Add post
    public function executeAdd(HTTPRequest $request)
    {
        if ($request->postExists('title')) {
            $this->processForm($request);
        } else {
            $this->newPage('insert');
            $this->page->addVar('script', '<script src="/js/quitSavePost.js"></script>');
            $this->page->addVar('title', "Ajout d'un chapitre");
        }
    }
    // Update post
    public function executeUpdate(HTTPRequest $request)
    {
        if ($request->postExists('title')) {
            $this->processForm($request);
        } else {
            $this->newPage('insert');
            $this->page->addVar('title', "Modification d'un chapitre");
            $this->page->addVar('script', '<script src="/js/quitSavePost.js"></script>');
            $this->page->addVar('post', $this->managers->getManagerOf('Post')->getUnique($request->getData('id')));
        }
    }
    // Delete post
    public function executeDelete(HTTPRequest $request)
    {
        if ($request->getExists('id')) {
            $this->managers->getManagerOf('Post')->delete($request->getData('id'));
        }
            $this->app->httpResponse()->redirect('.');
    }
    // Toggle posted or drafted post
    public function executePosted(HTTPRequest $request)
    {
        if ($request->getExists('id')) {
            $post = $this->managers->getManagerOf('Post')->getUnique($request->getData('id'));
            $orderPosted = $post['orderPosted'];
            if (is_null($orderPosted)) {
                $maxOrder = $this->managers->getManagerOf('Post')->maxOrderPosted() ;
                $orderPosted = 1 + $maxOrder;
            } else {
                $orderPosted = null;
            }
            $this->managers->getManagerOf('Post')->posted($request->getData('id'), $orderPosted);
        }

        $this->app->httpResponse()->redirect('.');
    }
    // List and order posts posted and update the order
    public function executePostOrder(HTTPRequest $request)
    {
        $this->newPage('postOrder');
        $this->page->addVar('title', 'Classement');
        $this->page->addVar('script', '<script src="/js/listOrder.js"></script>');
        $managerPost = $this->managers->getManagerOf('Post');
        $this->page->addVar('numberPost', $managerPost->countPost('posted'));
        $this->page->addVar('listPost', $managerPost->getList('posted', 'orderPost'));

        if ($request->postExists('newListOrder')) {
            $numberPosted = $this->managers->getManagerOf('Post')->countPost('posted');
            for ($newOrder = 1; $newOrder <= $numberPosted; $newOrder++) {
                $id = $request->postData('Order' . $newOrder) ;
                $this->managers->getManagerOf('Post')->posted((int)$id, (int)$newOrder);
            }
            $this->app->session()->setFlash('L\'ordre des chapitre a été modifié !');
            $this->app->httpResponse()->redirect('/admin/post-postOrder.html');
        }
    }
    // Save or update post
    public function processForm(HTTPRequest $request)
    {
        $orderPosted = $request->postData('typeSave') ;
        if ($orderPosted == "Publier") {
            $order = $this->managers->getManagerOf('Post')->MaxOrderPosted() ;
            $order++ ;
        } elseif ($orderPosted == "Brouillon") {
            $order = null;
        }
        $post = new Post([
          'title' => $request->postData('title'),
          'content' => $request->postData('content'),
          'orderPosted' => $order
        ]);
        if ($request->postExists('id')) {
            $post->setId($request->postData('id'));
        }
        if ($post->isValid()) {
            $this->managers->getManagerOf('Post')->save($post);
            $this->app->httpResponse()->redirect('/admin/');
        } else {
            $this->page->addVar('erreurs', $post->erreurs());
        }
        $this->page->addVar('post', $post);
    }
}
