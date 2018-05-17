<?php

namespace Contact\ContactBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class ContactType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class, array(
                'label'=>'Prénom',
            ))
            ->add('email',EmailType::class, array(
                'label'=>'Mail',
                'attr'=>array(
                    'placeholder'=>'votre adresse mail')))
            ->add('demande', TextareaType::class, array(
                    'attr'=>array(
                        'placeholder'=>'votre question',
                        'cols'=> '40',
                        'rows'=>'5' ))
            );

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Contact\ContactBundle\Entity\Contact'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'contact_contactbundle_contact';
    }


}
