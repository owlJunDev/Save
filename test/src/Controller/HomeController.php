<?php

namespace App\Controller;

use App\Entity\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
//    public function index(Request $request): Response
    public function index(): Response
    {
        /*if (!$this->getUser()) {
            return $this->redirectToRoute('login');
        }*/

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
