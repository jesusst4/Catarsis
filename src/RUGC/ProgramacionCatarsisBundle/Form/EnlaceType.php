<?php

namespace RUGC\ProgramacionCatarsisBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EnlaceType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('descripcion', 'textarea', array('attr'=>array('class'=>'txtArea'), 'label'=>'form.Enlace.descripcion'))
            ->add('enlace', 'text', array('attr'=>array('class'=>'txt'), 'label'=>'form.Enlace.enlace'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RUGC\ProgramacionCatarsisBundle\Entity\Enlace',
            'translation_domain' => 'RUGCProgramacionCatarsisBundle'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'rugc_programacioncatarsisbundle_enlace';
    }
}
