<?php

namespace WCS\CoavBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use WCS\CoavBundle\Entity\PlaneModel;
use WCS\CoavBundle\Entity\User;

class FlightType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('departure')
            ->add('arrival')
            ->add('seatPrice')
            ->add('takeOffTime', DateType::class, [
                'widget' => 'choice',
                'years' => range(date('Y'), date('Y') + 5 ),
            ])
            ->add('description')
            ->add('pilot', EntityType::class, [
                'class' => User::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->where('u.isACertifiedPilot = True')
                        ->andWhere('u.isActive = True');
                }
            ])
            ->add('plane', EntityType::class, [
                'class' => PlaneModel::class,
                'choice_label' => 'model',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('pm')
                        ->orderBy('pm.model', 'ASC')
                        ->where('pm.isAvailable = True');
                }
            ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WCS\CoavBundle\Entity\Flight'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'wcs_coavbundle_flight';
    }


}
