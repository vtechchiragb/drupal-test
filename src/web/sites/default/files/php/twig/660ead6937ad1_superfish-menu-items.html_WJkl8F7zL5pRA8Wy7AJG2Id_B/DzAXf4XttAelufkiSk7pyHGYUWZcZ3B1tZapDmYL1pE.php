<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* modules/contrib/superfish/templates/superfish-menu-items.html.twig */
class __TwigTemplate_7231d2a76af369ff632643e65b68018a extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 21
        echo "
";
        // line 22
        $context["classes"] = [];
        // line 23
        ob_start(function () { return ''; });
        // line 24
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["menu_items"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 25
            echo "
  ";
            // line 26
            if ( !twig_test_empty(twig_get_attribute($this->env, $this->source, $context["item"], "children", [], "any", false, false, true, 26))) {
                // line 27
                echo "    ";
                $context["item_class"] = ($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["item"], "item_class", [], "any", false, false, true, 27), 27, $this->source) . " menuparent");
                // line 28
                echo "    ";
                if (twig_get_attribute($this->env, $this->source, $context["item"], "multicolumn_column", [], "any", false, false, true, 28)) {
                    // line 29
                    echo "      ";
                    $context["item_class"] = ($this->sandbox->ensureToStringAllowed(($context["item_class"] ?? null), 29, $this->source) . " sf-multicolumn-column");
                    // line 30
                    echo "    ";
                }
                // line 31
                echo "  ";
            }
            // line 32
            echo "
  <li";
            // line 33
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["item"], "attributes", [], "any", false, false, true, 33), 33, $this->source), "html", null, true);
            echo ">
    ";
            // line 34
            if (twig_get_attribute($this->env, $this->source, $context["item"], "multicolumn_column", [], "any", false, false, true, 34)) {
                // line 35
                echo "    <div class=\"sf-multicolumn-column\">
    ";
            }
            // line 37
            echo "    ";
            if ( !twig_test_empty(twig_get_attribute($this->env, $this->source, $context["item"], "children", [], "any", false, false, true, 37))) {
                // line 38
                echo "      ";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["item"], "link_menuparent", [], "any", false, false, true, 38), 38, $this->source), "html", null, true);
                echo "
    ";
            } else {
                // line 40
                echo "      ";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, true, 40), 40, $this->source), "html", null, true);
                echo "
    ";
            }
            // line 42
            echo "    ";
            if (twig_get_attribute($this->env, $this->source, $context["item"], "multicolumn_wrapper", [], "any", false, false, true, 42)) {
                echo "<ul class=\"sf-multicolumn\">
    <li class=\"sf-multicolumn-wrapper ";
                // line 43
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["item"], "item_class", [], "any", false, false, true, 43), 43, $this->source), "html", null, true);
                echo "\">
    ";
            }
            // line 45
            echo "    ";
            if ( !twig_test_empty(twig_get_attribute($this->env, $this->source, $context["item"], "children", [], "any", false, false, true, 45))) {
                // line 46
                echo "      ";
                if (twig_get_attribute($this->env, $this->source, $context["item"], "multicolumn_content", [], "any", false, false, true, 46)) {
                    echo "<ol>";
                } else {
                    echo "<ul>";
                }
                // line 47
                echo "      ";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["item"], "children", [], "any", false, false, true, 47), 47, $this->source), "html", null, true);
                echo "
      ";
                // line 48
                if (twig_get_attribute($this->env, $this->source, $context["item"], "multicolumn_content", [], "any", false, false, true, 48)) {
                    echo "</ol>";
                } else {
                    echo "</ul>";
                }
                // line 49
                echo "    ";
            }
            // line 50
            echo "    ";
            if (twig_get_attribute($this->env, $this->source, $context["item"], "multicolumn_wrapper", [], "any", false, false, true, 50)) {
                echo "</li></ul>";
            }
            // line 51
            echo "    ";
            if (twig_get_attribute($this->env, $this->source, $context["item"], "multicolumn_column", [], "any", false, false, true, 51)) {
                echo "</div>";
            }
            // line 52
            echo "  </li>

";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        $___internal_parse_1_ = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 23
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(twig_spaceless($___internal_parse_1_));
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["menu_items"]);    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "modules/contrib/superfish/templates/superfish-menu-items.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable()
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo()
    {
        return array (  151 => 23,  142 => 52,  137 => 51,  132 => 50,  129 => 49,  123 => 48,  118 => 47,  111 => 46,  108 => 45,  103 => 43,  98 => 42,  92 => 40,  86 => 38,  83 => 37,  79 => 35,  77 => 34,  73 => 33,  70 => 32,  67 => 31,  64 => 30,  61 => 29,  58 => 28,  55 => 27,  53 => 26,  50 => 25,  46 => 24,  44 => 23,  42 => 22,  39 => 21,);
    }

    public function getSourceContext()
    {
        return new Source("", "modules/contrib/superfish/templates/superfish-menu-items.html.twig", "C:\\xampp\\htdocs\\cas-drupal\\web\\modules\\contrib\\superfish\\templates\\superfish-menu-items.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 22, "apply" => 23, "for" => 24, "if" => 26);
        static $filters = array("escape" => 33, "spaceless" => 23);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['set', 'apply', 'for', 'if'],
                ['escape', 'spaceless'],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
