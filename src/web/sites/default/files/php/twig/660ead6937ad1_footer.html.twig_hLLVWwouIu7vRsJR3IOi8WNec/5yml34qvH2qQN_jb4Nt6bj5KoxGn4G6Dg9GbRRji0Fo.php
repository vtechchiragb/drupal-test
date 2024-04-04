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

/* @cas/includes/footer.html.twig */
class __TwigTemplate_7a013d767b1a4f4edffcc915bd7bccfd extends Template
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
        // line 9
        echo "<div class=\"footer-wrapper\">

  <div class=\"footer\">
  <div class=\"container\">
    <div class=\"row footer-top\">
       ";
        // line 14
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_left", [], "any", false, false, true, 14)) {
            // line 15
            echo "       <div class=\"col-sm-6 footer-left\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_left", [], "any", false, false, true, 15), 15, $this->source), "html", null, true);
            echo "</div>
       ";
        }
        // line 17
        echo "       ";
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_right", [], "any", false, false, true, 17)) {
            // line 18
            echo "       <div class=\"col-sm-6 footer-right\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_right", [], "any", false, false, true, 18), 18, $this->source), "html", null, true);
            echo "</div>
       ";
        }
        // line 20
        echo "    </div>
    </div>
    ";
        // line 22
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_bottom", [], "any", false, false, true, 22)) {
            // line 23
            echo "       <div class=\"container\">
       <div class=\"footer-bottom\">";
            // line 24
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_bottom", [], "any", false, false, true, 24), 24, $this->source), "html", null, true);
            echo "</div>
       </div>
    ";
        }
        // line 27
        echo "  </div>

</div>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["page"]);    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@cas/includes/footer.html.twig";
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
        return array (  78 => 27,  72 => 24,  69 => 23,  67 => 22,  63 => 20,  57 => 18,  54 => 17,  48 => 15,  46 => 14,  39 => 9,);
    }

    public function getSourceContext()
    {
        return new Source("", "@cas/includes/footer.html.twig", "C:\\xampp\\htdocs\\cas-drupal\\web\\themes\\custom\\cas\\templates\\includes\\footer.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 14);
        static $filters = array("escape" => 15);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['if'],
                ['escape'],
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
