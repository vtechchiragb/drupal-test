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

/* themes/custom/cas/templates/page/page.html.twig */
class __TwigTemplate_5539086c84c2c36e7c89bc42a20769fe extends Template
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
        // line 54
        echo "
";
        // line 55
        $this->loadTemplate("@cas/includes/header.html.twig", "themes/custom/cas/templates/page/page.html.twig", 55)->display($context);
        // line 56
        echo "
";
        // line 57
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "nav_main", [], "any", false, false, true, 57)) {
            // line 58
            echo "\t<div id=\"navigation-menu\">\t    
    <div class=\"container\">
\t      <div class=\"nav_main\">";
            // line 60
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "nav_main", [], "any", false, false, true, 60), 60, $this->source), "html", null, true);
            echo "</div>\t
\t </div>
  </div>
";
        }
        // line 64
        echo "


 ";
        // line 67
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "breadcrumb", [], "any", false, false, true, 67)) {
            // line 68
            echo "\t<div id=\"whole-breadcrumb\" class=\"container\">
\t\t<div id=\"breadcrumb\" class=\"clearfix\">";
            // line 69
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "page_title_area", [], "any", false, false, true, 69), 69, $this->source), "html", null, true);
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "breadcrumb", [], "any", false, false, true, 69), 69, $this->source), "html", null, true);
            echo "</div>
\t</div>
";
        }
        // line 72
        echo "
";
        // line 73
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "banner", [], "any", false, false, true, 73)) {
            // line 74
            echo "\t<div class=\"banner-area\">
\t\t";
            // line 75
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "banner", [], "any", false, false, true, 75), 75, $this->source), "html", null, true);
            echo "
\t</div>
";
        }
        // line 78
        echo "


<div id=\"maindiv\" class=\"container-fluid\">
\t<div id=\"main_content_area\" class=\"container\">

\t\t";
        // line 84
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_first", [], "any", false, false, true, 84)) {
            // line 85
            echo "\t\t\t<div id=\"sidebar_first_area\" class=\"column sidebar\">
\t\t\t\t";
            // line 86
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_first", [], "any", false, false, true, 86), 86, $this->source), "html", null, true);
            echo "
\t\t\t</div>
\t\t";
        }
        // line 89
        echo "
\t\t";
        // line 90
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "tools", [], "any", false, false, true, 90)) {
            // line 91
            echo "\t\t\t<div id=\"tools\" class=\"column tools\">
\t\t\t\t";
            // line 92
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "tools", [], "any", false, false, true, 92), 92, $this->source), "html", null, true);
            echo "
\t\t\t</div>
\t\t";
        }
        // line 95
        echo "\t\t
\t\t";
        // line 96
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "service_plan", [], "any", false, false, true, 96)) {
            // line 97
            echo "\t\t\t<div id=\"service_plan\" class=\"column service_plan\">
\t\t\t\t";
            // line 98
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "service_plan", [], "any", false, false, true, 98), 98, $this->source), "html", null, true);
            echo "
\t\t\t</div>
\t\t";
        }
        // line 101
        echo "
\t\t<div id=\"midcontent_area\" class=\"column main-content\">
\t\t\t<div id=\"content\">";
        // line 103
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "content", [], "any", false, false, true, 103), 103, $this->source), "html", null, true);
        echo "</div>
\t\t</div>

\t\t";
        // line 106
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_second", [], "any", false, false, true, 106)) {
            // line 107
            echo "\t\t\t<div id=\"sidebar_second_area\" class=\"column sidebar\">
\t\t\t\t";
            // line 108
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_second", [], "any", false, false, true, 108), 108, $this->source), "html", null, true);
            echo "
\t\t\t</div>
\t\t";
        }
        // line 111
        echo "\t</div>
</div>

";
        // line 114
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "breadcrumb_area", [], "any", false, false, true, 114)) {
            // line 115
            echo "\t<div id=\"whole-breadcrumb_area\" class=\"container-fluid\">
\t\t<div id=\"breadcrumb_area\" class=\"container\">";
            // line 116
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "page_title_area", [], "any", false, false, true, 116), 116, $this->source), "html", null, true);
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "breadcrumb_area", [], "any", false, false, true, 116), 116, $this->source), "html", null, true);
            echo "</div>
\t</div>
";
        }
        // line 119
        echo "
";
        // line 120
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "workplace_area", [], "any", false, false, true, 120)) {
            // line 121
            echo "\t<div id=\"our-workplace-area\" class=\"container-fluid\">
\t\t<div id=\"workplace_area\" class=\"container\">";
            // line 122
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "workplace_area", [], "any", false, false, true, 122), 122, $this->source), "html", null, true);
            echo "</div>
\t</div>
";
        }
        // line 125
        echo "
";
        // line 126
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "who_we_serve", [], "any", false, false, true, 126)) {
            // line 127
            echo "\t<div id=\"who_we_serve\">
\t\t";
            // line 128
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "who_we_serve", [], "any", false, false, true, 128), 128, $this->source), "html", null, true);
            echo "
\t</div>
";
        }
        // line 131
        echo "
";
        // line 132
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "secretariat_area", [], "any", false, false, true, 132)) {
            // line 133
            echo "\t<div id=\"crown-secretariat-area\" class=\"container-fluid\">
\t\t<div id=\"secretariat-area\" class=\"container\">";
            // line 134
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "secretariat_area", [], "any", false, false, true, 134), 134, $this->source), "html", null, true);
            echo "</div>
\t</div>
";
        }
        // line 137
        echo "
";
        // line 138
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "performance_area", [], "any", false, false, true, 138)) {
            // line 139
            echo "\t<div id=\"performance-report-area\" class=\"container-fluid\">
\t\t<div id=\"performance-area\" class=\"container\">";
            // line 140
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "performance_area", [], "any", false, false, true, 140), 140, $this->source), "html", null, true);
            echo "</div>
\t</div>
";
        }
        // line 143
        echo "
";
        // line 144
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "news_area", [], "any", false, false, true, 144)) {
            // line 145
            echo "\t<div id=\"latest-news-area\" class=\"container-fluid\">
\t\t<div id=\"news-area\" class=\"container\">";
            // line 146
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "news_area", [], "any", false, false, true, 146), 146, $this->source), "html", null, true);
            echo "</div>
\t</div>
";
        }
        // line 149
        echo "
";
        // line 150
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "news_letter_area", [], "any", false, false, true, 150)) {
            // line 151
            echo "\t<div id=\"news-letter-area\" class=\"container-fluid\">
\t\t<div id=\"news-letter\" class=\"container\">";
            // line 152
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "news_letter_area", [], "any", false, false, true, 152), 152, $this->source), "html", null, true);
            echo "</div>
\t</div>
";
        }
        // line 155
        echo "

";
        // line 157
        $this->loadTemplate("@cas/includes/footer.html.twig", "themes/custom/cas/templates/page/page.html.twig", 157)->display($context);
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["page"]);    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "themes/custom/cas/templates/page/page.html.twig";
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
        return array (  264 => 157,  260 => 155,  254 => 152,  251 => 151,  249 => 150,  246 => 149,  240 => 146,  237 => 145,  235 => 144,  232 => 143,  226 => 140,  223 => 139,  221 => 138,  218 => 137,  212 => 134,  209 => 133,  207 => 132,  204 => 131,  198 => 128,  195 => 127,  193 => 126,  190 => 125,  184 => 122,  181 => 121,  179 => 120,  176 => 119,  169 => 116,  166 => 115,  164 => 114,  159 => 111,  153 => 108,  150 => 107,  148 => 106,  142 => 103,  138 => 101,  132 => 98,  129 => 97,  127 => 96,  124 => 95,  118 => 92,  115 => 91,  113 => 90,  110 => 89,  104 => 86,  101 => 85,  99 => 84,  91 => 78,  85 => 75,  82 => 74,  80 => 73,  77 => 72,  70 => 69,  67 => 68,  65 => 67,  60 => 64,  53 => 60,  49 => 58,  47 => 57,  44 => 56,  42 => 55,  39 => 54,);
    }

    public function getSourceContext()
    {
        return new Source("", "themes/custom/cas/templates/page/page.html.twig", "C:\\xampp\\htdocs\\cas-drupal\\web\\themes\\custom\\cas\\templates\\page\\page.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("include" => 55, "if" => 57);
        static $filters = array("escape" => 60);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['include', 'if'],
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
