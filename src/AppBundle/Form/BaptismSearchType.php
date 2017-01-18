<?php
namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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

        $builder->add(
            'city',
            EntityType::class,
            array(
                'class'   => 'AppBundle:City',
                'choice_label' => 'name',
            )
        );
        $this->restaurantRepository = $options['restaurantRepository'];
        $formModifier = function (FormInterface $form, City $city = null) {
            if ($city === null) {
                $form->add('restaurant', EntityType::class, array(
                    'class'       => 'AppBundle:Restaurant',
                    //'placeholder' => '',
                    'choice_label' => 'name',
                    'choices'     => array(),
                ));} else {
                $restaurants = $this->restaurantRepository->findRestaurantListCity($city->getName(),$city->getPostalCode());
                $form->add('restaurant', EntityType::class, array(
                    'class'       => 'AppBundle:Restaurant',
                    //'placeholder' => '',
                    'choice_label' => 'name',
                    'choices'     => $restaurants
                ));
            };

        };

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
        


        $builder->addEventListener(
            FormEvents::POST_SET_DATA,  //PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {
                // this would be your entity, i.e. SportMeetup
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