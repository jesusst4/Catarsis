<?php

/* RUGCProgramacionCatarsisBundle:Static:Conozcanos.html.twig */
class __TwigTemplate_3b857f60244029421b7b38eeaf3a111e765ad805237432fc389263ad412d5aad extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("::base.html.twig");

        $this->blocks = array(
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        // line 4
        echo "<h1>GENERACIONES CATARTICAS </h1>
    <p>
        Han sido varias las generaciones presentes en la producción de programación 
        de Catarsis a lo largo de estos 29 años de labores ininterrumpidas. Las razones
        de estos cambios son varias desde razones familiares y/o laborales hasta posibilidades
        de estudio en el exterior de algunos de estos amigos catárticos. Durante la Celebración 
        del 25 aniversario de Catarsis, llegaron parte de los antiguos colegas que colaboraron para
        que esta agrupación pudiera llegar a ser lo que es hoy en día.

    </p>
    <p>
        La primera generación, estaba constituida por Alvaro Artavia, Daniel Aguilar, Eric Guevara
        y Jorge \"Botonetas\" Arias.
    </p>

    <p>
        La segunda generación, fue una especie de transición con Eric Guevara , Francisco \"Cachorro\"
        Aguilar, Rodolfo Soto y Johnny Schroeder.
    </p>

    <p>
        La tercera generación, la constituyeron Nelson Brenes, Walter Rodriguez, Ignacio \"Nacho\" Trejos,
        Marvin Gonzalez y Luis Campabadal. 
    </p>

    <p>
        La cuarta generación la constituyeron Rafael Gonzalez, Walter Rodriguez, Marvin Gonzalez, Eduardo Quiros.  
    </p>

    <p>
        La quinta generación estaba constituida por Giorgio Murillo, Francisco Aguilar, Freddy \"Fripp\" Mora, Federico 
        \"Zappa\" Mata y Arnaldo Rodriguez. Se encuentran también Alejandra Morales Quesada, Ivonne Brenes y nuestro
        \"guru espiritual\" por muchos años Rafael González. 
    </p>

    <p>
        La quinta generación aumentada, se constituye con la base de la anterior y se introducen las colaboraciones de 
        Mauricio Beeche, Sergio Quesada, Ricardo Aguilar, Boris Shosinsky, Jesús Peraza, Ricardo Hoss y Alfredo Chirino..
    </p>
";
    }

    public function getTemplateName()
    {
        return "RUGCProgramacionCatarsisBundle:Static:Conozcanos.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  31 => 4,  28 => 3,);
    }
}
