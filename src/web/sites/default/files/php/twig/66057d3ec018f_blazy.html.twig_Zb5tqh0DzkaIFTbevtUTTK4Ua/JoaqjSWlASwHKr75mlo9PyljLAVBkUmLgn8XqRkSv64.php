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

/* modules/contrib/blazy/templates/blazy.html.twig */
class __TwigTemplate_0d70a70ae6b37ed12285e1c39880cda6 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'blazy_player' => [$this, 'block_blazy_player'],
            'blazy_media' => [$this, 'block_blazy_media'],
            'blazy_content' => [$this, 'block_blazy_content'],
            'blazy_caption' => [$this, 'block_blazy_caption'],
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 66
        $context["classes"] = [((        // line 67
($context["content"] ?? null)) ? ("media--rendered") : ("")), ((twig_get_attribute($this->env, $this->source,         // line 68
($context["blazies"] ?? null), "namespace", [], "any", false, false, true, 68)) ? (("media--" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["blazies"] ?? null), "namespace", [], "any", false, false, true, 68), 68, $this->source)))) : ("")), ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,         // line 69
($context["blazies"] ?? null), "media", [], "any", false, false, true, 69), "provider", [], "any", false, false, true, 69)) ? (("media--" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["blazies"] ?? null), "media", [], "any", false, false, true, 69), "provider", [], "any", false, false, true, 69), 69, $this->source)))) : ("")), ((twig_get_attribute($this->env, $this->source,         // line 70
($context["settings"] ?? null), "media_switch", [], "any", false, false, true, 70)) ? (("media--switch media--switch--" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["settings"] ?? null), "media_switch", [], "any", false, false, true, 70), 70, $this->source)))) : ("")), ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,         // line 71
($context["blazies"] ?? null), "use", [], "any", false, false, true, 71), "player", [], "any", false, false, true, 71)) ? ("media--player") : ("")), ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,         // line 72
($context["blazies"] ?? null), "media", [], "any", false, false, true, 72), "bundle", [], "any", false, false, true, 72)) ? (("media--bundle--" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["blazies"] ?? null), "media", [], "any", false, false, true, 72), "bundle", [], "any", false, false, true, 72), 72, $this->source)))) : ("")), ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,         // line 73
($context["blazies"] ?? null), "media", [], "any", false, false, true, 73), "type", [], "any", false, false, true, 73)) ? (("media--" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["blazies"] ?? null), "media", [], "any", false, false, true, 73), "type", [], "any", false, false, true, 73), 73, $this->source)))) : ("")), (((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,         // line 74
($context["blazies"] ?? null), "resimage", [], "any", false, false, true, 74), "id", [], "any", false, false, true, 74) &&  !($context["content"] ?? null))) ? ("media--responsive") : ("")), ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,         // line 75
($context["blazies"] ?? null), "is", [], "any", false, false, true, 75), "svg", [], "any", false, false, true, 75)) ? ("media--svg") : ("")), ((twig_get_attribute($this->env, $this->source,         // line 76
($context["settings"] ?? null), "ratio", [], "any", false, false, true, 76)) ? (("media--ratio media--ratio--" . $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["settings"] ?? null), "ratio", [], "any", false, false, true, 76), 76, $this->source))) : ("")), ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,         // line 77
($context["blazies"] ?? null), "use", [], "any", false, false, true, 77), "loader", [], "any", false, false, true, 77)) ? ("is-b-loading") : ("")), ((twig_get_attribute($this->env, $this->source,         // line 78
($context["settings"] ?? null), "classes", [], "any", false, false, true, 78)) ? (\Drupal\Component\Utility\Html::getClass(twig_join_filter($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["settings"] ?? null), "classes", [], "any", false, false, true, 78), 78, $this->source), " "))) : (""))];
        // line 81
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["blazies"] ?? null), "use", [], "any", false, false, true, 81), "player", [], "any", false, false, true, 81)) {
            // line 82
            echo "  ";
            $context["attributes"] = twig_get_attribute($this->env, $this->source, ($context["attributes"] ?? null), "setAttribute", ["aria-live", "polite"], "method", false, false, true, 82);
            // line 83
            echo "
  ";
            // line 84
            $context["label"] = twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["blazies"] ?? null), "media", [], "any", false, false, true, 84), "label", [], "any", false, false, true, 84);
            // line 85
            echo "  ";
            $context["play_title"] = t("Load and play video.");
            // line 86
            echo "  ";
            $context["close_title"] = t("Stop and close video.");
            // line 87
            echo "
  ";
            // line 88
            if (($context["label"] ?? null)) {
                // line 89
                echo "    ";
                $context["play_title"] = t("Load and play the video \"@label\".", ["@label" => ($context["label"] ?? null)]);
                // line 90
                echo "    ";
                $context["close_title"] = t("Stop and close the video \"@label\".", ["@label" => ($context["label"] ?? null)]);
                // line 91
                echo "  ";
            }
            // line 92
            echo "
  ";
            // line 93
            $context["play_button_attributes"] = $this->extensions['Drupal\Core\Template\TwigExtension']->createAttribute(["aria-label" =>             // line 94
($context["play_title"] ?? null), "class" => ["media__icon", "media__icon--play"], "data-b-provider" => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,             // line 96
($context["blazies"] ?? null), "media", [], "any", false, false, true, 96), "provider", [], "any", false, false, true, 96), "data-b-token" => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,             // line 97
($context["blazies"] ?? null), "media", [], "any", false, false, true, 97), "token", [], "any", false, false, true, 97), "data-url" => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,             // line 98
($context["blazies"] ?? null), "media", [], "any", false, false, true, 98), "embed_url", [], "any", false, false, true, 98), "data-iframe-title" =>             // line 99
($context["label"] ?? null), "title" =>             // line 100
($context["play_title"] ?? null), "type" => "button"]);
            // line 103
            echo "
  ";
            // line 104
            $context["close_button_attributes"] = $this->extensions['Drupal\Core\Template\TwigExtension']->createAttribute(["aria-label" =>             // line 105
($context["close_title"] ?? null), "class" => ["media__icon", "media__icon--close"], "title" =>             // line 107
($context["close_title"] ?? null), "type" => "button"]);
        }
        // line 111
        ob_start();
        // line 112
        echo "  ";
        $this->displayBlock('blazy_player', $context, $blocks);
        $context["player"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 121
        ob_start();
        // line 122
        $this->displayBlock('blazy_media', $context, $blocks);
        $context["media"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 136
        ob_start();
        // line 137
        $this->displayBlock('blazy_content', $context, $blocks);
        // line 154
        echo "
  ";
        // line 160
        $context["IS_INLINE"] =  !twig_test_empty(twig_get_attribute($this->env, $this->source, ($context["captions"] ?? null), "inline", [], "any", false, false, true, 160));
        // line 161
        $context["IS_OVERLAY"] =  !twig_test_empty(twig_get_attribute($this->env, $this->source, ($context["captions"] ?? null), "overlay", [], "any", false, false, true, 161));
        // line 163
        if ((($context["IS_INLINE"] ?? null) || ($context["IS_OVERLAY"] ?? null))) {
            // line 164
            $this->displayBlock('blazy_caption', $context, $blocks);
        }
        // line 188
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["postscript"] ?? null), 188, $this->source), "html", null, true);
        $context["blazy"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 190
        if (($context["wrapper_attributes"] ?? null)) {
            // line 191
            $context["wrapper_tag"] = (((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["blazies"] ?? null), "item", [], "any", false, true, true, 191), "wrapper_tag", [], "any", true, true, true, 191) &&  !(null === twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["blazies"] ?? null), "item", [], "any", false, true, true, 191), "wrapper_tag", [], "any", false, false, true, 191)))) ? (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["blazies"] ?? null), "item", [], "any", false, true, true, 191), "wrapper_tag", [], "any", false, false, true, 191)) : ("div"));
            // line 192
            echo "<";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["wrapper_tag"] ?? null), 192, $this->source), "html", null, true);
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["wrapper_attributes"] ?? null), 192, $this->source), "html", null, true);
            echo ">";
            // line 193
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["blazy"] ?? null), 193, $this->source), "html", null, true);
            // line 194
            echo "</";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["wrapper_tag"] ?? null), 194, $this->source), "html", null, true);
            echo ">
";
        } else {
            // line 196
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["blazy"] ?? null), 196, $this->source), "html", null, true);
        }
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["content", "blazies", "settings", "captions", "postscript", "wrapper_attributes", "iframe", "preface", "image", "noscript", "overlay", "icon", "media_attributes", "url", "url_attributes", "caption_wrapper_attributes", "caption_attributes", "caption_content_attributes"]);    }

    // line 112
    public function block_blazy_player($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 113
        echo "    ";
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["blazies"] ?? null), "use", [], "any", false, false, true, 113), "player", [], "any", false, false, true, 113)) {
            // line 114
            echo "      <button";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["close_button_attributes"] ?? null), 114, $this->source), "html", null, true);
            echo "></button>
      <button";
            // line 115
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["play_button_attributes"] ?? null), 115, $this->source), "html", null, true);
            echo "></button>
    ";
        } else {
            // line 117
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["iframe"] ?? null), 117, $this->source), "html", null, true);
        }
        // line 119
        echo "  ";
    }

    // line 122
    public function block_blazy_media($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 123
        echo "    <div";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [($context["classes"] ?? null)], "method", false, false, true, 123), 123, $this->source), "html", null, true);
        echo ">";
        // line 124
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["preface"] ?? null), 124, $this->source), "html", null, true);
        // line 125
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["image"] ?? null), 125, $this->source), "html", null, true);
        // line 127
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["noscript"] ?? null), 127, $this->source), "html", null, true);
        // line 129
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["content"] ?? null), 129, $this->source), "html", null, true);
        // line 130
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["overlay"] ?? null), 130, $this->source), "html", null, true);
        // line 131
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["player"] ?? null), 131, $this->source), "html", null, true);
        // line 132
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["icon"] ?? null), 132, $this->source), "html", null, true);
        // line 133
        echo "</div>";
    }

    // line 137
    public function block_blazy_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 138
        if (($context["media_attributes"] ?? null)) {
            echo "<div";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["media_attributes"] ?? null), 138, $this->source), "html", null, true);
            echo ">";
        }
        // line 139
        if ((($context["url"] ?? null) &&  !twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["blazies"] ?? null), "use", [], "any", false, false, true, 139), "player", [], "any", false, false, true, 139))) {
            // line 140
            echo "<a href=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["url"] ?? null), 140, $this->source), "html", null, true);
            echo "\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["url_attributes"] ?? null), 140, $this->source), "html", null, true);
            echo ">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["media"] ?? null), 140, $this->source), "html", null, true);
            echo "</a>
        ";
            // line 144
            if ((($context["captions"] ?? null) &&  !twig_test_empty(twig_get_attribute($this->env, $this->source, ($context["captions"] ?? null), "lightbox", [], "any", false, false, true, 144)))) {
                // line 145
                echo "<div class=\"litebox__caption litebox-caption visually-hidden\">";
                // line 146
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["captions"] ?? null), "lightbox", [], "any", false, false, true, 146), 146, $this->source), "html", null, true);
                // line 147
                echo "</div>";
            }
        } else {
            // line 150
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["media"] ?? null), 150, $this->source), "html", null, true);
        }
        // line 152
        if (($context["media_attributes"] ?? null)) {
            echo "</div>";
        }
    }

    // line 164
    public function block_blazy_caption($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 165
        $context["caption_tag"] = (((twig_get_attribute($this->env, $this->source, ($context["captions"] ?? null), "tag", [], "any", true, true, true, 165) &&  !(null === twig_get_attribute($this->env, $this->source, ($context["captions"] ?? null), "tag", [], "any", false, false, true, 165)))) ? (twig_get_attribute($this->env, $this->source, ($context["captions"] ?? null), "tag", [], "any", false, false, true, 165)) : ("div"));
        // line 166
        $context["cw_tag"] = (((twig_get_attribute($this->env, $this->source, ($context["captions"] ?? null), "wrapper_tag", [], "any", true, true, true, 166) &&  !(null === twig_get_attribute($this->env, $this->source, ($context["captions"] ?? null), "wrapper_tag", [], "any", false, false, true, 166)))) ? (twig_get_attribute($this->env, $this->source, ($context["captions"] ?? null), "wrapper_tag", [], "any", false, false, true, 166)) : ("div"));
        // line 167
        $context["IS_CATEGORY"] =  !twig_test_empty(twig_get_attribute($this->env, $this->source, ($context["captions"] ?? null), "category", [], "any", false, false, true, 167));
        // line 169
        if (($context["caption_wrapper_attributes"] ?? null)) {
            echo "<";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["cw_tag"] ?? null), 169, $this->source), "html", null, true);
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["caption_wrapper_attributes"] ?? null), 169, $this->source), "html", null, true);
            echo ">";
        }
        // line 171
        echo "<";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["caption_tag"] ?? null), 171, $this->source), "html", null, true);
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["caption_attributes"] ?? null), 171, $this->source), "html", null, true);
        echo ">";
        // line 172
        if (($context["IS_OVERLAY"] ?? null)) {
            // line 173
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["captions"] ?? null), "overlay", [], "any", false, false, true, 173), 173, $this->source), "html", null, true);
            // line 174
            if (($context["IS_INLINE"] ?? null)) {
                echo "<div";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["caption_content_attributes"] ?? null), 174, $this->source), "html", null, true);
                echo ">";
            }
        }
        // line 177
        if (($context["IS_INLINE"] ?? null)) {
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["captions"] ?? null), "inline", [], "any", false, false, true, 177), 177, $this->source), "html", null, true);
        }
        // line 179
        if ((($context["IS_INLINE"] ?? null) && ($context["IS_OVERLAY"] ?? null))) {
            echo "</div>";
        }
        // line 180
        echo "</";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["caption_tag"] ?? null), 180, $this->source), "html", null, true);
        echo ">";
        // line 182
        if (($context["IS_CATEGORY"] ?? null)) {
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["captions"] ?? null), "category", [], "any", false, false, true, 182), 182, $this->source), "html", null, true);
        }
        // line 184
        if (($context["caption_wrapper_attributes"] ?? null)) {
            echo "</";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["cw_tag"] ?? null), 184, $this->source), "html", null, true);
            echo ">";
        }
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "modules/contrib/blazy/templates/blazy.html.twig";
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
        return array (  298 => 184,  294 => 182,  290 => 180,  286 => 179,  282 => 177,  275 => 174,  273 => 173,  271 => 172,  266 => 171,  259 => 169,  257 => 167,  255 => 166,  253 => 165,  249 => 164,  243 => 152,  240 => 150,  236 => 147,  234 => 146,  232 => 145,  230 => 144,  221 => 140,  219 => 139,  213 => 138,  209 => 137,  205 => 133,  203 => 132,  201 => 131,  199 => 130,  197 => 129,  195 => 127,  193 => 125,  191 => 124,  187 => 123,  183 => 122,  179 => 119,  176 => 117,  171 => 115,  166 => 114,  163 => 113,  159 => 112,  153 => 196,  147 => 194,  145 => 193,  140 => 192,  138 => 191,  136 => 190,  133 => 188,  130 => 164,  128 => 163,  126 => 161,  124 => 160,  121 => 154,  119 => 137,  117 => 136,  114 => 122,  112 => 121,  108 => 112,  106 => 111,  103 => 107,  102 => 105,  101 => 104,  98 => 103,  96 => 100,  95 => 99,  94 => 98,  93 => 97,  92 => 96,  91 => 94,  90 => 93,  87 => 92,  84 => 91,  81 => 90,  78 => 89,  76 => 88,  73 => 87,  70 => 86,  67 => 85,  65 => 84,  62 => 83,  59 => 82,  57 => 81,  55 => 78,  54 => 77,  53 => 76,  52 => 75,  51 => 74,  50 => 73,  49 => 72,  48 => 71,  47 => 70,  46 => 69,  45 => 68,  44 => 67,  43 => 66,);
    }

    public function getSourceContext()
    {
        return new Source("{#
/**
 * @file
 * Default theme implementation to display a formatted blazy image/media field.
 *
 * The Blazy supports core image, responsive image and media entity.
 * If iframe switcher is enabled, audio/video iframe will be hidden below image
 * overlay, and only visible when toggled. Otherwise iframe only, and image is
 * emptied.
 *
 * Important!
 * If you are adding additional contents to any content-related variable here,
 * e.g.: content, overlay, preface, postscript, etc., including icon, be sure to
 * add your own key, normally unique like UUID or module name, to not conflict
 * against, or nullify, other providers, e.g.:
 * Good: postscript.cta, or postscript.widget (This extends postscript)
 * Bad: postscript = cta (This overrides/ nullifies other postscripts with cta)
 *
 * Unless that is expected, of course. Beware! Blazy sub-modules may need them.
 * The bad guy may break Slick, and all sub-modules, at 3.x! If any issues,
 * it is recommended to adjust, or re-layering, than nullifying. At least,
 * conditionally like seen below with any IFs. CSS overrides are the safest.
 *
 * Should you override this template drastically, it will be safer to use
 * hook_theme_suggestions_alter(), and conditionally override per (sub)-module
 * since this theme is also used by Slick, Splide, etc. for their theme_ITEM()
 * contents. All info is available in element.#settings for granular controls.
 *
 * Available variables:
 *   - captions: An optional renderable array of inline or lightbox captions.
 *   - image: A collection of image data.
 *   - attributes: An array of attributes applied to .media container.
 *   - iframe: A renderable array of iframe with its attributes and SRC.
 *   - settings: An array containing the given settings.
 *   - blazies: A convenient shortcut for settings.blazies.
 *   - url: An optional URL the image can be linked to, can be any of
 *       audio/video, or entity URLs, when using Colorbox/Photobox, or Link to
 *       content options.
 *   - url_attributes: An array of URL attributes, lightbox or content links.
 *   - icon: normally just lightbox + sign icon, not media player icons.
 *   - noscript: The fallback image for non-js users.
 *   - preface: any content prefacing the image/ video goes here, e.g.: blur.
 *   - overlay: any extra content overlaying the image/ video goes here. Both
 *       preface and overlay useful to work with layering, z-index. This opens
 *       up possibility for blazy-related modules -- Slick, GridStack, etc. to
 *       use blazy.html.twig for their slide or item contents, perhaps at 3+.
 *   - postscript: Any extra contents to put into blazy goes here.
 *   - content: Various Media entities like Facebook, Instagram, local Video,
 *       etc. Basically content is the replacement for (Responsive) image
 *       and oEmbed video. This makes it possible to have a mix of Media
 *       entities, image and videos on a Blazy Grid, Slick, GridStack, etc.
 *       Regular Blazy features are still disabled by default at
 *       \\Drupal\\blazy\\BlazyDefault::richSettings() to avoid complication.
 *       However you can override them accordingly as needed, such as lightbox
 *       for local Video with/o a pre-configured poster image. The #settings
 *       are provided under content variables for more work. Originally
 *       content is a theme_field() output, trimmed down to a bare minimum to
 *       avoid nested field markups for DOM diets.
 *
 * @see template_preprocess_blazy()
 *
 * @ingroup themeable
 */
#}
{%
  set classes = [
    content ? 'media--rendered',
    blazies.namespace ? 'media--' ~ blazies.namespace|clean_class,
    blazies.media.provider ? 'media--' ~ blazies.media.provider|clean_class,
    settings.media_switch ? 'media--switch media--switch--' ~ settings.media_switch|clean_class,
    blazies.use.player ? 'media--player',
    blazies.media.bundle ? 'media--bundle--' ~ blazies.media.bundle|clean_class,
    blazies.media.type ? 'media--' ~ blazies.media.type|clean_class,
    blazies.resimage.id and not content ? 'media--responsive',
    blazies.is.svg ? 'media--svg',
    settings.ratio ? 'media--ratio media--ratio--' ~ settings.ratio,
    blazies.use.loader ? 'is-b-loading',
    settings.classes ? settings.classes|join(' ')|clean_class,
  ]
%}
{% if blazies.use.player %}
  {% set attributes = attributes.setAttribute('aria-live', 'polite') %}

  {% set label = blazies.media.label %}
  {% set play_title = 'Load and play video.'|t %}
  {% set close_title = 'Stop and close video.'|t %}

  {% if label %}
    {% set play_title = 'Load and play the video \"@label\".'|t({'@label': label}) %}
    {% set close_title = 'Stop and close the video \"@label\".'|t({'@label': label}) %}
  {% endif %}

  {% set play_button_attributes = create_attribute({
    'aria-label': play_title,
    'class': ['media__icon', 'media__icon--play'],
    'data-b-provider': blazies.media.provider,
    'data-b-token': blazies.media.token,
    'data-url': blazies.media.embed_url,
    'data-iframe-title': label,
    'title': play_title,
    'type': 'button'
  }) %}

  {% set close_button_attributes = create_attribute({
    'aria-label': close_title,
    'class': ['media__icon', 'media__icon--close'],
    'title': close_title,
    'type': 'button'
  }) %}
{% endif %}
{% set player %}
  {% block blazy_player %}
    {% if blazies.use.player %}
      <button{{ close_button_attributes }}></button>
      <button{{ play_button_attributes }}></button>
    {% else %}
      {{- iframe -}}
    {% endif %}
  {% endblock %}
{% endset %}
{% set media %}
  {%- block blazy_media %}
    <div{{ attributes.addClass(classes) }}>
      {{- preface -}}
      {{- image -}}
      {# Noscript over image, to minimize CSS works. #}
      {{- noscript -}}
      {# Audio over image in case image is not a background. #}
      {{- content -}}
      {{- overlay -}}
      {{- player -}}
      {{- icon -}}
    </div>
  {%- endblock %}
{% endset %}
{% set blazy %}
  {%- block blazy_content %}
    {%- if media_attributes -%}<div{{- media_attributes -}}>{%- endif -%}
      {%- if url and not blazies.use.player -%}
        <a href=\"{{ url }}\"{{ url_attributes }}>{{- media -}}</a>
        {# Allows fieldable captions with A tag, such as social share.
          litebox-caption is deprecated for litebox__caption in 2.17.
        #}
        {%- if captions and captions.lightbox is not empty -%}
          <div class=\"litebox__caption litebox-caption visually-hidden\">
            {{- captions.lightbox -}}
          </div>
        {%- endif -%}
      {% else %}
        {{- media -}}
      {%- endif -%}
    {%- if media_attributes -%}</div>{%- endif -%}
  {%- endblock %}

  {#
     Since 2.17, this will replace sub-modules theme_ITEM() contents at 3.x.
     To test it out, enable the option `Use theme_blazy()` at Blazy UI.
     It opens up the door for hoverable effects, etc. at ease and reduce dups.
  #}
  {%- set IS_INLINE = captions.inline is not empty -%}
  {%- set IS_OVERLAY = captions.overlay is not empty -%}

  {%- if IS_INLINE or IS_OVERLAY -%}
    {%- block blazy_caption %}
      {%- set caption_tag = captions.tag ?? 'div' -%}
      {%- set cw_tag = captions.wrapper_tag ?? 'div' -%}
      {%- set IS_CATEGORY = captions.category is not empty -%}

      {%- if caption_wrapper_attributes -%}<{{ cw_tag }}{{- caption_wrapper_attributes -}}>{%- endif -%}

        <{{ caption_tag }}{{ caption_attributes }}>
          {%- if IS_OVERLAY -%}
            {{ captions.overlay }}
            {%- if IS_INLINE -%}<div{{ caption_content_attributes }}>{%- endif -%}
          {%- endif -%}

          {%- if IS_INLINE -%}{{- captions.inline -}}{%- endif -%}

          {%- if IS_INLINE and IS_OVERLAY -%}</div>{%- endif -%}
        </{{ caption_tag }}>

        {%- if IS_CATEGORY -%}{{- captions.category -}}{%- endif -%}

      {%- if caption_wrapper_attributes -%}</{{ cw_tag }}>{%- endif -%}

    {%- endblock %}
  {%- endif -%}
  {{- postscript -}}
{% endset %}
{%- if wrapper_attributes -%}
  {%- set wrapper_tag = blazies.item.wrapper_tag ?? 'div' -%}
  <{{ wrapper_tag }}{{ wrapper_attributes }}>
    {{- blazy -}}
  </{{ wrapper_tag }}>
{% else %}
  {{- blazy -}}
{%- endif -%}
", "modules/contrib/blazy/templates/blazy.html.twig", "C:\\xampp\\htdocs\\cas-drupal\\web\\modules\\contrib\\blazy\\templates\\blazy.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 66, "if" => 81, "block" => 112);
        static $filters = array("clean_class" => 68, "join" => 78, "t" => 85, "escape" => 188);
        static $functions = array("create_attribute" => 93);

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if', 'block'],
                ['clean_class', 'join', 't', 'escape'],
                ['create_attribute']
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
