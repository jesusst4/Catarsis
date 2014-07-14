<?php

/* RUGCProgramacionCatarsisBundle:Static:Definiciones.html.twig */
class __TwigTemplate_920e4e41f28b3e9b4d51f715971de70a9e599ea2d4e0c08dac0fe122c9b36fe2 extends Twig_Template
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
        echo "    <h1>
        DEFINICIONES
    </h1>
    <h2>
        Conceptos Catárticos
    </h2>

    <p> Como documento histórico es el texto que a continuación les presentaremos, con el cual se resume
        relativamente bien la forma de pensar y de definir el género de Rock Progresivo y sus diferentes
        facetas por parte del Grupo Catarsis. Este documento fue distribuido en una conferencia, realizada
        durante una Semana Universitaria de la Universidad de Costa Rica, por esta agrupación en el año
        de 1982 el cual transcribimos el texto presentado en esta ocasión (con leves modificaciones).</p>
    
    <p>Estimado lector, le agradecemos el que lo lea y recuerde que esta es una forma simple y sencilla
        para una definición de un género musical que se ha expandido a lo largo y ancho de todo el mundo
        y ha superado las fronteras y los límites de la imaginación humana. Tanto desde el punto de vista
        musical como del conceptual. A continuación dicho texto: </p>
    <p>
        La música progresiva aparece en Europa y los Estados Unidos en la segunda mitad de
        la década de los 60. Fue parte de una gran cantidad de manifestaciones culturales y sociales de
        los jóvenes de esos países que empezaban a adquirir conciencia de su posición como grupo diferenciado. Fue parte
        de las búsquedas de esa juventud en pos de una nueva identidad propia y autónoma que les
        permitiese particiar más activamente, específicamente en el campo artístico.</p>
    
    <p>Algunos músicos que se dedicaban al rock participaron de todo éste espíritu renovador y buscaron
        enriquecer su música tomando elementos artísticos y conceptuales pertenecientes a culturas
        foráneas o a manifestaciones artísticas de tradición occidental, pero que carecían de relación con la
        música popular juvenil. (Por ejemplo, religiones orientales, música orquestal clásica, folclore).</p>
    
    <p>En el desarrollo de sus esfuerzos los músicos del campo progresivo incorporaron numerosos
        adelantos de la tecnología de la producción y grabación musicales, que necesitaban para la
        elaboración de composiciones de creciente complejidad. En este aspecto el aporte de la música
        progresiva ha sido de una gran importancia, pues ha abierto toda una serie de amplias posibilidades
        para la experimentación y la elaboración de la música.</p>
";
    }

    public function getTemplateName()
    {
        return "RUGCProgramacionCatarsisBundle:Static:Definiciones.html.twig";
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
