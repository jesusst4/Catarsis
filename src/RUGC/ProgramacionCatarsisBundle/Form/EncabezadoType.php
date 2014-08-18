<?php

namespace RUGC\ProgramacionCatarsisBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EncabezadoType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('textoes', 'textarea', array(
                    'attr' => array(
                        'class' => 'tinymce textArea',
                        'data-theme' => 'advanced' // Skip it if you want to use default theme
                    ),
                    'required' => true,
                    'label' => false
                ))
                ->add('textoen', 'textarea', array(
                    'attr' => array(
                        'class' => 'tinymce textArea',
                        'data-theme' => 'advanced' // Skip it if you want to use default theme
                    ),
                    'required' => true,
                    'label' => false
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'RUGC\ProgramacionCatarsisBundle\Entity\Encabezado',
            'translation_domain' => 'RUGCProgramacionCatarsisBundle'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'rugc_programacioncatarsisbundle_encabezado';
    }

}
