<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AntispamButtonType
 *
 * @author gvasquez
 */
class AntispamButtonType extends AbstractType
{
    protected $params;

    public function __construct(array $params)
    {
        $this->params = $params;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'choices'  => array(
                $this->params['bad']  => 'do.not.add.comment',
                $this->params['good'] => 'add.comment'
            ),
        ));
    }

    // ...
}
