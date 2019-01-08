<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class PartenaireType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('nom')
                ->add('lien')
                ->add('image', FileType::class, array('mapped' => false, "required" => FALSE))
                ->add('categoriePartenaire', EntityType::class, array(
                    // query choices from this entity
                    'class' => 'AppBundle:CategoriePartenaire',
                    // use the User.username property as the visible option string
                    'choice_label' => 'libelle'));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Partenaire'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'appbundle_partenaire';
    }

}
