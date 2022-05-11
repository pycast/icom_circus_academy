<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Controller\Admin\ArticleCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;

use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class SpecificArticleCrudController extends ArticleCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('Session')->setFormTypeOption('required', true),
            TextField::new('titre'),
            TextEditorField::new('contenu'),
            TextField::new('auteur'),
            DateField::new('date'),
            ImageField::new('illustration')
                ->setBasePath('uploads/')
                ->setUploadDir('public/uploads')
                ->setUploadedFileNamePattern('[randomhash].[extension]'),
        ];
    }
}
