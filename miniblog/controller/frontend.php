<?php
// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');



/**
 * Extract all posts and display on main page
 */
function listPosts()
{
    $postManager = new \Guillaume\miniBlog\Model\PostManager(); // Creation d'une instance
    $posts = $postManager->getPosts();// Appel d'une methode de la classe

    require('view/frontend/listPostsView.php');
}



/**
 * Insert new post in database
 * 
 * @param string $author  The author of the new post.
 * @param string $comment The text of the new post.
 */
function addPost($author, $title, $content)
{
    $postManager = new \Guillaume\miniBlog\Model\PostManager(); // Creation d'une instance
    
    $affectedLines = $postManager->addPost($author, $title, $content);

    if ($affectedLines === false)
    {
        // Error intercepted and send back to the "try" of the rooter
        throw new Exception('Impossible d\'ajouter une news !');
    }
    else {
        header('Location: index.php');
    }
}




/**
 * Delete selected post in database
 * 
 * @param int    $postId      The Id of selected post.
 */
function deletePost($postId)
{
    $postManager = new \Guillaume\miniBlog\Model\PostManager(); // Creation d'une instance
    
    $affectedLines = $postManager->delAllPostComments($postId);

    if ($affectedLines === false)
    {
        // Error intercepted and send back to the "try" of the rooter
        throw new Exception('Impossible de supprimer les commentaires associés a cette news ! (controller/frondend/delAllPostComments)');
    }
    else
    {
        $affectedLines = $postManager->delPost($postId);
        
        if ($affectedLines === false)
        {
            // Error intercepted and send back to the "try" of the rooter
            throw new Exception('Impossible de supprimer cette news ! (controller/frondend/delPost)');
        }
        else
        {
            header('Location: index.php');
        }
    }
}




/**
 * Extract selected post and all related comments and display on comment page
 */
function post()
{
    $postManager    = new \Guillaume\miniBlog\Model\PostManager();    // Creation d'une instance
    $commentManager = new \Guillaume\miniBlog\Model\CommentManager(); // Creation d'une instance
    
    $post     = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('view/frontend/commentsView.php');
}




/**
 * Extract selected post and related comments AND EDITED COMMENT and display on comment page
 */
function editComment()
{
    $postManager    = new \Guillaume\miniBlog\Model\PostManager();    // Creation d'une instance
    $commentManager = new \Guillaume\miniBlog\Model\CommentManager(); // Creation d'une instance
    
    $post           = $postManager->getPost($_GET['id']);
    $comments       = $commentManager->getComments($_GET['id']);
    $editedComment  = $commentManager->getComment($_GET['id_comment']);

    require('view/frontend/commentsView.php');
}




/**
 * Insert new comment in database
 * 
 * @param int    $postId  The Id of selected post.
 * @param string $author  The author of the new comment.
 * @param string $comment The text of the new comment.
 */
function addComment($postId, $author, $comment)
{
    $commentManager = new \Guillaume\miniBlog\Model\CommentManager(); // Creation d'une instance
    
    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false)
    {
        // Error intercepted and send back to the "try" of the rooter
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}




/**
 * Update selected comment in database
 * 
 * @param int    $postId      The Id of selected post.
 * @param string $id_comment  The Id of selected comment.
 * @param string $comment     The new text of the selected comment.
 */
function updateComment($postId, $id_comment, $comment)
{
    $commentManager = new \Guillaume\miniBlog\Model\CommentManager(); // Creation d'une instance
    
    $affectedLines = $commentManager->updateComment($id_comment, $comment);

    if ($affectedLines === false)
    {
        // Error intercepted and send back to the "try" of the rooter
        throw new Exception('Impossible de modifier le commentaire ! (controller/frondend/updateComment)');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}



/**
 * Delete selected comment in database
 * 
 * @param int    $postId      The Id of selected post.
 * @param string $id_comment  The Id of selected comment.
 * @param string $comment     The new text of the selected comment.
 */
function deleteComment($postId, $id_comment)
{
    $commentManager = new \Guillaume\miniBlog\Model\CommentManager(); // Creation d'une instance
    
    $affectedLines = $commentManager->delComment($id_comment);

    if ($affectedLines === false)
    {
        // Error intercepted and send back to the "try" of the rooter
        throw new Exception('Impossible de supprimer le commentaire ! (controller/frondend/deleteComment)');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}