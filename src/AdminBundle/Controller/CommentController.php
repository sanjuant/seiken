<?php

namespace AdminBundle\Controller;

use AppBundle\Entity\Comment;
use AppBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/admin")
 */
class CommentController extends Controller
{
    public $module = "boutique";

    /**
     * @Route("/comments/{slug}", name="admin.comments")
     */
    public function indexAction($slug)
    {
        // SELECT * FROM posts;
        $post = $this->getDoctrine()->getRepository(Post::class)->findOneWithComments($slug);

        return $this->render('@Admin/Comments/index.html.twig', array(
            'comments' => $post->getComments()
        ));
    }

    /**
     * @Route("/comment/delete/{id}", name="admin.comment.delete")
     */
    public function deleteAction(Comment $comment)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($comment);
        $em->flush();

        if (count($comment->getPost()->getComments()) > 0) {
            return $this->redirectToRoute('admin.comments', ['slug' => $comment->getPost()->getSlug()]);
        } else {
            return $this->redirectToRoute('admin.posts');
        }
    }
}
