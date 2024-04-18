<?php

namespace Drupal\slick_browser;

use Drupal\blazy\BlazyEntityInterface;
use Drupal\blazy\Field\BlazyField;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\slick\Form\SlickAdminInterface;
use Drupal\slick\SlickFormatterInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Defines a Slick Browser.
 */
class SlickBrowser implements SlickBrowserInterface {

  use StringTranslationTrait;

  /**
   * The slick admin.
   *
   * @var \Drupal\slick\Form\SlickAdminInterface
   */
  protected $slickAdmin;

  /**
   * The slick field formatter manager.
   *
   * @var \Drupal\slick\SlickFormatterInterface
   */
  protected $formatter;

  /**
   * The blazy entity manager.
   *
   * @var \Drupal\blazy\BlazyEntityInterface
   */
  protected $blazyEntity;

  /**
   * The current page path.
   *
   * @var string
   */
  protected $currentPath;

  /**
   * Constructs a SlickBrowser instance.
   */
  public function __construct(
    BlazyEntityInterface $blazy_entity,
    SlickAdminInterface $slick_admin,
    SlickFormatterInterface $formatter
  ) {
    $this->blazyEntity = $blazy_entity;
    $this->slickAdmin = $slick_admin;
    $this->formatter = $formatter;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('blazy.entity'),
      $container->get('slick.admin'),
      $container->get('slick.formatter')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function slickAdmin() {
    return $this->slickAdmin;
  }

  /**
   * {@inheritdoc}
   */
  public function manager() {
    return $this->slickAdmin->manager();
  }

  /**
   * {@inheritdoc}
   */
  public function formatter() {
    return $this->formatter;
  }

  /**
   * {@inheritdoc}
   */
  public function blazyManager() {
    return $this->formatter;
  }

  /**
   * {@inheritdoc}
   */
  public function blazyEntity() {
    return $this->blazyEntity;
  }

  /**
   * {@inheritdoc}
   */
  public function buildWigetSettingsForm(array &$form, array $definition) {
    $this->checkFieldDefinitions($definition);

    $cardinality = $definition['cardinality'] ?? '';
    $plugin_id_widget = $definition['plugin_id_widget'] ?? '';
    $plugin_id_widget = $definition['plugin_id_entity_display'] ?? $plugin_id_widget;
    $target_type = $definition['target_type'] ?? '';

    $definition['grid_form'] = $cardinality != 1;
    $definition['grid_simple'] = TRUE;
    $definition['no_layouts'] = TRUE;
    $definition['no_grid_header'] = TRUE;
    $definition['responsive_image'] = FALSE;
    $definition['style'] = TRUE;
    $definition['vanilla'] = FALSE;
    $definition['libraries'] = ['slick_browser/admin'];

    if ($target_type == 'file') {
      $definition['no_view_mode'] = !$this->formatter->moduleExists('file_entity');
    }

    // Build form elements.
    $this->slickAdmin->buildSettingsForm($form, $definition);
    $settings = $definition['settings'] ?? [];

    // $form['#attached']['library'][] = 'slick_browser/admin';
    $field_name = $definition['field_name'] ?? $settings['field_name'] ?? '';
    if ($field_name) {
      $form['field_name'] = [
        '#type' => 'hidden',
        '#default_value' => $field_name,
      ];
    }

    // Slick Browser can display a plain static grid or slick carousel.
    if (isset($form['style'])) {
      $form['opening']['#prefix'] = '<h3>' . $this->t('Slick Browser') . '</h3><p>' . $this->t('To disable, leave Display style empty.') . '</p>';
      $description = $form['style']['#description'] ?? '';

      if (strpos($plugin_id_widget, 'slick_browser') !== FALSE) {
        $form['style']['#options']['slick'] = $this->t('Slick Carousel');
        $description .= ' ' . $this->t('Both do not carousel unless choosing <strong>Slick carousel</strong>. Requires the above relevant "Entity browser" plugin containing "Slick Browser" in the name, otherwise useless.');
      }

      $form['style']['#description'] = $description . ' ' . $this->t('Leave empty to disable Slick Browser widget.');

      // Single image preview should only have one option.
      if ($cardinality == 1) {
        $form['style']['#options'] = [];
        $form['style']['#options']['single'] = $this->t('Single Preview');
      }
    }

    // Use a specific widget group skins to avoid conflict with frontend.
    if (isset($form['skin'])) {
      $form['skin']['#options'] = $this->slickAdmin->getSkinsByGroupOptions('widget');
      $form['skin']['#description'] .= ' <br>' . $this->t('<b>Widget: Split</b> is best for Image field which has Alt and Title defined so that the display can be split/ shared with image preview. <br><b>Widget: Grid</b> for multi-value fields, not single.');
    }

    // Removes Grid Browser which is dedicated for the browser, not widget.
    if (isset($form['optionset']) && isset($form['optionset']['#options']['grid_browser'])) {
      unset($form['optionset']['#options']['grid_browser']);
    }

    if (isset($form['view_mode'])) {
      $form['view_mode']['#weight'] = 22;
      $form['view_mode']['#description'] = $this->t('Will fallback to this view mode, else entity label. Be sure to enable and configure the view mode. Leave it Default if unsure.');
    }

    if (isset($form['image_style'])) {
      // The media_library_widget has no image style defined.
      $form['image_style']['#description'] = $this->t('Choose image style for the preview, if applicable. If any defined above, this will override it.');
    }

    if (isset($form['thumbnail_style'])) {
      $form['thumbnail_style']['#description'] = $this->t('Required if Optionset thumbnail is provided. Leave empty to not use thumbnails.');
    }

    if ($target_type && !in_array($target_type, ['file', 'media'])) {
      unset($form['image_style'], $form['thumbnail_style']);
    }

    // Exclude fancy features.
    $excludes = [
      // 'box_style',
      'elevatezoomplus',
      // 'layout',
      // 'loading',
      // 'media_switch',
      // 'preload',
      // 'preserve_keys',
      // 'ratio',
      'thumbnail_effect',
      // 'visible_items',
      'use_theme_field',
    ];
    foreach ($excludes as $key) {
      if (isset($form[$key])) {
        unset($form[$key]);
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public function preprocessViewsView(&$variables) {
    $view = $variables['view'];
    if ($plugin_id = $view->getStyle()->getPluginId()) {
      if ($plugin_id == 'slick_browser') {
        $variables['attributes']['class'][] = 'sb view--sb';

        // Adds class based on entity type ID for further styling.
        if ($entity_type = $view->getBaseEntityType()->id()) {
          $variables['attributes']['class'][] = 'view--' . str_replace('_', '-', $entity_type);
        }

        // Adds class based on pager to position it either fixed, or relative.
        if ($pager_id = $view->getPager()->getPluginId()) {
          $variables['attributes']['class'][] = 'view--pager-' . str_replace('_', '-', $pager_id);
        }
      }
    }

    // Adds the active grid/ list (table-like) class regardless style plugin.
    if (isset($view->exposed_widgets['#sb_settings'])) {
      $variables['attributes']['class'][] = 'view--sb-' . $view->exposed_widgets['#sb_settings']['active'];
    }
  }

  /**
   * {@inheritdoc}
   */
  public function preprocessBlazy(&$variables) {
    $settings = &$variables['settings'];
    if (!empty($settings['_sb_views'])) {
      $buttons = ['select', 'info'];
      $variables['postscript']['sb_buttons'] = SlickBrowserUtil::buildButtons($buttons);
    }
  }

  /**
   * Returns available bundles.
   *
   * @todo use BlazyField::getAvailableBundles($field) post blazy:2.17.
   */
  public function getAvailableBundles($field): array {
    $target_type = $field->getSetting('target_type');
    $views_ui    = $field->getSetting('handler') == 'default';
    $handlers    = $field->getSetting('handler_settings');
    $targets     = $handlers ? ($handlers['target_bundles'] ?? []) : [];
    $bundles     = $views_ui ? [] : $targets;

    // Fix for Views UI not recognizing Media bundles, unlike Formatters.
    if (empty($bundles)
      && $target_type
      && $service = $this->formatter->service('entity_type.bundle.info')) {
      $bundles = $service->getBundleInfo($target_type);
    }

    return $bundles;
  }

  /**
   * Checks for the current definitions with various AJAX contents.
   *
   * @see /admin/structure/types/manage/page/form-display
   */
  public function checkFieldDefinitions(array &$definition) {
    $field = $definition['field_definition'] ?? NULL;

    if (!$field) {
      return;
    }

    $target_type = $field->getSetting('target_type');
    $definition['cardinality'] = $cardinality = $field->getFieldStorageDefinition()->getCardinality();
    $multiple = $cardinality == -1 || $cardinality > 1;

    BlazyField::settings($definition, $field);
    $settings = $definition['settings'];
    $blazies = $definition['blazies'];

    $is_grid = !empty($settings['style'])
      && !empty($settings['grid']);

    $blazies->set('cardinality', $cardinality)
      ->set('is.grid', $is_grid)
      ->set('is.multiple', $multiple);

    $bundles = $this->getAvailableBundles($field);
    if ($bundles && $target_type == 'media') {
      $definition['fieldable_form'] = TRUE;
      $definition['multimedia'] = TRUE;
      $definition['images'] = $this->getFieldOptions($bundles, ['image'], $target_type);
    }
  }

  /**
   * Returns fields as options. Passing empty array will return them all.
   *
   * @return array
   *   The available fields as options.
   */
  public function getFieldOptions(array $bundles = [], array $names = [], $target_type = NULL): array {
    return $this->slickAdmin->getFieldOptions($bundles, $names, $target_type);
  }

  /**
   * Overrides image style since preview is not always available.
   *
   * Not called after AJAX.
   */
  public function toBlazy(array $display, array $sets, $delta = 0, $label = NULL): array {
    $blazies = $sets['blazies'];

    // Convert core image formatter to theme_blazy for consistency.
    if ($style = $display['#style_name'] ?? NULL) {
      $sets['image_style'] = $sets['image_style'] ?: $style;
      foreach (['height', 'width', 'uri'] as $key) {
        $value = $display['#' . $key] ?? NULL;
        $sets[$key] = $value;
        $blazies->set('image.' . $key, $value);
      }

      $build = [];
      $sets['delta'] = $delta;
      $blazies->set('delta', $delta);

      if ($label) {
        $ib_label = [
          '#theme' => 'container',
          '#attributes' => ['class' => ['sb__label']],
          '#children' => $label,
        ];

        $build['overlay']['sb__label'] = $ib_label;
      }

      // $data['wrapper_attributes']['class'][] = 'grid__content';
      // $build['media_attributes']['class'][] = 'sb__preview';
      $build['#delta'] = $delta;
      $build['#settings'] = $sets;

      return $this->formatter->getBlazy($build);
    }
    return $display;
  }

}
