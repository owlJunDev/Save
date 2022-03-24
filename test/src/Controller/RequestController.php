<?php

namespace App\Controller;

use App\Entity\InvoiceV2;
use App\Entity\MaterialV2;
use App\Entity\Project;
use App\Entity\Request as EntityRequest;
use App\Entity\SupplierV2;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RequestController extends AbstractController
{
    /**
     * @Route("/request", name="request")
     */
    public function index(Request $request): Response
    {
        $requests = $this->getDoctrine()->getRepository(EntityRequest::class)->findAll(); 
        $project = $this->getDoctrine()->getRepository(Project::class)->findAll(); 
        $invoices = $this->getDoctrine()->getRepository(InvoiceV2::class)->findAll();
        $material = $this->getDoctrine()->getRepository(MaterialV2::class)->findAll();
        $supplier = $this->getDoctrine()->getRepository(SupplierV2::class)->findAll();
        return $this->render('request/index.html.twig', [
            'projects' => $project,
            'requests' => $requests,
            'invoices' => $invoices,
            'materials' => $material,
            'suppliers' => $supplier,
        ]);
    }

    /**
     * @Route("/add-request", name="add_request")
     */ 
    public function addRequest(Request $request)
    {
        $requestDetails = $request->get('request');
        
        $em = $this->getDoctrine()->getManager();

        $requestNew = new EntityRequest();
        $invoice = $this->getDoctrine()->getRepository(InvoiceV2::class)->findOneBy(['id' => $requestDetails['invoiceId']]);
        $material = $this->getDoctrine()->getRepository(MaterialV2::class)->findOneBy(['id' => $requestDetails['materialId']]);
        $project = $this->getDoctrine()->getRepository(Project::class)->findOneBy(['id' => $requestDetails['projectId']]);
        $supplier = $this->getDoctrine()->getRepository(SupplierV2::class)->findOneBy(['id' => $requestDetails['supplierId']]);
        // dump($requestDetails);die;
        $requestNew
            ->setInvoice($invoice)
            ->setMaterial($material)
            ->setCreatedDate(new DateTime())
            ->setProject($project)
            ->setSupplier($supplier)
            ->setQty($requestDetails['qty'])
            ->setPrice($requestDetails['price'])
        ;
            
        $em->persist($requestNew);
        $em->flush();

        return $this->redirect($request->headers->get('referer'));
    }
}
