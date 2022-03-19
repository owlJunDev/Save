<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MaterialController extends AbstractController
{
    /**
     * @Route("/material", name="material")
     */
    public function index(): Response
    {
        return $this->render('material/index.html.twig', [
            'controller_name' => 'MaterialController',
        ]);
    }
}
