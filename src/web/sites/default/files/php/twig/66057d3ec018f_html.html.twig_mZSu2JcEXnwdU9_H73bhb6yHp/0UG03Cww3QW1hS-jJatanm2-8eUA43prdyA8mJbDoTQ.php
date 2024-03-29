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

/* themes/custom/cas/templates/page/html.html.twig */
class __TwigTemplate_75cef82484fa5db6925012fe76937810 extends Template
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
        // line 48
        $context["body_classes"] = [((        // line 49
($context["logged_in"] ?? null)) ? ("user-logged-in") : ("")), (( !        // line 50
($context["root_path"] ?? null)) ? ("path-frontpage") : (("path-innerpage not-front path-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(($context["root_path"] ?? null), 50, $this->source))))), ((        // line 51
($context["node_type"] ?? null)) ? (("page-node-type-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(($context["node_type"] ?? null), 51, $this->source)))) : ("")), ((        // line 52
($context["db_offline"] ?? null)) ? ("db-offline") : ("")), ((( !twig_get_attribute($this->env, $this->source,         // line 53
($context["page"] ?? null), "sidebar_first", [], "any", false, false, true, 53) &&  !twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_second", [], "any", false, false, true, 53))) ? ("no-sidebars") : ("")), (((twig_get_attribute($this->env, $this->source,         // line 54
($context["page"] ?? null), "sidebar_first", [], "any", false, false, true, 54) &&  !twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_second", [], "any", false, false, true, 54))) ? ("sidebar-first") : ("")), (((twig_get_attribute($this->env, $this->source,         // line 55
($context["page"] ?? null), "sidebar_second", [], "any", false, false, true, 55) &&  !twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_first", [], "any", false, false, true, 55))) ? ("sidebar-second") : ("")), (((twig_get_attribute($this->env, $this->source,         // line 56
($context["page"] ?? null), "sidebar_first", [], "any", false, false, true, 56) && twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_second", [], "any", false, false, true, 56))) ? ("Two-sidebars") : ("")), ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,         // line 57
($context["theme"] ?? null), "settings", [], "any", false, false, true, 57), "navbar_position", [], "any", false, false, true, 57)) ? (("navbar-is-" . $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "settings", [], "any", false, false, true, 57), "navbar_position", [], "any", false, false, true, 57), 57, $this->source))) : ("")), ((twig_get_attribute($this->env, $this->source,         // line 58
($context["theme"] ?? null), "has_glyphicons", [], "any", false, false, true, 58)) ? ("has-glyphicons") : ("")), ((        // line 59
($context["current_path"] ?? null)) ? (("node" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(($context["current_path"] ?? null), 59, $this->source)))) : (""))];
        // line 62
        echo "<!DOCTYPE html>
<html ";
        // line 63
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["html_attributes"] ?? null), 63, $this->source), "html", null, true);
        echo ">
  <head>
    <head-placeholder token=\"";
        // line 65
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->sandbox->ensureToStringAllowed(($context["placeholder_token"] ?? null), 65, $this->source));
        echo "\">
    <title>";
        // line 66
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\Core\Template\TwigExtension']->safeJoin($this->env, $this->sandbox->ensureToStringAllowed(($context["head_title"] ?? null), 66, $this->source), " | "));
        echo "</title>
    <css-placeholder token=\"";
        // line 67
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->sandbox->ensureToStringAllowed(($context["placeholder_token"] ?? null), 67, $this->source));
        echo "\">
    <js-placeholder token=\"";
        // line 68
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->sandbox->ensureToStringAllowed(($context["placeholder_token"] ?? null), 68, $this->source));
        echo "\">
    <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js\"></script>
    
  </head>
  <body";
        // line 72
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [($context["body_classes"] ?? null)], "method", false, false, true, 72), 72, $this->source), "html", null, true);
        echo ">
    <a href=\"#main-content\" class=\"visually-hidden focusable skip-link\">
      ";
        // line 74
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Skip to main content"));
        echo "
    </a>
    ";
        // line 76
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["page_top"] ?? null), 76, $this->source), "html", null, true);
        echo "
    ";
        // line 77
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["page"] ?? null), 77, $this->source), "html", null, true);
        echo "
    ";
        // line 78
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["page_bottom"] ?? null), 78, $this->source), "html", null, true);
        echo "
    <js-bottom-placeholder token=\"";
        // line 79
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->sandbox->ensureToStringAllowed(($context["placeholder_token"] ?? null), 79, $this->source));
        echo "\">
  </body>
</html>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["logged_in", "root_path", "node_type", "db_offline", "page", "theme", "current_path", "html_attributes", "placeholder_token", "head_title", "attributes", "page_top", "page_bottom"]);    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "themes/custom/cas/templates/page/html.html.twig";
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
        return array (  101 => 79,  97 => 78,  93 => 77,  89 => 76,  84 => 74,  79 => 72,  72 => 68,  68 => 67,  64 => 66,  60 => 65,  55 => 63,  52 => 62,  50 => 59,  49 => 58,  48 => 57,  47 => 56,  46 => 55,  45 => 54,  44 => 53,  43 => 52,  42 => 51,  41 => 50,  40 => 49,  39 => 48,);
    }

    public function getSourceContext()
    {
        return new Source("{#
/**
 * @file
 * Default theme implementation to display the basic html structure of a single
 * Drupal page.
 *
 * Variables:
 * - \$css: An array of CSS files for the current page.
 * - \$language: (object) The language the site is being displayed in.
 *   \$language->language contains its textual representation.
 *   \$language->dir contains the language direction. It will either be 'ltr' or
 *   'rtl'.
 * - \$rdf_namespaces: All the RDF namespace prefixes used in the HTML document.
 * - \$grddl_profile: A GRDDL profile allowing agents to extract the RDF data.
 * - \$head_title: A modified version of the page title, for use in the TITLE
 *   tag.
 * - \$head_title_array: (array) An associative array containing the string parts
 *   that were used to generate the \$head_title variable, already prepared to be
 *   output as TITLE tag. The key/value pairs may contain one or more of the
 *   following, depending on conditions:
 *   - title: The title of the current page, if any.
 *   - name: The name of the site.
 *   - slogan: The slogan of the site, if any, and if there is no title.
 * - \$head: Markup for the HEAD section (including meta tags, keyword tags, and
 *   so on).
 * - \$styles: Style tags necessary to import all CSS files for the page.
 * - \$scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - \$page_top: Initial markup from any modules that have altered the
 *   page. This variable should always be output first, before all other dynamic
 *   content.
 * - \$page: The rendered page content.
 * - \$page_bottom: Final closing markup from any modules that have altered the
 *   page. This variable should always be output last, after all other dynamic
 *   content.
 * - \$classes String of classes that can be used to style contextually through
 *   CSS.
 *
 * @ingroup templates
 *
 * @see bootstrap_preprocess_html()
 * @see template_preprocess()
 * @see template_preprocess_html()
 * @see template_process()
 */
#}
{%
  set body_classes = [
    logged_in ? 'user-logged-in',
\t  not root_path ? 'path-frontpage' : 'path-innerpage not-front path-' ~ root_path|clean_class,
    node_type ? 'page-node-type-' ~ node_type|clean_class,
    db_offline ? 'db-offline',
    not page.sidebar_first and not page.sidebar_second ? 'no-sidebars',
    page.sidebar_first and not page.sidebar_second ? 'sidebar-first',
    page.sidebar_second and not page.sidebar_first ? 'sidebar-second',
    page.sidebar_first and page.sidebar_second ? 'Two-sidebars',
    theme.settings.navbar_position ? 'navbar-is-' ~ theme.settings.navbar_position,
    theme.has_glyphicons ? 'has-glyphicons',
\t  current_path ? 'node' ~ current_path|clean_class,
  ]
%}
<!DOCTYPE html>
<html {{ html_attributes }}>
  <head>
    <head-placeholder token=\"{{ placeholder_token|raw }}\">
    <title>{{ head_title|safe_join(' | ') }}</title>
    <css-placeholder token=\"{{ placeholder_token|raw }}\">
    <js-placeholder token=\"{{ placeholder_token|raw }}\">
    <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js\"></script>
    
  </head>
  <body{{ attributes.addClass(body_classes) }}>
    <a href=\"#main-content\" class=\"visually-hidden focusable skip-link\">
      {{ 'Skip to main content'|t }}
    </a>
    {{ page_top }}
    {{ page }}
    {{ page_bottom }}
    <js-bottom-placeholder token=\"{{ placeholder_token|raw }}\">
  </body>
</html>
", "themes/custom/cas/templates/page/html.html.twig", "C:\\xampp\\htdocs\\cas-drupal\\web\\themes\\custom\\cas\\templates\\page\\html.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 48);
        static $filters = array("clean_class" => 50, "escape" => 63, "raw" => 65, "safe_join" => 66, "t" => 74);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['set'],
                ['clean_class', 'escape', 'raw', 'safe_join', 't'],
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
