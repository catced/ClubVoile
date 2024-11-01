<?php

namespace App\Controller\Admin;

use App\Entity\CA;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use Symfony\Component\HttpFoundation\File\File; 

class CACrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CA::class;
    }

   
    public function configureFields(string $pageName): iterable
    {
        
            return [
            IdField::new('Id')->hideOnForm(),
            // yield DateField::new('Date');
            TextField::new('chemin')->onlyOnIndex(),
            DateField::new('updatedAt','Date')->onlyOnIndex(),
            Field::new('file')
                ->setFormType(VichFileType::class)
                ->setLabel('Fichier (PDF, ZIP)'),
            // yield ImageField::new('image_path')
            // ->setBasePath('/upload/ca')
            // // ->onlyOnIndex()
            // // ->hideOnForm()
            // ->setUploadDir('public/upload/ca');
            // // ->setRequired(false);
            ];



            // TextField::new('toto','Chemin')
            //     ->setFormType(VichFileType::class),
                // ->setUploadDir('public/uploads/ca') // Répertoire de destination
                // ->setBasePath('uploads/ca') // URL pour accéder au fichier
                // ->setRequired(false), // Facultatif
      
        
    }
    
}
