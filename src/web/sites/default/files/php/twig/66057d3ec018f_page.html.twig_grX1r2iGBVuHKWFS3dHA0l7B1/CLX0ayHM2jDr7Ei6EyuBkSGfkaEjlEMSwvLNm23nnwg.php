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
class __TwigTemplate_1e9d84cc126930ca919c2a6845c502a0 extends Template
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
        // line 65
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "banner", [], "any", false, false, true, 65)) {
            // line 66
            echo "\t<div class=\"banner-area\">
\t\t";
            // line 67
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "banner", [], "any", false, false, true, 67), 67, $this->source), "html", null, true);
            echo "
\t</div>
";
        }
        // line 70
        echo "
<div id=\"maindiv\" class=\"container-fluid\">
\t<div id=\"main_content_area\" class=\"container\">

\t\t";
        // line 74
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_first", [], "any", false, false, true, 74)) {
            // line 75
            echo "\t\t\t<div id=\"sidebar_first_area\" class=\"column sidebar\">
\t\t\t\t";
            // line 76
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_first", [], "any", false, false, true, 76), 76, $this->source), "html", null, true);
            echo "
\t\t\t</div>
\t\t";
        }
        // line 79
        echo "
\t\t<div id=\"midcontent_area\" class=\"column main-content\">
\t\t\t<div id=\"content\">";
        // line 81
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "content", [], "any", false, false, true, 81), 81, $this->source), "html", null, true);
        echo "</div>
\t\t</div>

\t\t";
        // line 84
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_second", [], "any", false, false, true, 84)) {
            // line 85
            echo "\t\t\t<div id=\"sidebar_second_area\" class=\"column sidebar\">
\t\t\t\t";
            // line 86
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_second", [], "any", false, false, true, 86), 86, $this->source), "html", null, true);
            echo "
\t\t\t</div>
\t\t";
        }
        // line 89
        echo "\t</div>
</div>

";
        // line 92
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "breadcrumb_area", [], "any", false, false, true, 92)) {
            // line 93
            echo "\t<div id=\"whole-breadcrumb_area\" class=\"container-fluid\">
\t\t<div id=\"breadcrumb_area\" class=\"container\">";
            // line 94
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "page_title_area", [], "any", false, false, true, 94), 94, $this->source), "html", null, true);
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "breadcrumb_area", [], "any", false, false, true, 94), 94, $this->source), "html", null, true);
            echo "</div>
\t</div>
";
        }
        // line 97
        echo "
";
        // line 98
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "workplace_area", [], "any", false, false, true, 98)) {
            // line 99
            echo "\t<div id=\"our-workplace-area\" class=\"container-fluid\">
\t\t<div id=\"workplace_area\" class=\"container\">";
            // line 100
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "workplace_area", [], "any", false, false, true, 100), 100, $this->source), "html", null, true);
            echo "</div>
\t</div>
";
        }
        // line 103
        echo "
";
        // line 104
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "who_we_serve", [], "any", false, false, true, 104)) {
            // line 105
            echo "\t<div id=\"who_we_serve\">
\t\t";
            // line 106
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "who_we_serve", [], "any", false, false, true, 106), 106, $this->source), "html", null, true);
            echo "
\t</div>
";
        }
        // line 109
        echo "
";
        // line 110
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "secretariat_area", [], "any", false, false, true, 110)) {
            // line 111
            echo "\t<div id=\"crown-secretariat-area\" class=\"container-fluid\">
\t\t<div id=\"secretariat-area\" class=\"container\">";
            // line 112
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "secretariat_area", [], "any", false, false, true, 112), 112, $this->source), "html", null, true);
            echo "</div>
\t</div>
";
        }
        // line 115
        echo "
";
        // line 116
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "performance_area", [], "any", false, false, true, 116)) {
            // line 117
            echo "\t<div id=\"performance-report-area\" class=\"container-fluid\">
\t\t<div id=\"performance-area\" class=\"container\">";
            // line 118
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "performance_area", [], "any", false, false, true, 118), 118, $this->source), "html", null, true);
            echo "</div>
\t</div>
";
        }
        // line 121
        echo "
";
        // line 122
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "news_area", [], "any", false, false, true, 122)) {
            // line 123
            echo "\t<div id=\"latest-news-area\" class=\"container-fluid\">
\t\t<div id=\"news-area\" class=\"container\">";
            // line 124
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "news_area", [], "any", false, false, true, 124), 124, $this->source), "html", null, true);
            echo "</div>
\t</div>
";
        }
        // line 127
        echo "
";
        // line 128
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "news_letter_area", [], "any", false, false, true, 128)) {
            // line 129
            echo "\t<div id=\"news-letter-area\" class=\"container-fluid\">
\t\t<div id=\"news-letter\" class=\"container\">";
            // line 130
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "news_letter_area", [], "any", false, false, true, 130), 130, $this->source), "html", null, true);
            echo "</div>
\t</div>
";
        }
        // line 133
        echo "

";
        // line 135
        $this->loadTemplate("@cas/includes/footer.html.twig", "themes/custom/cas/templates/page/page.html.twig", 135)->display($context);
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
        return array (  217 => 135,  213 => 133,  207 => 130,  204 => 129,  202 => 128,  199 => 127,  193 => 124,  190 => 123,  188 => 122,  185 => 121,  179 => 118,  176 => 117,  174 => 116,  171 => 115,  165 => 112,  162 => 111,  160 => 110,  157 => 109,  151 => 106,  148 => 105,  146 => 104,  143 => 103,  137 => 100,  134 => 99,  132 => 98,  129 => 97,  122 => 94,  119 => 93,  117 => 92,  112 => 89,  106 => 86,  103 => 85,  101 => 84,  95 => 81,  91 => 79,  85 => 76,  82 => 75,  80 => 74,  74 => 70,  68 => 67,  65 => 66,  63 => 65,  60 => 64,  53 => 60,  49 => 58,  47 => 57,  44 => 56,  42 => 55,  39 => 54,);
    }

    public function getSourceContext()
    {
        return new Source("{#
/**
 * @file
 * btc theme implementation to display a single page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.html.twig template normally located in the
 * core/modules/system directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - base_path: The base URL path of the Drupal installation. Will usually be
 *   \"/\" unless you have installed Drupal in a sub-directory.
 * - is_front: A flag indicating if the current page is the front page.
 * - logged_in: A flag indicating if the user is registered and signed in.
 * - is_admin: A flag indicating if the user has permission to access
 *   administration pages.
 *
 * Site identity:
 * - front_page: The URL of the front page. Use this instead of base_path when
 *   linking to the front page. This includes the language domain or prefix.
 *
 * Page content (in order of occurrence in the default page.html.twig):
 * - node: Fully loaded node, if there is an automatically-loaded node
 *   associated with the page and the node ID is the second argument in the
 *   page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - page.logo_area: Items for the logo area region.
 * - page.header_menu: Items for the header menu region.
 * - page.slideshow: Items for the slideshow  region.
 * - page.inner_banner: Items for the inner banner  region.
 * - page.breadcrumb area: Items for the breadcrumb area region.
 * - page.content: The main content of the current page.
 * - page.years_of_experience: Items for the years of experience region.
 * - page.web_mobile_app: Items for the web mobile app.
 * - page.our_latest_Projects: Items for the our latest Projects region.
 * - page.testimonial: Items for the testimonial region.
 * - page.free_trial: Items for the free trial region.
 * - page.latest_blog_posts: Items for the latest blog posts region.
 * - page.our_clients: Items for the our clients region.
 * - page.douce_infotech_only: Items for the douce infotech only.
 * - page.sidebar: Items for the sidebar.
 * - page.footer_first: Items for the footer first.
 * - page.footer_second: Items for the footer second region.
 * - page.footer_third: Items for the footer_third region.
 *
 * @see template_preprocess_page()
 * @see html.html.twig
 */
#}

{% include '@cas/includes/header.html.twig' %}

{% if page.nav_main %}
\t<div id=\"navigation-menu\">\t    
    <div class=\"container\">
\t      <div class=\"nav_main\">{{ page.nav_main }}</div>\t
\t </div>
  </div>
{% endif %}

{% if page.banner %}
\t<div class=\"banner-area\">
\t\t{{page.banner}}
\t</div>
{% endif %}

<div id=\"maindiv\" class=\"container-fluid\">
\t<div id=\"main_content_area\" class=\"container\">

\t\t{% if page.sidebar_first %}
\t\t\t<div id=\"sidebar_first_area\" class=\"column sidebar\">
\t\t\t\t{{ page.sidebar_first }}
\t\t\t</div>
\t\t{% endif %}

\t\t<div id=\"midcontent_area\" class=\"column main-content\">
\t\t\t<div id=\"content\">{{ page.content }}</div>
\t\t</div>

\t\t{% if page.sidebar_second %}
\t\t\t<div id=\"sidebar_second_area\" class=\"column sidebar\">
\t\t\t\t{{ page.sidebar_second }}
\t\t\t</div>
\t\t{% endif %}
\t</div>
</div>

{% if page.breadcrumb_area %}
\t<div id=\"whole-breadcrumb_area\" class=\"container-fluid\">
\t\t<div id=\"breadcrumb_area\" class=\"container\">{{ page.page_title_area}}{{ page.breadcrumb_area}}</div>
\t</div>
{% endif %}

{% if page.workplace_area %}
\t<div id=\"our-workplace-area\" class=\"container-fluid\">
\t\t<div id=\"workplace_area\" class=\"container\">{{ page.workplace_area}}</div>
\t</div>
{% endif %}

{% if page.who_we_serve %}
\t<div id=\"who_we_serve\">
\t\t{{ page.who_we_serve}}
\t</div>
{% endif %}

{% if page.secretariat_area %}
\t<div id=\"crown-secretariat-area\" class=\"container-fluid\">
\t\t<div id=\"secretariat-area\" class=\"container\">{{ page.secretariat_area}}</div>
\t</div>
{% endif %}

{% if page.performance_area %}
\t<div id=\"performance-report-area\" class=\"container-fluid\">
\t\t<div id=\"performance-area\" class=\"container\">{{ page.performance_area}}</div>
\t</div>
{% endif %}

{% if page.news_area %}
\t<div id=\"latest-news-area\" class=\"container-fluid\">
\t\t<div id=\"news-area\" class=\"container\">{{ page.news_area}}</div>
\t</div>
{% endif %}

{% if page.news_letter_area %}
\t<div id=\"news-letter-area\" class=\"container-fluid\">
\t\t<div id=\"news-letter\" class=\"container\">{{ page.news_letter_area}}</div>
\t</div>
{% endif %}


{% include '@cas/includes/footer.html.twig' %}", "themes/custom/cas/templates/page/page.html.twig", "C:\\xampp\\htdocs\\cas-drupal\\web\\themes\\custom\\cas\\templates\\page\\page.html.twig");
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
