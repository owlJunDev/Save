<?php

namespace App\Controller;

use App\Entity\MaterialV2;
use App\Entity\Unit;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MaterialController extends AbstractController
{
    /**
     * @Route("/material", name="material")
     */
    public function index(): Response
    {
        $materials = $this->getDoctrine()->getRepository(MaterialV2::class)->findAll();
        $units = $this->getDoctrine()->getRepository(Unit::class)->findAll(); 

        return $this->render('material/index.html.twig', [
            'materials' => $materials,
            'units' => $units
        ]);
    }

    /**
     * @Route("/add-material", name="add_material")
     */
    public function addMaterial(Request $request)
    {
        $materialDetails = $request->get('material');

        $em = $this->getDoctrine()->getManager();
        $material = new MaterialV2();
        $unit = $this->getDoctrine()->getRepository(Unit::class)->findOneBy(['id' => $materialDetails['unit']]); 

        $material
            ->setCode($materialDetails['code'])
            ->setTitle($materialDetails['title'])
            ->setUnit($unit)
            ->setQty($materialDetails['qty'])
        ;
        $em->persist($material);
        $em->flush();

        return $this->redirect($request->headers->get('referer'));
    }
}
