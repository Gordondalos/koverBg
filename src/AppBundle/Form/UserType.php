<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
	    $builder
		 ->add('username', TextType::class, array(
	    'required' => true,
	    'label' => "Username "
    ))
	    ->add('email', TextType::class, array(
		    'required' => true,
		    'label' => "Adresse email "
	    ))
	    ->add('plainPassword',  RepeatedType::class, array(
		    'type' => PasswordType::class,
		    'options' => array('translation_domain' => 'FOSUserBundle'),
		    'first_options' => array('label' => 'form.password'),
		    'second_options' => array('label' => 'form.password_confirmation'),
		    'invalid_message' => 'fos_user.password.mismatch',
	    ))
	    ->add('roles', ChoiceType::class, array(
		    'required' => true,
		    'choices' => array('Salarié' => 'ROLE_SALARIE', 'Admin' => 'ROLE_ADMIN'),
		    'multiple' => true,
		    'expanded'=>true,
		    'label' => "Rôle ",
		    'label_attr' => array('class' => 'checkbox-inline')
	    ))
    ;

	    $builder->add('groups', EntityType::class ,array(
		    'class'    => 'AppBundle:Group' ,
		    'choice_label' => 'name' ,
		    'multiple' => true ,
	    ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_user';
    }


}
