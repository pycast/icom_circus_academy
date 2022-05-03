<?php

namespace App\Controller\Admin;

use App\Entity\Photo;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class PhotoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Photo::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            DateField::new('date'),
            AssociationField::new('Session'),
            TextEditorField::new('description'),
            ImageField::new('photoName')
            ->setBasePath('uploads/')->setUploadDir('public/uploads')
            ->setUploadedFileNamePattern('[randomhash].[extension]'),
        ];
    }
    
}
