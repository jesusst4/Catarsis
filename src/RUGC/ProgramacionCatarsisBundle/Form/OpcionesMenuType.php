<?php

namespace RUGC\ProgramacionCatarsisBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use \RUGC\ProgramacionCatarsisBundle\Entity\OpcionesMenuRepository;

class OpcionesMenuType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('menuPrincipal', 'entity', array(
                    'label' => 'form.Menu.menuPrincipal',
                    'required'=>TRUE,
                    'class' => 'RUGCProgramacionCatarsisBundle:OpcionesMenu',
                    'query_builder' =>
                    function(OpcionesMenuRepository $er) {
                            return $er->createQueryBuilder('om')
                                    ->orderBy('om.prioridad', 'ASC')
                                    ->where('om.menuPrincipal = 1')
                                    ->orWhere('om.menuPrincipal is null')
                                    ->andWhere("om.nombreOpcionEs != 'programacion:radio/tv'")
                                    ->andWhere("om.nombreOpcionEs != 'Administrar'")
                                    ;
            }))
                ->add('nombreOpcionEs','text',array('label' => 'form.Menu.nombreOpcionEs', 'required' => false,'attr' => array('class' => 'txt')))
                    ->add('nombreOpcionEn','text',array('label' => 'form.Menu.nombreOpcionEn', 'required' => false,'attr' => array('class' => 'txt')))
//                ->add('ruta','text',array('read_only' => true, 'required' => false,'attr' => array('class' => 'txt')))
                ->add('prioridad','text',array('label' => 'form.Menu.prioridad', 'required' => false,'attr' => array('class' => 'txt')))    
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'RUGC\ProgramacionCatarsisBundle\Entity\OpcionesMenu',
            'translation_domain' => 'RUGCProgramacionCatarsisBundle'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'rugc_programacioncatarsisbundle_opcionesmenu';
    }

}
