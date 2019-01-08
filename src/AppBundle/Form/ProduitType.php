<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ProduitType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('libelle')
                ->add('description')
                ->add('image', FileType::class, array('mapped' => false, "required" => FALSE))
                ->add('prixGaz', IntegerType::class, array('required' => false))
                ->add('prixProduit', IntegerType::class)
                ->add('categorieProduit', EntityType::class, array(
                    // query choices from  this entity
                    'class' => 'AppBundle:CategorieProduit',
                    // use the User.username property as the visible option string
                    'choice_label' => 'libelle')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Produit'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'appbundle_produit';
    }

}
