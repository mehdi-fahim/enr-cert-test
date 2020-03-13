<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class CarsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('marque')
            ->add('modele')
            ->add('annee')
            ->add('prix')
            ->add('date_circulation',DateType::class, [
                'format' => 'yyyy-MM-dd',
            ])
            ->add('kilometrage')
            ->add('carburant')
            ->add('boite_vitesse')
            ->add('couleur')
            ->add('nombre_portes')
            ->add('nombre_places')
            ->add('puissance_fiscale')
            ->add('puissance_din')
            ->add('permis')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
