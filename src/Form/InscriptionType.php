<?php


namespace App\Form;

use App\Entity\Inscription;
use App\Entity\Tarif;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomadherent')
            ->add('prenom')
            ->add('telephone')
            ->add('email')
            ->add('plain_Password', PasswordType::class, [
                'mapped' => false, 
            ])
            // ->add('tarif', EntityType::class, [
            //     'class' => Tarif::class,
            //     'choice_label' => function (Tarif $tarif) {
            //         return $tarif->getLibelle() . ' - ' . $tarif->getTarif() . '€';
            //     }
            // ])
            // ->add('quantite')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Inscription::class,
        ]);
    }
}
