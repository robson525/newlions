<?php

/* @particles/menu.html.twig */
class __TwigTemplate_82fa2ed9fc77b631194436a0424fd87a8e722a291284a5acd51cc0cb2e80365d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        try {            // line 2
            $context["menu"] = $this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "menu", array()), "instance", array(0 => ($context["particle"] ?? null)), "method");
        } catch (\Exception $e) {
            if ($context['gantry']->debug()) throw $e;
            GANTRY_DEBUGGER && method_exists('Gantry\Debugger', 'addException') && \Gantry\Debugger::addException($e);
            $context['e'] = $e;
            // line 4
            echo "<div class=\"alert alert-error\">";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["e"] ?? null), "getMessage", array()), "html", null, true);
            echo "</div>
";
        }
        // line 6
        echo "
";
        // line 14
        echo "
";
        // line 23
        echo "
";
        // line 32
        echo "
";
        // line 84
        echo "
";
        // line 101
        echo "
";
        // line 109
        echo "
";
        // line 122
        echo "
";
        // line 123
        $context["macro"] = $this;
        // line 124
        echo "
";
        // line 125
        if ($this->getAttribute($this->getAttribute(($context["menu"] ?? null), "root", array()), "count", array(), "method")) {
            // line 126
            echo "<nav class=\"g-main-nav\" role=\"navigation\"";
            echo (($this->getAttribute(($context["particle"] ?? null), "mobileTarget", array())) ? (" data-g-mobile-target") : (""));
            echo " data-g-hover-expand=\"";
            echo (((($this->getAttribute(($context["particle"] ?? null), "hoverExpand", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute(($context["particle"] ?? null), "hoverExpand", array()), "true")) : ("true"))) ? ("true") : ("false"));
            echo "\">
    <ul class=\"g-toplevel\">
        ";
            // line 128
            echo $context["macro"]->getdisplayItems($this->getAttribute(($context["menu"] ?? null), "root", array()), ($context["menu"] ?? null), $context);
            echo "
    </ul>
</nav>
";
        }
    }

    // line 7
    public function getgetCustomWidth($__item__ = null, $__menu__ = null, $__mode__ = null, $__dropdown_type__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "item" => $__item__,
            "menu" => $__menu__,
            "mode" => $__mode__,
            "dropdown_type" => $__dropdown_type__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 8
            if ((((($this->getAttribute(($context["item"] ?? null), "width", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute(($context["item"] ?? null), "width", array()), "auto")) : ("auto")) != "auto") &&  !((($context["dropdown_type"] ?? null) == "fullwidth") && ($this->getAttribute(($context["item"] ?? null), "level", array()) > 1)))) {
                // line 9
                if ((($context["mode"] ?? null) == "item")) {
                    echo " style=\"position: relative;\"";
                } elseif ((                // line 10
($context["mode"] ?? null) == "submenu")) {
                    echo " style=\"width:";
                    echo twig_escape_filter($this->env, $this->getAttribute(($context["item"] ?? null), "width", array()), "html", null, true);
                    echo ";\" data-g-item-width=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute(($context["item"] ?? null), "width", array()), "html", null, true);
                    echo "\"";
                }
            }
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 15
    public function getdisplayParticle($__item__ = null, $__context__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "item" => $__item__,
            "context" => $__context__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 16
            echo "    ";
            $context["context"] = twig_array_merge(($context["context"] ?? null), array("particle" => $this->getAttribute($this->getAttribute(($context["item"] ?? null), "options", array()), "particle", array())));
            // line 17
            echo "    ";
            $context["classes"] = $this->getAttribute($this->getAttribute($this->getAttribute(($context["item"] ?? null), "options", array()), "block", array()), "class", array());
            // line 18
            echo "    <div class=\"menu-item-particle";
            echo twig_escape_filter($this->env, ((($context["classes"] ?? null)) ? ((" " . ($context["classes"] ?? null))) : ("")), "html", null, true);
            echo "\">
    ";
            // line 19
            try {
                $this->loadTemplate(array(0 => (("particles/" . $this->getAttribute(($context["item"] ?? null), "particle", array())) . ".html.twig"), 1 => (("@particles/" . $this->getAttribute(($context["item"] ?? null), "particle", array())) . ".html.twig")), "@particles/menu.html.twig", 19)->display(                // line 20
($context["context"] ?? null));
            } catch (Twig_Error_Loader $e) {
                // ignore missing template
            }

            // line 21
            echo "    </div>
";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 24
    public function getdisplayTitle($__item__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "item" => $__item__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 25
            echo "    ";
            if (( !$this->getAttribute(($context["item"] ?? null), "icon_only", array()) ||  !($this->getAttribute(($context["item"] ?? null), "image", array()) || $this->getAttribute(($context["item"] ?? null), "icon", array())))) {
                // line 26
                echo "        <span class=\"g-menu-item-title\">";
                echo twig_escape_filter($this->env, $this->getAttribute(($context["item"] ?? null), "title", array()), "html", null, true);
                echo "</span>
        ";
                // line 27
                if ($this->getAttribute(($context["item"] ?? null), "subtitle", array())) {
                    // line 28
                    echo "            <span class=\"g-menu-item-subtitle\">";
                    echo twig_escape_filter($this->env, $this->getAttribute(($context["item"] ?? null), "subtitle", array()), "html", null, true);
                    echo "</span>
        ";
                }
                // line 30
                echo "    ";
            }
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 33
    public function getdisplayItem($__item__ = null, $__menu__ = null, $__context__ = null, $__dropdown_type__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "item" => $__item__,
            "menu" => $__menu__,
            "context" => $__context__,
            "dropdown_type" => $__dropdown_type__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 34
            echo "    ";
            $context["self"] = $this;
            // line 35
            echo "    ";
            if ((($this->getAttribute(($context["item"] ?? null), "type", array()) == "particle") &&  !$this->getAttribute($this->getAttribute($this->getAttribute(($context["item"] ?? null), "options", array()), "particle", array()), "enabled", array()))) {
                echo " 
        ";
                // line 36
                $context["enabled"] = 0;
                // line 37
                echo "    ";
            }
            // line 38
            echo "    ";
            if ((($this->getAttribute(($context["item"] ?? null), "visible", array()) && $this->getAttribute(($context["item"] ?? null), "enabled", array())) && (((isset($context["enabled"]) || array_key_exists("enabled", $context))) ? (_twig_default_filter(($context["enabled"] ?? null), 1)) : (1)))) {
                // line 39
                echo "        ";
                $context["title"] = ((($this->getAttribute(($context["item"] ?? null), "icon_only", array()) || $this->getAttribute(($context["item"] ?? null), "link_title", array()))) ? (((" title=\"" . twig_escape_filter($this->env, (($this->getAttribute(($context["item"] ?? null), "link_title", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute(($context["item"] ?? null), "link_title", array()), $this->getAttribute(($context["item"] ?? null), "title", array()))) : ($this->getAttribute(($context["item"] ?? null), "title", array()))))) . "\"")) : (""));
                // line 40
                echo "        ";
                $context["label"] = ((($this->getAttribute(($context["item"] ?? null), "icon_only", array()) && ($this->getAttribute(($context["item"] ?? null), "image", array()) || $this->getAttribute(($context["item"] ?? null), "icon", array())))) ? (((" aria-label=\"" . twig_escape_filter($this->env, $this->getAttribute(($context["item"] ?? null), "title", array()))) . "\"")) : (""));
                // line 41
                echo "        ";
                $context["active"] = (($this->getAttribute(($context["menu"] ?? null), "isActive", array(0 => ($context["item"] ?? null)), "method")) ? (" active") : (""));
                // line 42
                echo "        ";
                $context["dropdown"] = ((($this->getAttribute(($context["item"] ?? null), "level", array()) == 1)) ? ((" g-" . $this->getAttribute(($context["item"] ?? null), "getDropdown", array(), "method"))) : (""));
                // line 43
                echo "        ";
                $context["parent"] = (($this->getAttribute(($context["item"] ?? null), "children", array())) ? (" g-parent") : (""));
                // line 44
                echo "        ";
                $context["target"] = (((($this->getAttribute(($context["item"] ?? null), "target", array()) != "_self") || $this->getAttribute($this->getAttribute(($context["context"] ?? null), "particle", array()), "forceTarget", array()))) ? (((" target=\"" . twig_escape_filter($this->env, $this->getAttribute(($context["item"] ?? null), "target", array()))) . "\"")) : (""));
                // line 45
                echo "        ";
                $context["rel"] = (($this->getAttribute(($context["item"] ?? null), "rel", array())) ? (((" rel=\"" . twig_escape_filter($this->env, $this->getAttribute(($context["item"] ?? null), "rel", array()))) . "\"")) : (""));
                // line 46
                echo "
        <li class=\"g-menu-item g-menu-item-type-";
                // line 47
                echo twig_escape_filter($this->env, $this->getAttribute(($context["item"] ?? null), "type", array()), "html", null, true);
                echo " g-menu-item-";
                echo twig_escape_filter($this->env, $this->getAttribute(($context["item"] ?? null), "id", array()), "html", null, true);
                if ( !$this->getAttribute(($context["item"] ?? null), "dropdown_hide", array())) {
                    echo twig_escape_filter($this->env, ($context["parent"] ?? null), "html", null, true);
                }
                echo twig_escape_filter($this->env, ($context["active"] ?? null), "html", null, true);
                echo twig_escape_filter($this->env, ($context["dropdown"] ?? null), "html", null, true);
                echo " ";
                if (($this->getAttribute(($context["item"] ?? null), "url", array()) && $this->getAttribute(($context["item"] ?? null), "children", array()))) {
                    if ( !$this->getAttribute(($context["item"] ?? null), "dropdown_hide", array())) {
                        echo "g-menu-item-link-parent";
                    }
                }
                echo " ";
                echo twig_escape_filter($this->env, (($this->getAttribute(($context["item"] ?? null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute(($context["item"] ?? null), "class", array()), "")) : ("")), "html", null, true);
                echo "\"";
                // line 48
                echo $context["self"]->getgetCustomWidth(($context["item"] ?? null), ($context["menu"] ?? null), "item", ($context["dropdown"] ?? null));
                // line 49
                if ((($this->getAttribute($this->getAttribute(($context["context"] ?? null), "particle", array(), "any", false, true), "renderTitles", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute(($context["context"] ?? null), "particle", array(), "any", false, true), "renderTitles", array()), 0)) : (0))) {
                    echo " title=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute(($context["item"] ?? null), "title", array()), "html", null, true);
                    echo "\"";
                }
                echo ">
            ";
                // line 50
                if ($this->getAttribute(($context["item"] ?? null), "url", array())) {
                    echo "<a class=\"g-menu-item-container";
                    echo twig_escape_filter($this->env, (($this->getAttribute(($context["item"] ?? null), "anchor_class", array())) ? ((" " . $this->getAttribute(($context["item"] ?? null), "anchor_class", array()))) : ("")), "html", null, true);
                    echo "\" href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute(($context["item"] ?? null), "url", array()), "html", null, true);
                    echo twig_escape_filter($this->env, $this->getAttribute(($context["item"] ?? null), "hash", array()), "html", null, true);
                    echo "\"";
                    echo (((($context["title"] ?? null) . ($context["label"] ?? null)) . ($context["target"] ?? null)) . ($context["rel"] ?? null));
                    echo ">
            ";
                } else {
                    // line 51
                    echo "<div class=\"g-menu-item-container";
                    echo twig_escape_filter($this->env, (($this->getAttribute(($context["item"] ?? null), "anchor_class", array())) ? ((" " . $this->getAttribute(($context["item"] ?? null), "anchor_class", array()))) : ("")), "html", null, true);
                    echo "\" data-g-menuparent=\"\"";
                    echo ($context["label"] ?? null);
                    echo ">";
                }
                // line 52
                echo "                ";
                if ($this->getAttribute(($context["item"] ?? null), "image", array())) {
                    // line 53
                    echo "                    <img src=\"";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->urlFunc($this->getAttribute(($context["item"] ?? null), "image", array())), "html", null, true);
                    echo "\" alt=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute(($context["item"] ?? null), "title", array()), "html", null, true);
                    echo "\" />
                ";
                } elseif ($this->getAttribute(                // line 54
($context["item"] ?? null), "icon", array())) {
                    // line 55
                    echo "                    <i class=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute(($context["item"] ?? null), "icon", array()), "html", null, true);
                    echo "\" aria-hidden=\"true\"></i>
                ";
                }
                // line 57
                echo "                ";
                if ($this->getAttribute(($context["item"] ?? null), "url", array())) {
                    // line 58
                    echo "                    <span class=\"g-menu-item-content\">
                        ";
                    // line 59
                    echo $context["self"]->getdisplayTitle(($context["item"] ?? null));
                    echo "
                    </span>
                    ";
                    // line 61
                    if (($this->getAttribute(($context["item"] ?? null), "children", array()) &&  !$this->getAttribute(($context["item"] ?? null), "dropdown_hide", array()))) {
                        // line 62
                        echo "<span class=\"g-menu-parent-indicator\" data-g-menuparent=\"\"></span>";
                    }
                    // line 64
                    echo "                ";
                } else {
                    // line 65
                    echo "                    ";
                    if (($this->getAttribute(($context["item"] ?? null), "type", array()) == "particle")) {
                        // line 66
                        echo "                        ";
                        echo $context["self"]->getdisplayParticle(($context["item"] ?? null), ($context["context"] ?? null));
                        echo "
                    ";
                    } elseif (($this->getAttribute(                    // line 67
($context["item"] ?? null), "type", array()) == "heading")) {
                        // line 68
                        echo "                        <span class=\"g-nav-header g-menu-item-content\"";
                        echo ($context["title"] ?? null);
                        echo ">";
                        echo $context["self"]->getdisplayTitle(($context["item"] ?? null));
                        echo "</span>
                    ";
                    } else {
                        // line 70
                        echo "                        <span class=\"g-separator g-menu-item-content\"";
                        echo ($context["title"] ?? null);
                        echo ">";
                        echo $context["self"]->getdisplayTitle(($context["item"] ?? null));
                        echo "</span>
                    ";
                    }
                    // line 72
                    echo "                        ";
                    if (($this->getAttribute(($context["item"] ?? null), "children", array()) &&  !$this->getAttribute(($context["item"] ?? null), "dropdown_hide", array()))) {
                        // line 73
                        echo "<span class=\"g-menu-parent-indicator\"></span>";
                    }
                    // line 75
                    echo "                ";
                }
                // line 76
                echo "            ";
                if ($this->getAttribute(($context["item"] ?? null), "url", array())) {
                    echo "</a>
            ";
                } else {
                    // line 77
                    echo "</div>";
                }
                // line 78
                echo "            ";
                if ($this->getAttribute(($context["item"] ?? null), "children", array())) {
                    // line 79
                    echo $context["self"]->getdisplaySubmenu(($context["item"] ?? null), ($context["menu"] ?? null), ($context["context"] ?? null), ($context["dropdown_type"] ?? null));
                }
                // line 81
                echo "        </li>
    ";
            }
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 85
    public function getdisplayContainers($__item__ = null, $__menu__ = null, $__context__ = null, $__dropdown_type__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "item" => $__item__,
            "menu" => $__menu__,
            "context" => $__context__,
            "dropdown_type" => $__dropdown_type__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 86
            echo "    ";
            $context["self"] = $this;
            // line 87
            echo "    <div class=\"g-grid\">
        ";
            // line 88
            $context["groups"] = ((($this->getAttribute(($context["item"] ?? null), "getDropdown", array(), "method") == "standard")) ? (array(0 => ($context["item"] ?? null))) : ($this->getAttribute(($context["item"] ?? null), "groups", array())));
            // line 89
            echo "        ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["groups"] ?? null));
            foreach ($context['_seq'] as $context["column"] => $context["items"]) {
                // line 90
                echo "        <div class=\"g-block ";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('toGrid')->getCallable(), array($this->getAttribute(($context["item"] ?? null), "columnWidth", array(0 => $context["column"]), "method"))), "html", null, true);
                echo "\">
            <ul class=\"g-sublevel\">
                <li class=\"g-level-";
                // line 92
                echo twig_escape_filter($this->env, $this->getAttribute(($context["item"] ?? null), "level", array()), "html", null, true);
                echo " g-go-back\">
                    <a class=\"g-menu-item-container\" href=\"#\" data-g-menuparent=\"\"><span>Back</span></a>
                </li>
                ";
                // line 95
                echo $context["self"]->getdisplayItems($context["items"], ($context["menu"] ?? null), ($context["context"] ?? null), ($context["dropdown_type"] ?? null));
                echo "
            </ul>
        </div>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['column'], $context['items'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 99
            echo "    </div>
";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 102
    public function getdisplayItems($__items__ = null, $__menu__ = null, $__context__ = null, $__dropdown_type__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "items" => $__items__,
            "menu" => $__menu__,
            "context" => $__context__,
            "dropdown_type" => $__dropdown_type__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 103
            echo "    ";
            $context["self"] = $this;
            // line 104
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 105
                echo "        ";
                if (($this->getAttribute($context["item"], "level", array()) == 1)) {
                    $context["dropdown_type"] = $this->getAttribute($context["item"], "dropdown", array());
                }
                // line 106
                echo "        ";
                echo $context["self"]->getdisplayItem($context["item"], ($context["menu"] ?? null), ($context["context"] ?? null), ($context["dropdown_type"] ?? null));
                echo "
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 110
    public function getdisplaySubmenu($__item__ = null, $__menu__ = null, $__context__ = null, $__dropdown_type__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "item" => $__item__,
            "menu" => $__menu__,
            "context" => $__context__,
            "dropdown_type" => $__dropdown_type__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 111
            echo "    ";
            $context["self"] = $this;
            // line 112
            echo "    ";
            if ( !$this->getAttribute(($context["item"] ?? null), "dropdown_hide", array())) {
                // line 113
                echo "        ";
                $context["animation"] = (($this->getAttribute($this->getAttribute($this->getAttribute(($context["context"] ?? null), "gantry", array(), "any", false, true), "config", array(), "any", false, true), "get", array(0 => "styles.menu.animation"), "method", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute($this->getAttribute(($context["context"] ?? null), "gantry", array(), "any", false, true), "config", array(), "any", false, true), "get", array(0 => "styles.menu.animation"), "method"), "g-fade")) : ("g-fade"));
                // line 114
                echo "        ";
                if (((((twig_length_filter($this->env, $this->getAttribute(($context["item"] ?? null), "groups", array())) == 1) && ( !($context["dropdown_type"] ?? null) == "fullwidth")) || (($context["dropdown_type"] ?? null) == "standard")) || (((($this->getAttribute(($context["item"] ?? null), "width", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute(($context["item"] ?? null), "width", array()), "auto")) : ("auto")) != "auto") && (($context["dropdown_type"] ?? null) == "fullwidth")))) {
                    $context["dropdown_dir"] = ("g-dropdown-" . (($this->getAttribute(($context["item"] ?? null), "dropdown_dir", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute(($context["item"] ?? null), "dropdown_dir", array()), "right")) : ("right")));
                }
                // line 115
                echo "        <ul class=\"g-dropdown g-inactive ";
                echo twig_escape_filter($this->env, ($context["animation"] ?? null), "html", null, true);
                echo " ";
                echo twig_escape_filter($this->env, ($context["dropdown_dir"] ?? null), "html", null, true);
                echo "\"";
                echo $context["self"]->getgetCustomWidth(($context["item"] ?? null), ($context["menu"] ?? null), "submenu", ($context["dropdown_type"] ?? null));
                echo ">
            <li class=\"g-dropdown-column\">
                ";
                // line 117
                echo $context["self"]->getdisplayContainers(($context["item"] ?? null), ($context["menu"] ?? null), ($context["context"] ?? null), ($context["dropdown_type"] ?? null));
                echo "
            </li>
        </ul>
    ";
            }
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    public function getTemplateName()
    {
        return "@particles/menu.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  575 => 117,  565 => 115,  560 => 114,  557 => 113,  554 => 112,  551 => 111,  536 => 110,  514 => 106,  509 => 105,  504 => 104,  501 => 103,  486 => 102,  470 => 99,  460 => 95,  454 => 92,  448 => 90,  443 => 89,  441 => 88,  438 => 87,  435 => 86,  420 => 85,  403 => 81,  400 => 79,  397 => 78,  394 => 77,  388 => 76,  385 => 75,  382 => 73,  379 => 72,  371 => 70,  363 => 68,  361 => 67,  356 => 66,  353 => 65,  350 => 64,  347 => 62,  345 => 61,  340 => 59,  337 => 58,  334 => 57,  328 => 55,  326 => 54,  319 => 53,  316 => 52,  309 => 51,  297 => 50,  289 => 49,  287 => 48,  269 => 47,  266 => 46,  263 => 45,  260 => 44,  257 => 43,  254 => 42,  251 => 41,  248 => 40,  245 => 39,  242 => 38,  239 => 37,  237 => 36,  232 => 35,  229 => 34,  214 => 33,  198 => 30,  192 => 28,  190 => 27,  185 => 26,  182 => 25,  170 => 24,  154 => 21,  148 => 20,  146 => 19,  141 => 18,  138 => 17,  135 => 16,  122 => 15,  100 => 10,  97 => 9,  95 => 8,  80 => 7,  71 => 128,  63 => 126,  61 => 125,  58 => 124,  56 => 123,  53 => 122,  50 => 109,  47 => 101,  44 => 84,  41 => 32,  38 => 23,  35 => 14,  32 => 6,  26 => 4,  20 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@particles/menu.html.twig", "C:\\wamp64\\www\\newlionsdla6\\media\\gantry5\\engines\\nucleus\\particles\\menu.html.twig");
    }
}
