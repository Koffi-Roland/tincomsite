<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

class OpportuniteType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('titre')
                ->add('image', FileType::class, array('mapped' => false, "required" => FALSE))
                ->add('libelle')
                ->add('dateLancement', BirthdayType::class, array(
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy',
                ))
                ->add('dateCloture', DateTimeType::class, array(
                    'widget' => 'single_text',
                    'format' => "dd-MM-yyyy HH:mm",
                ))
                ->add('description')
                ->add('typeOpportunite', EntityType::class, array(
                    'class' => 'AppBundle:TypeOpportunite',
                    // use the User.username property as the visible option string
                    'choice_label' => 'libelle'));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Opportunite'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'appbundle_opportunite';
    }

}
