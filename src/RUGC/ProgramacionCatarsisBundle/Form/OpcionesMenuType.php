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
                    'required'=>TRUE,
                    'class' => 'RUGCProgramacionCatarsisBundle:OpcionesMenu',
                    'query_builder' =>
                    function(OpcionesMenuRepository $er) {
                            return $er->createQueryBuilder('om')
                                    ->orderBy('om.prioridad', 'ASC')
                                    ->where('om.menuPrincipal = 1')
                                    ->orWhere('om.menuPrincipal is null')
                                    ->andWhere("om.nombreOpcion != 'programacion:radio/tv'")
                                    ->andWhere("om.nombreOpcion != 'Administrar'")
                                    ;
            }))
                ->add('nombreOpcion','text',array( 'required' => false,'attr' => array('class' => 'txt')))
                ->add('ruta','text',array( 'required' => false,'attr' => array('class' => 'txt')))
                ->add('prioridad','text',array( 'required' => false,'attr' => array('class' => 'txt')))    
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'RUGC\ProgramacionCatarsisBundle\Entity\OpcionesMenu'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'rugc_programacioncatarsisbundle_opcionesmenu';
    }

}
