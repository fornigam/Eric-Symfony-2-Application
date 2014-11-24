<?php

namespace CelonSoftware\CommonBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LogType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('logdate')
            ->add('logdip')
            ->add('logurl')
            ->add('logcode')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CelonSoftware\CommonBundle\Entity\Log'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'celonsoftware_commonbundle_log';
    }
}
