<?php

namespace App\Controller;

use App\Repository\SessionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReceiveController extends AbstractController
{
    #[Route('/recevoir', name: 'app_receive')]
    public function index(SessionRepository $sessions): Response
    {
        $events = $sessions->findAll();

        foreach ($events as $event) {
            $weeks[] = [
                'id' => $event->getId(),
                'title' => $event->getName(),
                'start' => $event->getDate()->format('Y-m-d'),
                'end' => date_add($event->getDate(), date_interval_create_from_date_string('5 days'))->format('Y-m-d'),
                'backgroundColor' => "rgb(255,180,0)"
            ];
        }

        $data = json_encode($weeks);

        return $this->render(
            'receive/index.html.twig',
            ['controller_name' => 'ReceiveController', "data" => $data],
        );
    }
}
