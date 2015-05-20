<?php

namespace My\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\HeaderBag;

class BlogController extends Controller
{
    public function listAction()
    {
    	$items = "<li><a href='/blog/details/1'>one</a></li><li>two</li><li>three</li>";
    	$list = "<ul>$items</ul>";
        return new Response('<h1>hello World..</h1>'.$list);
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
