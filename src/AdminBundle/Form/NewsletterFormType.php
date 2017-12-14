<?php

namespace AdminBundle\Form;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class NewsletterFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array('attr' => array('placeholder' => 'Your name'),
                                                 'constraints' => array(new NotBlank(array("message" => "Please provide your name")),)))
            ->add('subject', TextType::class, array('attr' => array('placeholder' => 'Subject'),
                                                    'constraints' => array(new NotBlank(array("message" => "Please give a Subject")),)))
            ->add('content', CKEditorType::class, array('attr' => array('placeholder' => 'Your message here'),
                                                        'constraints' => array(new NotBlank(array("message" => "Please provide a message here")),)))
            ->add('submit', SubmitType::class)
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
        return 'adminbundle_newsletterform';
    }
}