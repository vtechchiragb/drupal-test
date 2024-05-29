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

/* themes/custom/cas/templates/block/block--simplenews-subscription-block.html.twig */
class __TwigTemplate_f835a1f57c62ed83c30ae0effbb4fd30 extends Template
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
";
        // line 46
        echo "
<div class=\"subscribebox\">
<div class=\"row\">
<div class=\"col-sm-3 newslatter-left\"><img src=\"";
        // line 49
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($this->sandbox->ensureToStringAllowed(($context["base_path"] ?? null), 49, $this->source) . $this->sandbox->ensureToStringAllowed(($context["directory"] ?? null), 49, $this->source)), "html", null, true);
        echo "/images/Subscribe-images.png\" alt=\"Subscribe-images.png\"></div>
<div class=\"col-sm-9 newslatter-right\">
<div class=\"subscribe-text\">
<h2>Subscribe to our Newsletter!</h2>

<p><span>Be the first to get exclusive updates and the latest news</span></p>
<p>Email addresses are collected under section 26(c) of the Freedom of Information and Protection of Privacy Act, for the purpose of providing content updates. Questions about the collection of email addresses can be directed to the Manager of Corporate Web, Government Digital Experience Division. PO Box 9409, Stn Prov Govt, Victoria, BC V8W 9V1 Submit.</p>

";
        // line 57
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["content"] ?? null), 57, $this->source), "html", null, true);
        echo "</div>
</div>
</div>
</div>";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["base_path", "directory", "content"]);    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "themes/custom/cas/templates/block/block--simplenews-subscription-block.html.twig";
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
        return array (  58 => 57,  47 => 49,  42 => 46,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "themes/custom/cas/templates/block/block--simplenews-subscription-block.html.twig", "C:\\xampp\\htdocs\\cas-drupal\\web\\themes\\custom\\cas\\templates\\block\\block--simplenews-subscription-block.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array();
        static $filters = array("escape" => 49);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                [],
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
