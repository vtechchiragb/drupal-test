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

/* themes/custom/cas/templates/block/block--cas-crownagenciessecretariatdemo.html.twig */
class __TwigTemplate_68bc113263dbeebd1a5cb06324e0366a extends Template
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
        // line 1
        echo "
 <div";
        // line 2
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [($context["classes"] ?? null)], "method", false, false, true, 2), 2, $this->source), "html", null, true);
        echo ">
  ";
        // line 3
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_prefix"] ?? null), 3, $this->source), "html", null, true);
        echo "
  ";
        // line 4
        if (($context["label"] ?? null)) {
            // line 5
            echo "    <div class=\"right-side-main\">
      <div class=\"row\">
        <div class=\"right-description col-sm-7\">
          <h2";
            // line 8
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_attributes"] ?? null), 8, $this->source), "html", null, true);
            echo ">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["label"] ?? null), 8, $this->source), "html", null, true);
            echo "</h2>
          <p>";
            // line 9
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "body", [], "any", false, false, true, 9), 9, $this->source), "html", null, true);
            echo "</p>
        </div>
        <div class=\"right-video col-sm-5\">
          <div class=\"video-container\">
            <img class=\"overlay-image\" src=\"/cas-drupal/web/themes/custom/cas/images/agencies.png\" alt=\"Overlay Image\">
            <video id=\"video-player\" class=\"video-player\" controls>
              <source src=\"";
            // line 15
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->getFileUrl($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (($__internal_compile_0 = twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_upload_video", [], "any", false, false, true, 15)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["#items"] ?? null) : null), "entity", [], "any", false, false, true, 15), "uri", [], "any", false, false, true, 15), 0, [], "any", false, false, true, 15), "value", [], "any", false, false, true, 15), 15, $this->source)), "html", null, true);
            echo "\" type=\"video/mp4\">
            </video>
            <button class=\"play-button\"><img src=\"/cas-drupal/web/themes/custom/cas/images/video-play-btn.png\" alt=\"Play Button\"></button>
          </div>
        </div>
      </div>
      <div class=\"view-more\">
        <a href=\"#\">View More</a>
      </div>
    </div>
  ";
        }
        // line 26
        echo "  ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_suffix"] ?? null), 26, $this->source), "html", null, true);
        echo "
</div>


";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["attributes", "classes", "title_prefix", "label", "title_attributes", "content", "title_suffix"]);    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "themes/custom/cas/templates/block/block--cas-crownagenciessecretariatdemo.html.twig";
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
        return array (  86 => 26,  72 => 15,  63 => 9,  57 => 8,  52 => 5,  50 => 4,  46 => 3,  42 => 2,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("
 <div{{ attributes.addClass(classes) }}>
  {{ title_prefix }}
  {% if label %}
    <div class=\"right-side-main\">
      <div class=\"row\">
        <div class=\"right-description col-sm-7\">
          <h2{{ title_attributes }}>{{ label }}</h2>
          <p>{{ content.body }}</p>
        </div>
        <div class=\"right-video col-sm-5\">
          <div class=\"video-container\">
            <img class=\"overlay-image\" src=\"/cas-drupal/web/themes/custom/cas/images/agencies.png\" alt=\"Overlay Image\">
            <video id=\"video-player\" class=\"video-player\" controls>
              <source src=\"{{ file_url(content.field_upload_video['#items'].entity.uri.0.value) }}\" type=\"video/mp4\">
            </video>
            <button class=\"play-button\"><img src=\"/cas-drupal/web/themes/custom/cas/images/video-play-btn.png\" alt=\"Play Button\"></button>
          </div>
        </div>
      </div>
      <div class=\"view-more\">
        <a href=\"#\">View More</a>
      </div>
    </div>
  {% endif %}
  {{ title_suffix }}
</div>


{# <div{{ attributes.addClass(classes) }}>
  {{ title_prefix }}
  {% if label %}
    <div class=\"right-side-main\">
      <div class=\"row\">
        <div class=\"right-description col-sm-7\">
          <h2{{ title_attributes }}>{{ label }}</h2>
          <p>{{ content.body }}</p>
        </div>
        <div class=\"right-video col-sm-5\">
          <div class=\"video-container\">
            <img class=\"overlay-image\" src=\"/cas-drupal/web/themes/custom/cas/images/agencies.png\" alt=\"Overlay Image\">
            <a href=\"#\" class=\"open-video-link\" data-video-id=\"gvFaIKVMW_M\">Open Video</a>
            <!-- Replace \"gvFaIKVMW_M\" with your actual YouTube video ID -->
          </div>
        </div>
      </div>
      <div class=\"view-more\">
        <a href=\"#\">View More</a>
      </div>
    </div>
  {% endif %}
  {{ title_suffix }}
</div>
 #}
", "themes/custom/cas/templates/block/block--cas-crownagenciessecretariatdemo.html.twig", "C:\\xampp\\htdocs\\cas-drupal\\web\\themes\\custom\\cas\\templates\\block\\block--cas-crownagenciessecretariatdemo.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 4);
        static $filters = array("escape" => 2);
        static $functions = array("file_url" => 15);

        try {
            $this->sandbox->checkSecurity(
                ['if'],
                ['escape'],
                ['file_url']
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
