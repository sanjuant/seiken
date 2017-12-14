<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, array(
                'label' => 'Prénom',
                'attr' => array('placeholder' => 'John'),
                'constraints' => array(new NotBlank(array("message" => "Please provide your firstname")),)))
            ->add('lastname', TextType::class, array(
                'label' => 'Nom',
                'attr' => array('placeholder' => 'Doe'),
                'constraints' => array(new NotBlank(array("message" => "Please provide your lastname")),)))
            ->add('phone', TextType::class, array(
                'label' => 'Téléphone',
                'attr' => array('placeholder' => '0684785124'),
                'constraints' => array(new NotBlank(array("message" => "Please provide your phone")),)))
            ->add('email', TextType::class, array(
                'label' => 'Email',
                'attr' => array('placeholder' => 'adresse@mail.com'),
                'constraints' => array(new Email(array("message" => "Please put a valid email")),)))
            ->add('status', ChoiceType::class, array(
                'label' => 'Vous êtes',
                'multiple' => false,
                'placeholder' => 'Sélectionnez',
                'choices' => array(
                    'Un Particulier' => 'particulier',
                    'Un Groupe' => 'groupe',
                    'Une Entreprise' => 'entreprise'
                )))
            ->add('subject', ChoiceType::class, array(
                'required' => true,
                'label' => 'Sujet',
                'multiple' => false,
                'placeholder' => false,
                'choices' => array(
                    'Inscription' => 'inscription',
                    'Karaté' => 'karate',
                    'Body Karaté' => 'body-karate',
                    'Coaching' => 'coaching',
                    'Demande de renseignement' => 'renseignement'
                )))
            ->add('content', TextareaType::class, array(
                'label' => 'Message',
            ))
            ->add('submit', SubmitType::class, array(
                'label' => 'Envoyer',
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'error_bubbling' => true
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_contact';
    }


}
