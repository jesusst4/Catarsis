<?php

namespace RUGC\ProgramacionCatarsisBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProgramacionType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fecha','date',array('attr' => array('label' => 'Fecha de Salida', 'class' => 'tcal txt'), 'input' => 'datetime', 'widget' => 'single_text', 'format' => 'dd-MM-yyyy', 'read_only' => 'true'),array('required' => false))
            ->add('titulo','text',array('attr'=>array('class'=>'txt'),'required' => false))
            ->add('obra','text',array('attr'=>array('class'=>'txt'),'required' => false))
            ->add('descripcion','textarea',array('attr'=>array('class'=>'txtArea'),'required' => false))
            ->add('imagen','file',array('required' => false))
            ->add('enlace','text',array('attr'=>array('class'=>'txt'),'required' => false))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RUGC\ProgramacionCatarsisBundle\Entity\Programacion'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'rugc_programacioncatarsisbundle_programacion';
    }
}
