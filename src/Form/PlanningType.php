<?php
namespace App\Form;

use App\Entity\Planning;
use App\Entity\Bateau;
use App\Entity\BateauType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class PlanningType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateTimeType::class)
            ->add('bateau', EntityType::class, [
                'class' => Bateau::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('b')
                              ->orderBy('b.typebateau_id', 'ASC');
                },
            ])
            ->add('save', SubmitType::class, ['label' => 'Créer Planning']);
    }
}
