<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('first_name', null, array('label' => 'form.first_name', 'translation_domain' => 'FOSUserBundle', 'trim' => true, 'required' => true))
            ->add('last_name', null, array('label' => 'form.last_name', 'translation_domain' => 'FOSUserBundle', 'trim' => true, 'required' => true))
            ->add('checkbox', CheckboxType::class, array('translation_domain' => 'FOSUserBundle',
                'label' => 'form.checkbox',
                
                'mapped' => false,
                ))
            ->add('email', EmailType::class, array(
                'label' => 'form.email',
                'translation_domain' => 'FOSUserBundle',
                'trim' => true,
                ))
            ->add('username', HiddenType::class, array('data' => 'NewUser'))
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'options' => array('translation_domain' => 'FOSUserBundle'),
                'first_options' => array('label' => 'form.password'),
                'second_options' => array('label' => 'form.password_confirmation'),
                'invalid_message' => 'fos_user.password.mismatch',
            ))
        ;
        //TODO add a captcha
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    public function getName()
    {
        return 'app_user_registration';
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }
}