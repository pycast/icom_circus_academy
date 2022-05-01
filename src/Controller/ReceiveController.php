<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReceiveController extends AbstractController
{
    #[Route('/recevoir', name: 'app_receive')]
    public function index(): Response
    {
        return $this->render('receive/index.html.twig', [
            'controller_name' => 'ReceiveController',
        ]);
    }
}
