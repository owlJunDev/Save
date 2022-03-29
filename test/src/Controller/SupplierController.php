<?php

namespace App\Controller;

use App\Entity\SupplierV2;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class SupplierController extends AbstractController
{
    /**
     * @Route("/supplier", name="supplier")
     */
    public function index(): Response
    {
        $suppliers = $this->getDoctrine()->getRepository(SupplierV2::class)->findAll();

        return $this->render('supplier/index.html.twig', [
            'suppliers' => $suppliers,
        ]);
    }

    /**
     * @Route("/add-supplier", name="add_supplier")
     */ 
    public function addSupplier(Request $request)
    {
        $supplierDetails = $request->get('supplier');
        
        $em = $this->getDoctrine()->getManager();

        $supplier = new SupplierV2();
        $supplierCheck = $this->getDoctrine()->getRepository(SupplierV2::class)->findOneBy(['itn' => $supplierDetails['itn']]);
        
        if (!empty($supplierCheck)) {
            return $this->redirect($request->headers->get('referer'));
        }

        $supplier
            ->setTitleCompany($supplierDetails['titleCompany'])
            ->setLastName($supplierDetails['lastName'])
            ->setFirstName($supplierDetails['firstName'])
            ->setSecondName($supplierDetails['secondName'])
            ->setItn($supplierDetails['itn'])
            ->setEmail($supplierDetails['email'])
            ->setPhone($supplierDetails['phone'])
        ;
        $em->persist($supplier);
        $em->flush();

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * @Route("/send-ajax", name="lust_supplier")
     */ 
    public function sendAjax(Request $request)
    {}
}
