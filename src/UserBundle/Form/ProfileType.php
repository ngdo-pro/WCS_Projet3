<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace UserBundle\Form;

use AppBundle\Entity\Media;
use FOS\UserBundle\Util\LegacyFormHelper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class ProfileType extends AbstractType
{
    /**
     * @var string
     */
    private $class;

    /**
     * @param string $class The User class name
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->buildUserForm($builder, $options);

        $constraintsOptions = array(
            'message' => 'fos_user.current_password.invalid',
        );

        if (!empty($options['validation_groups'])) {
            $constraintsOptions['groups'] = array(reset($options['validation_groups']));
        }

        $builder->add('current_password', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\PasswordType'), array(
            'label' => 'form.current_password',
            'translation_domain' => 'FOSUserBundle',
            'mapped' => false,
            'constraints' => new UserPassword($constraintsOptions),
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->class,
            'csrf_token_id' => 'profile',
            // BC for SF < 2.8
            'intention' => 'profile',
        ));
    }

    public function getBlockPrefix()
    {
        return 'app_user_profile';
    }

    public function getName()
    {
        return 'app_user_profile';
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\ProfileFormType';
    }

    /**
     * Builds the embedded form representing the user.
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    protected function buildUserForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('media', FileType::class, array('label' => 'form.picture', 'translation_domain' => 'FOSUserBundle',
                'mapped' => false,
                'required' => false,
            ))
            ->add('civility', ChoiceType::class, array('label' => 'form.civility', 'translation_domain' => 'FOSUserBundle', 'choices' => array(
                'm' => 'form.mister',
                'f' => 'form.misses'),
                'expanded' => true,
                'multiple' => false,
            ))
            ->add('address', null, array('label' => 'form.address', 'translation_domain' => 'FOSUserBundle', 'trim' => true))
            ->add('city', null, array('label' => 'form.city', 'translation_domain' => 'FOSUserBundle', 'trim' => true))
            ->add('zip_code', null, array('label' => 'form.zip_code', 'translation_domain' => 'FOSUserBundle', 'trim' => true))
            ->add('first_name', null, array('label' => 'form.first_name', 'translation_domain' => 'FOSUserBundle', 'trim' => true))
            ->add('last_name', null, array('label' => 'form.last_name', 'translation_domain' => 'FOSUserBundle', 'trim' => true))
            ->add('birth_date', DateType::class, array('label' => 'form.birth_date', 'translation_domain' => 'FOSUserBundle', 'widget' => 'choice',
                'years' => range(date('Y'),date('Y')-80)))
            ->add('mobile_phone', null, array('label' => 'form.phone', 'translation_domain' => 'FOSUserBundle'))
            ->add('email', EmailType::class, array(
                'label' => 'form.email',
                'translation_domain' => 'FOSUserBundle',
                'trim' => true,
            ))
            ->remove('username')
            ->add('plainPassword', RepeatedType::class, array('required' => false,
                'type' => PasswordType::class,
                'options' => array('translation_domain' => 'FOSUserBundle'),
                'first_options' => array('label' => 'form.password'),
                'second_options' => array('label' => 'form.password_confirmation'),
                'invalid_message' => 'fos_user.password.mismatch',
            ))
            ->add('submit', SubmitType::class, array('label' => 'profile.edit.submit', 'translation_domain' => 'FOSUserBundle'))
        ;
    }
}
