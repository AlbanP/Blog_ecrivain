<?php
namespace App\Frontend\Modules;

use \PiFram\BackController;
use \PiFram\HTTPRequest;
use \Entity\Comment;

class CommentAjaxController extends BackController
{
    // Ajax refresch list of comments by post (postId) - lastId is the last Id comment in the navigator
    public function executeShowComment(HTTPRequest $request)
    {
        $postId = $request->postData('postId');
        $lastId = $request->postData('lastId');
        $listComment = $this->managers->getManagerOf('Comment')->getListOf($postId, $lastId);
        echo json_encode($listComment);
    }
    // Ajax add comment in DB by post (postId), if response of other comment (parentId)
    public function executeAddComment(HTTPRequest $request)
    {
        if ($request->postExists('author')) {
            $comment = new Comment([
                'postId' => $request->postData('postId'),
                'parentId' => $request->postData('parentId'),
                'author' => $request->postData('author'),
                'content' => $request->postData('content')
            ]);
            if ($comment->isValid()) {
                $this->managers->getManagerOf('Comment')->save($comment);
            }
        }
    }
    // Ajax reported comment by id of comment
    public function executeReportComment(HTTPRequest $request)
    {
        $this->managers->getManagerOf('Comment')->report($request->postData('id'));
    }
}
