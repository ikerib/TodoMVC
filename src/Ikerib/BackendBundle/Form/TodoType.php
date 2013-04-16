<?php

namespace Ikerib\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TodoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('completed')
            ->add('todo','text',array(
                'label' => ' ',
                'attr' => array (
                    'placeholder' => 'What needs to be done?',
                    'id' => 'new-todo'
                )))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ikerib\BackendBundle\Entity\Todo'
        ));
    }

    public function getName()
    {
        return 'ikerib_backendbundle_todotype';
    }
}
