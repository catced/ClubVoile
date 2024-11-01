<?php

namespace App\Form;

use App\Entity\Tarif;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TarifType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prix')
            ->add('categorie', ChoiceType::class, [
                'choices' => [
                   'Adhésion' => 'adhésion',
                    'Forfait' => 'forfait',
                    'Licence' => 'licence',
                    'Formation théorique' => 'formation theorique',
                    'Régate/Cabotage' => 'regate/cabotage',
                ],
                'label' => 'Catégorie'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tarif::class,
        ]);
    }
}
