<?php
namespace AppBundle\Form;

//use AppBundle\Entity\Event;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BaptismSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'city',
            TextType::class, array(   // set before entity exist
            /*EntityType::class,
            array(
                'class'   => 'AppBundle:City',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c');
                },*/
            )
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
        $builder->add(
            'restaurant',
            TextType::class,
            array(
                'required' => false
            )
        );
        $builder->add('service',
            TextType::class, array(   // set before entity exist
            /*EntityType::class, array(
                'class'   => 'AppBundle:Service',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('s');
                },*/
            )
        );
    }

    public function getBlockPrefix()
    {
        return 'app_baptism_search';
    }
}