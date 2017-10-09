<?php

namespace AppBundle\Form;

use AppBundle\Shop\CartItem;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CartItemType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder
            ->add('size', ChoiceType::class, array(
                'choices' => $options['product']->getType()->getSizes()->toArray(),
                'placeholder' => false,
                "choice_label" => "measurement",

            ))
            ->add('color', ChoiceType::class, array(
                'choices' => $options['product']->getColors(),
                'placeholder' => false,
                'choice_label' => 'name',

            ))
            ->add('quantity', ChoiceType::class, array(
                'choices' => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                )
            ))
            ->add('submit', SubmitType::class)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => CartItem::class,
            'product' => null
        ));


    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_cartitem';
    }


}
