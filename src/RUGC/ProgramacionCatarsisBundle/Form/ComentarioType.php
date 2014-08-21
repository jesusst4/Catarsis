<?php

namespace RUGC\ProgramacionCatarsisBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ComentarioType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('correo', 'text', array('attr' => array('class' => 'txt'), 'required' => false, 'label' => 'form.Comentario.correo'))
                ->add('nombre', 'text', array('attr' => array('class' => 'txt'), 'required' => false, 'label' => 'form.Comentario.nombre'))
                ->add('comentario', 'textarea', array('attr' => array('class' => 'txtArea'), 'required' => false, 'label' => 'form.Comentario.comentario'))
                ->add('captcha', 'captcha', array(
                    'required' => false,
                    'width' => 100,
                    'height' => 50,
                    'length' => 5,
                    'as_url' => true,
                    'reload' => '/generate-captcha/1',
                    'keep_value' => false,
                    'invalid_message' => 'validaciones.captcha.invalid'
        ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'RUGC\ProgramacionCatarsisBundle\Entity\Comentario',
            'translation_domain' => 'RUGCProgramacionCatarsisBundle'
            
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'rugc_programacioncatarsisbundle_comentario';
    }

}