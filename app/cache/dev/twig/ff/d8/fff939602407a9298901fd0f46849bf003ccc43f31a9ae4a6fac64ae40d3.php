<?php

/* RUGCProgramacionCatarsisBundle:Static:GruposNacionales.html.twig */
class __TwigTemplate_ffd8fff939602407a9298901fd0f46849bf003ccc43f31a9ae4a6fac64ae40d3 extends Twig_Template
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
        echo "    <h1>GRUPOS NACIONALES</h1>

    <p>El siguiente es un listado de grupos costarricenses que, en mayor o menor grado, tenemos
        conocimiento han realizado m&uacute;sica progresiva en nuestro pa&iacute;s. En este sentido,
        sus estilos pueden ser propiamente rock progresivo, rock sinf&oacute;nico, jazz rock,
        m&uacute;sica electr&oacute;nica o rock experimental. El grupo Catarsis, agradece de 
        antemano cualquier informaci&oacute;n que podamos poner en cada uno de estos grupos. 
        Hacemos la aclaraci&oacute;n, en el sentido que este listado por el momento es limitado y 
        estamos realizando una labor de b&uacute;squeda para conocer la realidad de la m&uacute;sica 
        progresiva costarricense desde sus inicios hasta nuestros d&iacute;as. A continuaci&oacute;n
        presentamos las bandas o proyectos solistas que conocemos por el momento (en orden alfab&eacute;tico). 
        Algunas de ellas cuentan con alguna informaci&oacute;n por lo que est&aacute;n invitados a conocer
        nuestra producci&oacute;n nacional de m&uacute;sica progresiva. </p>

    <ul>          
        <li>Albatros (2001)</li>
        <li>Artavia S&aacute;nchez, Oscar (solista, 2001)</li>
        <li>Autoperro (1981 hasta la actualidad)</li>
        <li>Bruno Porter (199?)</li>
        <li>La Clase (199?)</li>
        <li>Contrasentido (2001)</li>
        <li>Editus (199? hasta la actualidad)</li>
        <li>Fern&aacute;ndez, Alvaro (1976 a la actualidad)</li>
        <li>Galer&iacute;a de sue&ntilde;os (19??)</li>
        <li>Hebra (1979, reformados en el 2003)</li>
        <li>Igni Ferroque (198?)</li>
        <li>Indigo (199?)</li>
        <li>Introvisi&oacute;n (2002)</li>
        <li>Nostro (2002)</li>
        <li>Polifon&iacute;a (19??)</li>
        <li>Shenuk (1982)</li>
        <li>Zimanyi, Antonio (198?-199?)</li>
    </ul> 

    <p>Notas:  Los años y otra informaci&oacute;n de los discos editados por los grupos, han sido transcritos por Mauricio Beeche dentro de su archivo de la colecci&oacute;n personal, en este sentido un 
        agradecimiento eterno.</p>
    
    <p>Colección privada de Giorgio Murillo, Arnaldo Rodríguez y Walter 
        Rodríguez, sea de portadas, afiches, entradas a conciertos y otros documentos presentados en estas p&aacute;ginas.</p>
";
    }

    public function getTemplateName()
    {
        return "RUGCProgramacionCatarsisBundle:Static:GruposNacionales.html.twig";
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
