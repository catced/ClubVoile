<?php

namespace App\Controller\Admin;

use App\Entity\Bateau;
use App\Repository\BateauRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MenuItem;


class BateauCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Bateau::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('Id')->hideOnForm();
        yield TextField::new('Nom');
        yield AssociationField::new('bateautype');
        yield TextEditorField::new('Description');
        yield ImageField::new('image_path')
            ->setBasePath('/images/bateaux')
            // ->onlyOnIndex()
            // ->hideOnForm()
            ->setUploadDir('public/images/bateaux');
            // ->setRequired(false);
        yield NumberField::new('Longueur');
        yield NumberField::new('Largeur');
        yield NumberField::new('tirant_eau');
        yield NumberField::new('Surf_gv');
        yield NumberField::new('genois');
        yield NumberField::new('spi');
    }

   
}