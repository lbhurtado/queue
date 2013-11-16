<?php

namespace Applester\QueueBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class QueueType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mobile')
            ->add('handle')
            ->add('date')
            ->add('remarks')
            ->add('slot')
            ->add('business')
            ->add('window')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Applester\QueueBundle\Entity\Queue'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'applester_queuebundle_queue';
    }
}
