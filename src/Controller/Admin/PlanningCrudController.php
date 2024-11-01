<?php

namespace App\Controller\Admin;

use App\Entity\Planning;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Symfony\Component\Form\FormBuilderInterface;

class PlanningCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Planning::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            DateField::new('date', 'Date de sortie'),

            // Cases à cocher pour Matin, Après-midi, Journée complète
            ChoiceField::new('typeJournee', 'Type de sortie')
                ->setChoices([
                    'Matin' => 'matin',
                    'Après-midi' => 'après midi',
                    'Journée' => 'journée',
                ])
                ->allowMultipleChoices(true)
                ->renderExpanded(true) // Rendre les cases visibles sous forme de checkboxes
                ->setFormTypeOption('multiple', false)
                ->setFormTypeOption('expanded', true),

            AssociationField::new('bateautype', 'Type de Bateau')
                ->setRequired(true)
                ->setFormTypeOption('choice_label', 'bateautype'),
        ];
    }

    // Ajout d'une méthode pour créer une validation côté serveur
    // public function createEntity(string $entityFqcn)
    // {
    //     $planning = new Planning();

    //     $planning->setTypeJournee([]);

    //     return $planning;
    // }
}
