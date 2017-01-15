<?php

namespace UserBundle\Form;

use FOS\UserBundle\Util\LegacyFormHelper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('civility', ChoiceType::class, array('label' => 'form.civility', 'translation_domain' => 'FOSUserBundle', 'choices' => array(
                'm' => 'form.mister',
                'f' => 'form.misses'),
                'expanded' => true,
                'multiple' => false
            ))
            ->add('address', null, array('label' => 'form.address', 'translation_domain' => 'FOSUserBundle'))
            ->add('city', null, array('label' => 'form.city', 'translation_domain' => 'FOSUserBundle'))
            ->add('zip_code', NumberType::class, array('label' => 'form.zip_code', 'translation_domain' => 'FOSUserBundle'))
            ->add('first_name', null, array('label' => 'form.first_name', 'translation_domain' => 'FOSUserBundle','required' => true,))
            ->add('last_name', null, array('label' => 'form.last_name', 'translation_domain' => 'FOSUserBundle','required' => true,))
            ->add('birth_date', DateType::class, array('label' => 'form.birth_date', 'translation_domain' => 'FOSUserBundle', 'widget' => 'choice',
                'years' => range(date('Y')-18,date('Y')-80)))
            ->add('mobile_phone', null, array('label' => 'form.phone', 'translation_domain' => 'FOSUserBundle'))
            ->add('checkbox', CheckboxType::class, array('translation_domain' => 'FOSUserBundle',
                'label' => 'form.checkbox',
                'required' => true,
                'mapped' => false))
            ->add('email', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\EmailType'), array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle'))
            ->add('username', HiddenType::class, array('data' => 'NewUser'))
            ->add('plainPassword', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\RepeatedType'), array(
                'type' => LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\PasswordType'),
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
        return 'fos_user_registration';
    }
}