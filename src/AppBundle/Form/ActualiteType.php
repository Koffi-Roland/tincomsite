<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ActualiteType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('titre')
                ->add('extrait')
                ->add('surTitre')
                ->add('description')
                ->add('imageFile', FileType::class, array('mapped' => false, 'required' => false))
                ->add('categorieActualite' ,EntityType::class, array(
                    // query choices from this entity
                    'class' => 'AppBundle:CategorieActualite',
                    // use the User.username property as the visible option string
                    'choice_label' => 'libelle',
                    'multiple' => TRUE));
    }

/**
     * {@inheritdoc}
     */

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Actualite'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'appbundle_actualite';
    }

}
