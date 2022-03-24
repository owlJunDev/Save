<?php

namespace App\Controller;

use App\Entity\InvoiceV2;
use App\Entity\MaterialV2;
use App\Entity\Project;
use App\Entity\User;
use App\Entity\Member;
use App\Entity\Request as EntityRequest;
use App\Entity\SupplierV2;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{
    /**
     * @Route("/project", name="project")
     */
    public function listAction(Request $request): Response
    {
        $projects = $this->getDoctrine()->getRepository(Project::class)->findAll(); 
        $users = $this->getDoctrine()->getRepository(User::class)->findBy(['status' => User::USER_STATUS_ACTIVE]);

        return $this->render('project/list.html.twig', [
            'projects' => $projects,
            'users' => $users,
        ]);
    }

    /**
     * @Route("/project-detail", name="project_details")
     */
    public function detailsAction(Request $request): Response
    {
        $projectId = $request->get('id');

        $requests = $this->getDoctrine()->getRepository(EntityRequest::class)->findBy(['project' => $projectId]); 
        $members = $this->getDoctrine()->getRepository(Member::class)->findBy(['project' => $projectId]);
        $project = $this->getDoctrine()->getRepository(Project::class)->findOneBy(['id' => $projectId]); 
        $invoices = $this->getDoctrine()->getRepository(InvoiceV2::class)->findAll();
        $material = $this->getDoctrine()->getRepository(MaterialV2::class)->findAll();
        $supplier = $this->getDoctrine()->getRepository(SupplierV2::class)->findAll();


        return $this->render('project/info.html.twig', [
            'project' => $project,
            'members' => $members,
            'invoices' => $invoices,
            'materials' => $material,
            'suppliers' => $supplier,
            'requests' => $requests,
        ]);
    }

    /**
     * @Route("/add-project", name="add_project")
     */ 
    public function addInvoice(Request $request)
    {
        $projectDetails = $request->get('project');
        
        $em = $this->getDoctrine()->getManager();

        $project = new Project();
        $users = $this->getDoctrine()->getRepository(User::class)->findBy(['id' => $projectDetails['member']]);

        $project
            ->setTitle($projectDetails['title'])
            ->setCreatedDate(new DateTime())
            ->setStartDate(new DateTime($projectDetails['dateStart']))
            ->setEndDate(new DateTime($projectDetails['dateEnd']))
            ->setPricePlan($projectDetails['pricePlan'])
        ;
        $em->persist($project);
        $em->flush();

        foreach ($users as $user) {
            $member = new Member();
            $member
                ->setProject($project)
                ->setUser($user)
            ;
            $em->persist($member);
        }
        $em->flush();

        return $this->redirect($request->headers->get('referer'));
    }
}
