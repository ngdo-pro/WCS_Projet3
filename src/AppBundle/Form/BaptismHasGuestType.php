<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BaptismHasGuestType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $choices = array();
        for($i = 1; $i <= $options['data']->getGuestCount(); $i++){
            $choices[$i] = $i;
        }

        $builder
            ->add('guestCount', ChoiceType::class, array(
                'choices' => $choices
            ))
            ->add('invitedGuest', HiddenType::class, array(
                'data' => $options['data']->getGuestCount(),
                'mapped' => false
            ))
            ->add('validate', SubmitType::class)
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\BaptismHasUser'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_baptismhasuser';
    }


}
