<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\InvoiceV2;
use App\Entity\User;
use DateTime;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InvoiceController extends AbstractController
{
    /**
     * @Route("/invoice", name="invoice")
     */
    public function index(): Response
    {
        $invoices = $this->getDoctrine()->getRepository(InvoiceV2::class)->findAll(); 
        $users = $this->getDoctrine()->getRepository(User::class)->findAll(); 
        return $this->render('invoice/index.html.twig', [
            'invoices' => $invoices,
            'users' => $users,
        ]);
    }

    /**
     * @Route("/add-invoice", name="add_invoice")
     */ 
    public function addInvoice(Request $request):Response
    {
        $invoiceDetails = $request->get('invoice');

        $flashbag = $this->get('session')->getFlashBag();
        $flashbag->clear();
        
        $em = $this->getDoctrine()->getManager();

        $invoice = new InvoiceV2();
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['id' => $invoiceDetails['owner']]);
        $invoiceCheck = $this->getDoctrine()->getRepository(InvoiceV2::class)->findOneBy(['numberInvoice' => $invoiceDetails['numberInvoice']]);
        
        if (!empty($invoiceCheck)) {
            return $this->redirect($request->headers->get('referer'));
        }

        $invoice
            ->setNumberInvoice($invoiceDetails['numberInvoice'])
            ->setAmount($invoiceDetails['amount'])
            ->setUser($user)
            ->setCreateDate(new \DateTime())
        ;
        $em->persist($invoice);
        $em->flush();
        return $this->redirect($request->headers->get('referer'));
    }
}
