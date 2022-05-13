<?php

namespace App\Controller;

use App\Repository\DispoRepository;
use App\Repository\SessionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReceiveController extends AbstractController
{
    #[Route('/recevoir', name: 'app_receive')]
    public function index(SessionRepository $sessions, DispoRepository $dispos): Response
    {
        $circusSessions = $sessions->findAll();
        $color = ['rgb(255,180,0)', 'rgb(144,104,212)', 'rgb(75,177,223)'];
        $disponibilities = $dispos->findAll();


        foreach ($circusSessions as $Csession) {
            shuffle($color);
            $events[] = [
                'id' => $Csession->getId(),
                'title' => $Csession->getName(),
                'start' => $Csession->getDate()->format('Y-m-d'),
                'end' => date_add($Csession->getDate(), date_interval_create_from_date_string('5 days'))->format('Y-m-d'),
                'backgroundColor' => $color[1],
                'borderColor' => $color[0],
            ];
        }

        foreach ($disponibilities as $dispo) {
            $events[] = [
                'id' => 1,
                'title' => "L'académie est disponible",
                'start' => $dispo->getStart()->format('Y-m-d'),
                'end' => $dispo->getEnd()->format('Y-m-d'),
                'display' => 'background',
                'backgroundColor' => 'green'
            ];

            // $events[] = [
            //     'id' => 1,
            //     'start' => $dispo->getStart()->format('Y-m-d'),
            //     'end' => $dispo->getEnd()->format('Y-m-d'),
            //     'display' => 'inverse-background',
            //     'backgroundColor' => 'red'
            // ];
        }


        $data = json_encode($events);

        return $this->render(
            'receive/index.html.twig',
            ['controller_name' => 'ReceiveController', "data" => $data],
        );
    }
}
