<?php

/* ::base.html.twig */
class __TwigTemplate_8488dd53ed521bde10ab54ab69a89014a0e2fde3518bf60ace942edddc7c7102 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'body' => array($this, 'block_body'),
            'javascripts' => array($this, 'block_javascripts'),
            'footer' => array($this, 'block_footer'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        ";
        // line 6
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 11
        echo "        <link rel=\"icon\" type=\"image/x-icon\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />

    <div class=\"divBanner\">        
    </div>

    <div id=\"menubar\">
        <ul id=\"menu\">
            <li><a href=\"";
        // line 18
        echo $this->env->getExtension('routing')->getPath("principal");
        echo "\" title=\"Texto\">CONOZCANOS</a></li>
            <li><a href=\"HabitacionView.php\" title=\"Texto\">PROGRAMACIÓN:RADIO/TV</a></li>
            <li><a href=\"";
        // line 20
        echo $this->env->getExtension('routing')->getPath("definiciones");
        echo "\" title=\"Texto\">DEFINICIONES</a></li>
            <li><a href=\"";
        // line 21
        echo $this->env->getExtension('routing')->getPath("grupos");
        echo "\" title=\"Texto\">GRUPOS NACIONALES</a></li>
            <li><a href=\"";
        // line 22
        echo $this->env->getExtension('routing')->getPath("grupos");
        echo "\" title=\"Texto\">GENERACIONES CATÁRTICAS</a></li>
            <li><a href=\"";
        // line 23
        echo $this->env->getExtension('routing')->getPath("grupos");
        echo "\" title=\"Texto\">NOTICIAS</a></li>
            <li><a href=\"";
        // line 24
        echo $this->env->getExtension('routing')->getPath("grupos");
        echo "\" title=\"Texto\">ENLACES RECOMENDADOS</a></li>
        </ul>
    </div>
</head>

<body>
    <div class=\"contenedor\">
        ";
        // line 31
        $this->displayBlock('body', $context, $blocks);
        // line 33
        echo "
        ";
        // line 34
        $this->displayBlock('javascripts', $context, $blocks);
        // line 36
        echo "  
        ";
        // line 37
        $this->displayBlock('footer', $context, $blocks);
        // line 41
        echo "    </div>
</body>

</html>
";
    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        echo "Grupo Catarsis";
    }

    // line 6
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 7
        echo "            ";
        if (isset($context['assetic']['debug']) && $context['assetic']['debug']) {
            // asset "d56196f_0"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_d56196f_0") : $this->env->getExtension('assets')->getAssetUrl("_controller/css/d56196f_part_1_baner_1.css");
            // line 8
            echo "            <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\" />
            ";
            // asset "d56196f_1"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_d56196f_1") : $this->env->getExtension('assets')->getAssetUrl("_controller/css/d56196f_part_1_contanedor_2.css");
            echo "            <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\" />
            ";
            // asset "d56196f_2"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_d56196f_2") : $this->env->getExtension('assets')->getAssetUrl("_controller/css/d56196f_part_1_menu_3.css");
            echo "            <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\" />
            ";
        } else {
            // asset "d56196f"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_d56196f") : $this->env->getExtension('assets')->getAssetUrl("_controller/css/d56196f.css");
            echo "            <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\" />
            ";
        }
        unset($context["asset_url"]);
        // line 10
        echo "        ";
    }

    // line 31
    public function block_body($context, array $blocks = array())
    {
        echo "           
        ";
    }

    // line 34
    public function block_javascripts($context, array $blocks = array())
    {
        // line 35
        echo "        ";
    }

    // line 37
    public function block_footer($context, array $blocks = array())
    {
        // line 38
        echo "            <div class=\"footer\">                
            </div>
        ";
    }

    public function getTemplateName()
    {
        return "::base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  159 => 38,  156 => 37,  152 => 35,  149 => 34,  142 => 31,  138 => 10,  112 => 8,  107 => 7,  104 => 6,  98 => 5,  90 => 41,  88 => 37,  85 => 36,  83 => 34,  80 => 33,  78 => 31,  68 => 24,  64 => 23,  60 => 22,  56 => 21,  52 => 20,  47 => 18,  36 => 11,  34 => 6,  30 => 5,  24 => 1,);
    }
}
