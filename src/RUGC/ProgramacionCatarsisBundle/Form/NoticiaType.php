<?php

namespace RUGC\ProgramacionCatarsisBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NoticiaType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('titulo', 'text', array('attr' => array('class' => 'txt'), 'required' => false))
                ->add('contenido', 'textarea', array(
                    'attr' => array(
                        'class' => 'tinymce textArea',
                        'data-theme' => 'advanced',
                    ),
                    'required' => true,
                    'label' => "|"
                ))
                ->add('autor', 'text', array('attr' => array('class' => 'txt'), 'required' => false))
                ->add('estado', 'choice', array(
                    'choices' => array('1' => 'Publicar', '0' => 'No publicar'),
                    'attr' => array('class' => 'txt')))
                ->add('resumen', 'textarea', array('attr' => array('class' => 'txtArea'), 'required' => false))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'RUGC\ProgramacionCatarsisBundle\Entity\Noticia'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'rugc_programacioncatarsisbundle_noticia';
    }

}
