<?php

namespace Site\UtilisateurBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UtilisateurInscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pseudo', 'text', array('label' => 'Login : '))
            ->add('password', 'password', array('label' => 'Password : '))
            ->add('rang', 'choice', array(
    'choices' => array('Administrateur' => 'Administrateur', 'Organisateur' => 'Organisateur', 'Presse' => 'Presse')
));
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Site\UtilisateurBundle\Entity\Utilisateur'
        ));
    }

    public function getName()
    {
        return 'utilisateurinscriptiontype';
    }
}

?>