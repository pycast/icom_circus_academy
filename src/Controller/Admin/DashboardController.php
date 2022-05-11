<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Photo;
use App\Entity\Session;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator
    ) {
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        //     $url = $this->adminUrlGenerator
        //         ->setController(UserCrudController::class)
        //         ->generateUrl();

        //     return $this->redirect($url);

        return $this->render('admin/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Icom Circus Academy');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Clients:');
        yield MenuItem::linkToCrud('Créer une Session', 'fas fa-calendar', Session::class);
        yield MenuItem::linkToCrud('Créer un compte client', 'fa fa-user', User::class);
        yield MenuItem::section('Blogging:');
        yield MenuItem::linkToCrud('Rédiger un article', 'fas fa-blog', Article::class)
            ->setController(ArticleCrudController::class);
        // yield MenuItem::linkToCrud('Rédiger un article spécifique à une session', 'fas fa-flag', Article::class)
        //     ->setController(SpecificArticleCrudController::class);
        yield MenuItem::section('Télécharger les photos:');
        yield MenuItem::linkToCrud('Importer des photos', 'fas fa-camera', Photo::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
