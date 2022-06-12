<?php

namespace App\Form;

use App\Entity\Booking;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Booking3Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id_reservation')
            ->add('date_arrivee')
            ->add('date_depart')
            ->add('duree_sejour')
            ->add('id_annonce')
            ->add('id_voyageur')
            ->add('nbr_adulte')
            ->add('nb_enfants')
            ->add('remarques')
            ->add('Prix_total')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}
