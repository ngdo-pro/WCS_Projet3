<?php

namespace UserBundle\Form;

use FOS\UserBundle\Util\LegacyFormHelper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('civility', ChoiceType::class, array('label' => 'form.civility', 'translation_domain' => 'FOSUserBundle', 'choices' => array(
                'm' => array('label' => 'form.mister'),
                'f' => array('label' => 'form.misses')),
                'expanded' => true,
                'multiple' => false
            ))
            ->add('address', null, array())
            ->add('first_name', null, array('label' => 'form.first_name', 'translation_domain' => 'FOSUserBundle'))
            ->add('last_name', null, array('label' => 'form.last_name', 'translation_domain' => 'FOSUserBundle'))
            ->add('birth_date', 'date', array('widget' => 'single_text','label' => 'form.birth_date', 'translation_domain' => 'FOSUserBundle'))
            ->add('mobile_phone', null, array('label' => 'form.phone', 'translation_domain' => 'FOSUserBundle'))
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
    }


    public function getName()
    {
        return 'app_user_registration';
    }

    public function getParent()
    {
        return 'fos_user_registration';
    }
    public function setEmail($email)
    {
        parent::setEmail($email);
        $this->setUsername($email);
    }
}