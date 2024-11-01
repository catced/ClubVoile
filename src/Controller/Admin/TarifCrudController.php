<?php

namespace App\Controller\Admin;

use App\Entity\Tarif;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;

class TarifCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tarif::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('libelle', 'Libellé'),
            NumberField::new('tarif', 'Tarif')
            ->setNumDecimals(2),   // Spécifie 2 décimales
          

            // Utilisation de ChoiceField pour afficher une liste déroulante pour la catégorie
            ChoiceField::new('categorie', 'Catégorie')
                ->setChoices([
                    'Adhésion' => 'adhésion',
                    'Forfait' => 'forfait',
                    'Licence' => 'licence',
                    'Formation théorique' => 'formation theorique',
                    'Régate/Cabotage' => 'regate/cabotage',
                ])
                ->renderExpanded(false) // Par défaut, c'est une liste déroulante
                ->allowMultipleChoices(false),
        ];
    }
}
