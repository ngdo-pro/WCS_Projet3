<?php
namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class BaptismSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'city',
            EntityType::class,
            array(
                'class'   => 'AppBundle:City',
                'choice_label' => 'name',
            )
        );
        $builder->add(
            'restaurant',
            TextType::class,
            array(
                'required' => false,

            )
        );
        $builder->add(
            'nb',
            IntegerType::class
        );
        $builder->add(
            'baptismDate',
            TextType::class,
            array(
                'data' => (new \DateTime)->format('Y-m-d'),
                'attr' => array(
                    'autocomplete' => 'off',
                )
            )
        );

        $builder->add('service',
            EntityType::class, array(
                'class'   => 'AppBundle:Service',
                'choice_label' => 'name',
            )
        );
    }

    public function getBlockPrefix()
    {
        return 'app_baptism_search';
    }
}