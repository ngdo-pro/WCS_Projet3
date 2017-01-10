<?php

namespace UserBundle\Form;

use FOS\UserBundle\Util\LegacyFormHelper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\EmailType'), array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle'))
            ->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle'))
            ->add('plainPassword', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\RepeatedType'), array(
                'type' => LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\PasswordType'),
                'options' => array('translation_domain' => 'FOSUserBundle'),
                'first_options' => array('label' => 'form.password'),
                'second_options' => array('label' => 'form.password_confirmation'),
                'invalid_message' => 'fos_user.password.mismatch',
            ))
            ->add('first_name', null, array('label' => 'form.first_name', 'translation_domain' => 'FOSUserBundle'))
            ->add('last_name', null, array('label' => 'form.last_name', 'translation_domain' => 'FOSUserBundle'))
            ->add('birth_date', 'date', array('widget' => 'single_text','label' => 'form.birth_date', 'translation_domain' => 'FOSUserBundle'))
            ->add('biography', null, array('label' => 'form.biography', 'translation_domain' => 'FOSUserBundle'))
            ->add('signature_dish', null, array('label' => 'form.signature_dish', 'translation_domain' => 'FOSUserBundle'))
            ->add('phone', null, array('label' => 'form.phone', 'translation_domain' => 'FOSUserBundle'))
            ->add('profession', null, array('label' => 'form.profession', 'translation_domain' => 'FOSUserBundle'))
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