<?php

namespace Drupal\slick_browser\Plugin\views\style;

use Drupal\blazy\Views\BlazyStyleBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\slick_browser\SlickBrowserDefault;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Slick Browser style plugin.
 */
class SlickBrowserViews extends BlazyStyleBase {

  /**
   * {@inheritdoc}
   */
  protected static $namespace = 'slick';

  /**
   * {@inheritdoc}
   */
  protected static $itemId = 'slide';

  /**
   * {@inheritdoc}
   */
  protected static $itemPrefix = 'slide';

  /**
   * {@inheritdoc}
   */
  protected static $captionId = 'caption';

  /**
   * {@inheritdoc}
   */
  protected $usesRowPlugin = TRUE;

  /**
   * {@inheritdoc}
   */
  protected $usesGrouping = FALSE;

  /**
   * The slick service manager.
   *
   * @var \Drupal\slick\SlickManagerInterface
   */
  protected $manager;

  /**
   * {@inheritdoc}
   */
  public static function create(
    ContainerInterface $container,
    array $configuration,
    $plugin_id,
    $plugin_definition
  ) {
    $instance = parent::create($container, $configuration, $plugin_id, $plugin_definition);
    $instance->manager = $container->get('slick.manager');
    return $instance;
  }

  /**
   * Returns the slick admin.
   */
  public function admin() {
    return \Drupal::service('slick.admin');
  }

  /**
   * {@inheritdoc}
   */
  protected function defineOptions() {
    $options = [];
    foreach (SlickBrowserDefault::viewsSettings() as $key => $value) {
      $options[$key] = ['default' => $value];
    }
    return $options + parent::defineOptions();
  }

  /**
   * Overrides StylePluginBase::buildOptionsForm().
   */
  public function buildOptionsForm(&$form, FormStateInterface $form_state) {
    $definition = [
      'caches'    => FALSE,
      'namespace' => 'slick',
      'grid_form' => TRUE,
      'settings'  => $this->options,
      'style'     => TRUE,
    ];

    // @todo Adds field handlers to reduce configuration if time permits.
    $this->admin()->buildSettingsForm($form, $definition);
    unset($form['layout']);

    $title = '<p class="form__header form__title">';
    $title .= $this->t('Use filter Slick Browser to have a view switcher. <small>Add one under <strong>Filter criteria</strong> section.</small>');
    $title .= '</p>';
    $form['opening']['#markup'] = '<div class="form--slick form--style form--views form--half b-tooltip">' . $title;

    if (isset($form['style']['#description'])) {
      $form['style']['#description'] .= ' ' . $this->t('Ignored if Slick Browser view filter has only list (table-like) enabled.');
    }
  }

  /**
   * Provides commons settings for the style plugins.
   */
  protected function buildSettings() {
    $settings = parent::buildSettings();
    $blazies  = $settings['blazies'];

    // Prepare needed settings to work with.
    $settings['_browser']     = TRUE;
    $settings['item_id']      = static::$itemId;
    $settings['namespace']    = static::$namespace;
    $settings['overridables'] = array_filter($settings['overridables']);

    $blazies->set('is.browser', TRUE)
      ->set('item.id', static::$itemId)
      ->set('namespace', static::$namespace);

    return $settings;
  }

  /**
   * Overrides StylePluginBase::render().
   */
  public function render() {
    $settings = $this->buildSettings();
    $elements = [];

    foreach ($this->renderGrouping($this->view->result, $settings['grouping']) as $rows) {
      $build = $this->buildElements($settings, $rows);
      $build['#settings'] = $settings;

      // Attach media assets if a File with potential videos, or Media entity.
      if (in_array($this->view->getBaseEntityType()->id(), ['file', 'media'])) {
        $build['#attached']['library'][] = 'slick_browser/media';
      }
      $elements = $this->manager->build($build);
      unset($build);
    }
    return $elements;
  }

  /**
   * Returns slick contents.
   */
  public function buildElements(array $settings, $rows) {
    $build = [];

    foreach ($rows as $index => $row) {
      $this->view->row_index = $index;

      // @todo remove after another check.
      $settings['delta'] = $index;

      $slide = [
        '#delta'    => $index,
        '#settings' => $settings,
        'slide'     => $this->view->rowPlugin->render($row),
      ];

      $build['items'][$index] = $slide;
      unset($slide);
    }
    unset($this->view->row_index);

    return $build;
  }

}
