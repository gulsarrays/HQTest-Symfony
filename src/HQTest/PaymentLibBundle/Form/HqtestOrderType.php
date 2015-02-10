<?php

namespace HQTest\PaymentLibBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class HqtestOrderType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('customerName')
            ->add('cardHolderName')
            ->add('cardNumber')
            ->add('cardType')
            ->add('cardExpiry')
            ->add('cardCvv')
            ->add('paymentCurrency')
            ->add('paymentGateway')
            ->add('transactionId')
            ->add('orderStatus')
            ->add('orderAmount')
            ->add('orderCreatedTime')
            ->add('transactionResponse')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'HQTest\PaymentLibBundle\Entity\HqtestOrder'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'hqtest_paymentlibbundle_hqtestorder';
    }
}
