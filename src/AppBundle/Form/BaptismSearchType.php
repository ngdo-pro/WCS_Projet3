<?php
namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use AppBundle\Entity\City;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use AppBundle\Repository\RestaurantRepository;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BaptismSearchType extends AbstractType
{
    private $restaurantRepository;

    public function configureOptions( OptionsResolver $resolver ) {
        $resolver->setRequired(['restaurantRepository']);
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $today = (new \DateTime)->format('d-m-Y');

        $builder->add(
            'city',
            EntityType::class,
            array(
                'class'             => 'AppBundle:City',
                'choice_label'      => 'name',
                'required'          => false,
                'placeholder'       => false,
                'attr'              => array('class' => 'text-capitalize')
            )
        );
        $this->restaurantRepository = $options['restaurantRepository'];
        $formModifier = function (FormInterface $form, City $city = null) {
            if ($city === null) {
                $form->add('restaurant', EntityType::class, array(
                    'class'         => 'AppBundle:Restaurant',
                    'choice_label'  => 'name',
                    'required'      => false,
                    'choices'       => array(),
                    'placeholder'   => 'Restaurant',
                    'attr'              => array('class' => 'text-capitalize')
                ));
            } else {
                $restaurants = $this->restaurantRepository->findRestaurantListCity($city->getName(),$city->getZipCode());
                $form->add('restaurant', EntityType::class, array(
                    'class'         => 'AppBundle:Restaurant',
                    'choice_label'  => 'name',
                    'required'      => false,
                    'choices'       => $restaurants,
                    'placeholder'   => 'Restaurant',
                    'attr'              => array('class' => 'text-capitalize')
                ));
            };
        };

        $builder->add('nb', ChoiceType::class, array(
                'required' => false,
                'choices' => array(
                    1 => '1 place',
                    2 => '2 places'
                ),
                'placeholder' => false
            )
        );
        $builder->add(
            'baptismDate',
            TextType::class,
            array(
                'data' => $today,
                'attr' => array(
                    'autocomplete'          => 'off',
                    'class'                 => 'datepicker',
                    'data-provide'          => 'datepicker',
                    'data-date-format'      => 'd-mm-yyyy',
                    'data-date-start-date'  => $today
                )
            )
        );

        $builder->add('service',
            EntityType::class, array(
                'class'             => 'AppBundle:Service',
                'choice_label'      => 'name',
                'required'          => false,
                'placeholder'       => false,
                'attr'              => array('class' => 'text-capitalize')
            )
        );
        


        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {
               
                $data = $event->getData();
                if (is_null($data)) {
                    $city = $event->getForm()->getData()->getCity();
                } else {
                    $city = $data->getCity();
                }
                $formModifier($event->getForm(), $city);
            }
        );

        $builder->get('city')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {

                $city = $event->getForm()->getData();
                $formModifier($event->getForm()->getParent(), $city);
            }
        );
    }

    public function getBlockPrefix()
    {
        return 'app_baptism_search';
    }
}