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
        if ((twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_top", [], "any", false, false, true, 9) && twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_bottom", [], "any", false, false, true, 9))) {
            // line 10
            echo "<div class=\"footer-wrapper\">

  <div class=\"footer\">
  <div class=\"container\">
    <div class=\"row\">
       ";
            // line 15
            if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_top", [], "any", false, false, true, 15)) {
                // line 16
                echo "       <div class=\"col-sm-12 footer-top\">";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_top", [], "any", false, false, true, 16), 16, $this->source), "html", null, true);
                echo "</div>
       ";
            }
            // line 18
            echo "       ";
            // line 21
            echo "    </div>
    </div>
    ";
            // line 23
            if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_bottom", [], "any", false, false, true, 23)) {
                // line 24
                echo "       <div class=\"container\">
       <div class=\"footer-bottom\">";
                // line 25
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_bottom", [], "any", false, false, true, 25), 25, $this->source), "html", null, true);
                echo "</div>
       </div>
    ";
            }
            // line 28
            echo "  </div>

</div>
";
        }
        // line 32
        echo "
";
        // line 33
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_login", [], "any", false, false, true, 33)) {
            // line 34
            echo "<div class=\"footer-logo-wrapper\">
<div class=\"container\">
       <div class=\"footer-login\">";
            // line 36
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_login", [], "any", false, false, true, 36), 36, $this->source), "html", null, true);
            echo "</div>
       </div>
</div>
";
        }
        // line 40
        echo "


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
        return array (  95 => 40,  88 => 36,  84 => 34,  82 => 33,  79 => 32,  73 => 28,  67 => 25,  64 => 24,  62 => 23,  58 => 21,  56 => 18,  50 => 16,  48 => 15,  41 => 10,  39 => 9,);
    }

    public function getSourceContext()
    {
        return new Source("", "@cas/includes/footer.html.twig", "C:\\xampp\\htdocs\\cas-drupal\\web\\themes\\custom\\cas\\templates\\includes\\footer.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 9);
        static $filters = array("escape" => 16);
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
