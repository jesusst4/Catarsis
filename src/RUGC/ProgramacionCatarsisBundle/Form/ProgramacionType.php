<?php

namespace RUGC\ProgramacionCatarsisBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProgramacionType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('tipo', 'choice', array('choices' => array('1' => 'Radio', '2' => 'Televisión'), 'empty_value' => 'Seleccione tipo programción','attr' => array('class' => 'txt'), 'required' => false, 'label' => 'Tipo Programación'))
                ->add('fecha', 'date', array('attr' => array('class' => 'tcal txt'), 'label' => ' Fecha', 'input' => 'datetime', 'widget' => 'single_text', 'format' => 'dd-MM-yyyy', 'read_only' => 'true'), array('required' => false))
                ->add('titulo', 'text', array('attr' => array('class' => 'txt'), 'required' => false, 'label' => 'Artista ó Título'))
                ->add('obra', 'text', array('attr' => array('class' => 'txt'), 'required' => false, 'label' => 'Título de la  Obra'))
                ->add('descripcion', 'textarea', array('attr' => array('class' => 'txtArea'), 'required' => false, 'label' => 'Descripción'))
                ->add('imagen', 'file', array('required' => false, 'label' => 'Imágen'))
                ->add('enlace', 'text', array('attr' => array('class' => 'txt'), 'required' => false, 'label' => 'Enlace'))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'RUGC\ProgramacionCatarsisBundle\Entity\Programacion'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'rugc_programacioncatarsisbundle_programacion';
    }

}
