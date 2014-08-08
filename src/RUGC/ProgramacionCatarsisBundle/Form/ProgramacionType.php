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
                ->add('tipo', 'choice', array('choices' => array('1' => 'Radio', '2' => 'Televisión'), 'empty_value' => 'Seleccione el tipo de programación','attr' => array('class' => 'txt'), 'required' => false, 'label' => 'form.Programacion.tipo'))
                ->add('fecha', 'date', array('attr' => array('class' => 'tcal txt'), 'label' => 'form.Programacion.fecha', 'input' => 'datetime', 'widget' => 'single_text', 'format' => 'dd-MM-yyyy', 'read_only' => 'true'), array('required' => false))
                ->add('titulo', 'text', array('attr' => array('class' => 'txt'), 'required' => false, 'label' => 'form.Programacion.titulo'))
                ->add('obra', 'text', array('attr' => array('class' => 'txt'), 'required' => false, 'label' => 'form.Programacion.obra'))
                ->add('descripcion', 'textarea', array('attr' => array('class' => 'txtArea'), 'required' => false, 'label' => 'form.Programacion.descripcion'))
                ->add('imagen', 'file', array('required' => false, 'label' => 'form.Programacion.imagen'))
                ->add('enlace', 'text', array('attr' => array('class' => 'txt'), 'required' => false, 'label' => 'form.Programacion.enlace'))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'RUGC\ProgramacionCatarsisBundle\Entity\Programacion',
            'translation_domain' => 'RUGCProgramacionCatarsisBundle'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'rugc_programacioncatarsisbundle_programacion';
    }

}
