<?php

namespace App\Controller;

use App\Entity\Photo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MemberController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/EspaceParent', name: 'app_member')]
    public function index(): Response
    {

        return $this->render('member/index.html.twig', [
            'controller_name' => 'MemberController',
        ]);
    }

    #[Route('/EspaceParent/Album', name: 'app_member_album')]
    public function show(): Response
    {        

        $userSession = $this->getUser()->getSession()->getId();
        
        $photos = $this->entityManager->getRepository(Photo::class)->findBy(['Session' => $userSession]);

        return $this->render('member/album.html.twig', [
            'controller_name' => 'MemberController',
            'photos' => $photos
        ]);

        

    }
}
