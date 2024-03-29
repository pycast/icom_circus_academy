<?php

namespace App\Controller;

use App\Entity\Photo;
use App\Entity\Article;
use App\Entity\Image;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
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
    public function index(PaginatorInterface $paginator, Request $request): Response
    {

        if ($this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute("admin");
        }

        $generalposts = $paginator->paginate(
            $this->entityManager->getRepository(Article::class)->findAll(),
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('member/index.html.twig', [
            'controller_name' => 'MemberController',
            "posts" => $generalposts
        ]);
    }

    #[Route('/EspaceParent/blog/{slug}', name: 'app_blog')]

    public function focus($slug): Response
    {

        $blogArticle = $this->entityManager->getRepository(Article::class)->findOneBy(['slug' => $slug]);

        return $this->render('member/article.html.twig', [
            'controller_name' => 'MemberController',
            "article" => $blogArticle
        ]);
    }

    #[Route('/EspaceParent/Album', name: 'app_member_album')]
    public function show(): Response
    {

        if ($this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute("admin");
        }

        $userSession = $this->getUser()->getSession()->getId();

        $photos = $this->entityManager->getRepository(Photo::class)->findBy(['Session' => $userSession]);
        $img = $this->entityManager->getRepository(Image::class)->findBy(['photo' => $photos]);

        return $this->render('member/album.html.twig', [
            'controller_name' => 'MemberController',
            'photos' => $photos,
            'images' => $img
        ]);
    }
}
