<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\InvoiceV2;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InvoiceController extends AbstractController
{
    /**
     * @Route("/invoice", name="invoice")
     */
    public function index(): Response
    {
        $invoice = $this->getDoctrine()->getRepository(InvoiceV2::class)->findAll(); 
        return $this->render('invoice/index.html.twig', [
            'invoices' => $invoice,
        ]);
    }
}
