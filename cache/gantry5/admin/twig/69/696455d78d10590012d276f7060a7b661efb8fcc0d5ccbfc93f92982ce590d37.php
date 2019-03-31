<?php

/* forms/fields/textarea/textarea.html.twig */
class __TwigTemplate_1173ec161cd22c0be85265a18ef6b0acd896cf5b7c0d0e5126653dc8cb060a65 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'input' => array($this, 'block_input'),
            'reset_field' => array($this, 'block_reset_field'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return $this->loadTemplate((("forms/" . (((isset($context["layout"]) || array_key_exists("layout", $context))) ? (_twig_default_filter(($context["layout"] ?? null), "field")) : ("field"))) . ".html.twig"), "forms/fields/textarea/textarea.html.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_input($context, array $blocks = array())
    {
        // line 4
        echo "    <textarea
            ";
        // line 6
        echo "            name=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->fieldNameFilter((($context["scope"] ?? null) . ($context["name"] ?? null))), "html", null, true);
        echo "\"
            ";
        // line 8
        echo "            ";
        $this->displayBlock("global_attributes", $context, $blocks);
        echo "
            ";
        // line 10
        echo "            ";
        if (twig_in_filter($this->getAttribute(($context["field"] ?? null), "autofocus", array()), array(0 => "on", 1 => "true", 2 => 1))) {
            echo "autofocus=\"autofocus\"";
        }
        // line 11
        echo "            ";
        if ($this->getAttribute(($context["field"] ?? null), "cols", array(), "any", true, true)) {
            echo "cols=\"";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["field"] ?? null), "cols", array()), "html", null, true);
            echo "\"";
        }
        // line 12
        echo "            ";
        if (twig_in_filter($this->getAttribute(($context["field"] ?? null), "disabled", array()), array(0 => "on", 1 => "true", 2 => 1))) {
            echo "disabled=\"disabled\"";
        }
        // line 13
        echo "            ";
        if ($this->getAttribute(($context["field"] ?? null), "maxlength", array(), "any", true, true)) {
            echo "maxlength=\"";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["field"] ?? null), "maxlength", array()), "html", null, true);
            echo "\"";
        }
        // line 14
        echo "            ";
        if ($this->getAttribute(($context["field"] ?? null), "minlength", array(), "any", true, true)) {
            echo "minlength=\"";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["field"] ?? null), "minlength", array()), "html", null, true);
            echo "\"";
        }
        // line 15
        echo "            ";
        if ($this->getAttribute(($context["field"] ?? null), "placeholder", array(), "any", true, true)) {
            echo "placeholder=\"";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["field"] ?? null), "placeholder", array()), "html", null, true);
            echo "\"";
        }
        // line 16
        echo "            ";
        if (twig_in_filter($this->getAttribute(($context["field"] ?? null), "readonly", array()), array(0 => "on", 1 => "true", 2 => 1))) {
            echo "readonly=\"readonly\"";
        }
        // line 17
        echo "            ";
        if (twig_in_filter($this->getAttribute(($context["field"] ?? null), "required", array()), array(0 => "on", 1 => "true", 2 => 1))) {
            echo "required=\"required\"";
        }
        // line 18
        echo "            ";
        if ($this->getAttribute(($context["field"] ?? null), "rows", array(), "any", true, true)) {
            echo "rows=\"";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["field"] ?? null), "rows", array()), "html", null, true);
            echo "\"";
        }
        // line 19
        echo "            ";
        if (twig_in_filter($this->getAttribute(($context["field"] ?? null), "wrap", array()), array(0 => "hard", 1 => "soft"))) {
            echo "wrap=\"";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["field"] ?? null), "wrap", array()), "html", null, true);
            echo "\"";
        }
        // line 20
        echo "            >";
        echo twig_escape_filter($this->env, twig_join_filter(($context["value"] ?? null), "
"), "html", null, true);
        echo "</textarea>

    ";
        // line 22
        $this->displayBlock('reset_field', $context, $blocks);
    }

    public function block_reset_field($context, array $blocks = array())
    {
        $this->displayParentBlock("reset_field", $context, $blocks);
    }

    public function getTemplateName()
    {
        return "forms/fields/textarea/textarea.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  113 => 22,  106 => 20,  99 => 19,  92 => 18,  87 => 17,  82 => 16,  75 => 15,  68 => 14,  61 => 13,  56 => 12,  49 => 11,  44 => 10,  39 => 8,  34 => 6,  31 => 4,  28 => 3,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "forms/fields/textarea/textarea.html.twig", "C:\\wamp64\\www\\newlionsdla6\\administrator\\components\\com_gantry5\\templates\\forms\\fields\\textarea\\textarea.html.twig");
    }
}
