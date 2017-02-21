<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('login')->add('mdp', \Symfony\Component\Form\Extension\Core\Type\PasswordType::class)        ;
//        $builder->add('commandes', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, array('class' => 'AppBundle:Commande', 'multiple'=>true));
    $builder->add('submit', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class);
        
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Client'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_client';
    }


}
