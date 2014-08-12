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
                ->add('titulo', 'text', array('label'=>'form.Noticia.titulo','attr' => array('class' => 'txt'), 'required' => false))
                ->add('contenido', 'textarea', array(
                    'attr' => array(
                        'class' => 'tinymce textArea',
                        'data-theme' => 'advanced',
                    ),
                    'required' => true,
                    'label' => false
                ))
                ->add('autor', 'text', array('label'=>'form.Noticia.autor','attr' => array('class' => 'txt'), 'required' => false))
                ->add('estado', 'choice', array(
                    'label'=>'form.Noticia.estado',
                    'choices' => array('1' => 'form.submit_publicar', '0' => 'form.submit_despublicar'),
                    'attr' => array('class' => 'txt')))
                ->add('resumen', 'textarea', array('label'=>'form.Noticia.resumen', 'attr' => array('class' => 'txtArea'), 'required' => false))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'RUGC\ProgramacionCatarsisBundle\Entity\Noticia',
            'translation_domain' => 'RUGCProgramacionCatarsisBundle'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'rugc_programacioncatarsisbundle_noticia';
    }

}
