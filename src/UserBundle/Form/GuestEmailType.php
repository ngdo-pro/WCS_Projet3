<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 18/01/17
 * Time: 15:47
 */

namespace AppBundle\Form;


use Doctrine\Common\Collections\Collection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GuestEmailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', Collection::class, array(
                'type' => EmailType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype_name' => '__prototype__',
                'by_reference' => false,
                'error_bubbling' => false
            ))
            ->add('validate', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'userbundle_user';
    }
}