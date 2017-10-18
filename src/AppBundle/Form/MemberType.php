<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MemberType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastname')
            ->add('firstname')
            ->add('gender', ChoiceType::class, array('choices' => array(
                'Homme' => 'm',
                'Femme' => 'f'
            )))
            ->add('birthDate', BirthdayType::class)
            ->add('birthPlace')
            ->add('address')
            ->add('postalCode')
            ->add('city')
            ->add('phone')
            ->add('email')
            ->add('currentRank')
            ->add('practice', ChoiceType::class, array('choices' => array(
                'Loisir' => 'hobbies',
                'Compétition' => 'contest'
            )))
            ->add('weight')
            ->add('medCertProvided', CheckboxType::class, array(
                'required' => false
            ))
            ->add('imageRight', ChoiceType::class, array('choices' => array(
                'Accepter' => 'approve',
                'Refuser' => 'decline'
            )))
            ->add('payment', ChoiceType::class, array('choices' => array(
                'Espèces' => 'es',
                'Chèque' => 'ch'
            )))
            ->add('rulesAgree')
            ->add('contribution', ChoiceType::class, array('choices' => array(
                'Année ado et adulte - 200€' => 'ado et adulte',
                'Année enfant - 180€' => 'enfant',
                'Année jeune enfant - 150€' => 'jeune enfant',
                'Année body karaté - 170€' => 'body karate',
            )))
            ->add('information')
            ->add('submit', SubmitType::class)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Member'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_member';
    }


}
