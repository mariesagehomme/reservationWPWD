<?php

namespace App\Form;

use App\Entity\Reservation;
use App\Entity\Representation;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('places')
                //https://stackoverflow.com/questions/42599170/symfony-error-catchable-fatal-error-object-of-class-proxies-cg-appbundle-e
                //custom le form à la place du tostring getTheShow(); dans l'entité Representation
            ->add('representation', EntityType::class, [
        'class' => Representation::class,
        'placeholder' => ' ',
         'choice_label' => function($representation){
            return $representation->getTheShow();
        },
        'multiple' => false, // a user can select only one option per submission
        'expanded' => false // options will be presented in a <select> element; set this to true, to present the data as checkboxes             
        ])
             //Dans l'entité user, ajout de la methode tostring   
            //->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
