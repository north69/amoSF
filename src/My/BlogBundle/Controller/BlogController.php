<?php

namespace My\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\HeaderBag;

class BlogController extends Controller
{
    public function listAction(Request $request)
    {
        $task = array(
            'task'=>'hello younkers.',
        );
        $form = $this->createFormBuilder($task)
            ->add('task','text')
            ->getForm();
        // if ($request->getMethod() == 'POST') {
        //     $form->bindRequest($request);
        // }
        return $this->render('MyBlogBundle:Blog:blog.html.twig', array(
            'form' => $form->createView(),
        ));

    	// $items = "<li><a href='/blog/details/1'>one</a></li><li>two</li><li>three</li>";
    	// $list = "<ul>$items</ul>";
     //    return new Response('<h1>hello World..</h1>'.$list);
    }

    public function detailsAction($id)
    {
    	$arr2json = array(
    				'menu' => 'file',
    				'comands' => array(
    								'title' =>'New',
    								'action' => 'CreateDoc'
    								)
    				);

    	$response = new Response(json_encode($arr2json));
		$response->headers->set('Content-Type', 'application/json');


        return $response;
    }
}
