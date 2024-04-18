<?php

namespace Drupal\slick_browser;

use Drupal\blazy\Blazy;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element;
use Drupal\entity_browser\Entity\EntityBrowser;

/**
 * Provides SlickBrowserWidget service.
 */
class SlickBrowserWidget extends SlickBrowserAlter implements SlickBrowserWidgetInterface {

  /**
   * {@inheritdoc}
   */
  public function fieldWidgetFormAlter(array &$element, FormStateInterface $form_state, $context) {
    $settings = [];
    $plugin_id = $context['widget']->getPluginId();

    // Always assumes no "Display style" of SB widgets is enabled.
    if ($plugin_id == 'entity_browser_entity_reference') {
      $settings = $this->entityBrowserEntityReferenceFormAlter($element, $context);
    }
    elseif ($plugin_id == 'entity_browser_file') {
      $settings = $this->entityBrowserFileFormAlter($element, $context);
    }
    elseif ($plugin_id == 'media_library_widget') {
      $settings = $this->mediaLibraryWidgetFormAlter($element, $context);
    }

    // Ony proceed if we are conciously allowed via "Display style" option.
    // This settings may contain configurable third party settings.
    if (empty($settings)) {
      return;
    }

    // We are here because we are allowed to.
    // Build common settings to all supported plugins.
    // The non-image field type has 'display_field', 'description'.
    $this->widgetSettings($element, $settings, $context);
    $blazies = $settings['blazies'];

    // EB only respects field_widget_display with cardinality -1. If not, we
    // may need to override its display. Only concerns about File entity.
    // The _processed flag means SB plugin output is already processed at plugin
    // level, no further work with its display output is needed from here on.
    $file = $blazies->get('field.target_type') == 'file';
    $unlimited = $blazies->get('field.cardinality') == -1;
    $processed = $file && !$unlimited ? FALSE : TRUE;
    $blazies->set('is.sb.processed', $processed);

    // Don't bother if using label.
    if (!$blazies->use('label')) {
      // Yet only modify for EB, not core Media Library.
      if ($blazies->is('eb')) {
        $this->entityBrowserDisplay($element, $settings, $context);
      }
    }

    // Specific for EB, it might add own theme to style entity browser elements.
    $this->widgetElement($element, $settings, $context);
    $this->widgetAttach($element, $settings);
  }

  /**
   * Modifies the available widget settings.
   */
  private function widgetSettings(array &$element, array &$settings, $context) {
    $formatter   = $this->slickBrowser->formatter();
    $plugin      = $context['widget'];
    $items       = $context['items'];
    $field       = $items->getFieldDefinition();
    $entity      = $items->getEntity();
    $widgetsets  = $plugin->getSettings();
    $fieldsets   = $field->getSettings();
    $plugin_id   = $plugin->getPluginId();
    $cardinality = $field->getFieldStorageDefinition()->getCardinality();
    $grids       = ['column', 'grid', 'flex', 'nativegrid'];

    $settings['slickbrowsers'] = $sb = $formatter->settings();

    // @todo remove.
    $fieldsets['name'] = $field->getName();
    $fieldsets['type'] = $field->getType();

    $formatter_id = $settings['plugin_id_widget_formatter'] ?? '';

    Blazy::entitySettings($settings, $entity);
    $blazies = $formatter->verifySafely($settings);

    $sb->set('widget.settings', $widgetsets)
      ->set('widget.settings.plugin_id', $plugin_id)
      ->set('widget.plugin_id', $plugin_id);

    $blazies->set('field', $fieldsets, TRUE)
      ->set('field.cardinality', $cardinality)
      ->set('field.plugin_id', $formatter_id)
      ->set('field.settings', $fieldsets);

    foreach (['alt_field', 'title_field', 'target_type'] as $key) {
      $settings[$key] = $value = $fieldsets[$key] ?? FALSE;
      $blazies->set('field.' . $key, $value);
    }

    $settings['media_switch'] = 'media';
    $settings['ratio'] = 'fluid';
    $thumbnail_style = $settings['thumbnail_style'] ?? NULL;
    $settings['thumbnail_style'] = $thumbnail_style ?: 'slick_browser_thumbnail';

    // @todo remove these post Blazy:2.10.
    $settings['bundle'] = $entity->bundle();
    $settings['entity_type_id'] = $entity->getEntityTypeId();
    $settings['plugin_id_widget'] = $plugin_id;

    $data = [
      'cardinality' => $cardinality,
      'field_name' => $context['items']->getName(),
      'field_type' => $field->getType(),
      'target_type' => $fieldsets['target_type'] ?? NULL,
      'use_label' => $formatter_id == 'slick_browser_label',
      'use_slick' => ($settings['style'] ?? NULL) == 'slick',
      'use_autosubmit' => $settings['entity_type_id'] == 'media',
    ];

    foreach ($data as $key => $value) {
      $settings[$key] = $value;
    }

    $id_grid = !empty($settings['style'])
      && !empty($settings['grid'])
      && in_array($settings['style'], $grids);

    // Defaults.
    $blazies = $settings['blazies'];
    foreach ($data as $key => $value) {
      $k = $key;
      if (strpos($key, 'use_') !== FALSE) {
        $k = 'use.' . str_replace('use_', '', $key);
      }
      elseif (strpos($key, 'field_') !== FALSE) {
        $k = 'field.' . str_replace('field_', '', $key);
      }
      $blazies->set($k, $value);
    }

    $blazies->set('is.eb', FALSE)
      ->set('is.media_library', FALSE)
      ->set('is.grid', $id_grid)
      ->set('is.detached', !empty($settings['style']))
      // ->set('is.player', FALSE)
      ->set('use.tabs', FALSE)
      ->set('use.modal', FALSE)
      ->set('is.unlazy', TRUE);

    $this->slickBrowser->formatter()->preSettings($settings);

    // Entity Browser integration.
    $plugins = ['entity_browser_entity_reference', 'entity_browser_file'];
    if (in_array($plugin_id, $plugins)) {
      $this->entityBrowserSettings($element, $settings, $context);
    }

    ksort($settings);
    return $settings;
  }

  /**
   * Modifies the available entity browser widget settings.
   */
  private function entityBrowserSettings(array &$element, array &$settings, $context) {
    $widgetsets = $context['widget']->getSettings();
    $blazies = $settings['blazies'];
    $sb = &$settings['slickbrowsers'];
    $settings['_browser'] = TRUE;

    $image_style = $settings['image_style'] ?? '';
    $settings['image_style'] = $image_style ?: ($widgetsets['preview_image_style'] ?? '');

    // Chances are SB browsers within iframes/modals, even if no SB widgets.
    // Or using any of SB field_widget_display.
    // Only EntityReferenceBrowserWidget has field_widget_display, not FBW.
    $formatter_id = $blazies->get('field.plugin_id') ?: $settings['plugin_id_widget_formatter'] ?? '';
    $playable = $formatter_id == 'slick_browser_file'
      || $formatter_id == 'slick_browser_media';

    $blazies->set('is.eb', TRUE)
      ->set('is.browser', TRUE)
      ->set('libs.media', $playable);

    // Load relevant assets based on the chosen SB browsers plugins.
    if (!empty($widgetsets['entity_browser'])) {
      $id = $widgetsets['entity_browser'];
      if ($eb = EntityBrowser::load($id)) {

        // Entity display plugins: slick_browser_file, slick_browser_media, etc.
        $internal['display'] = $eb->getDisplay()->getConfiguration();
        $internal['display']['plugin_id'] = $pid_widget_display = $eb->getDisplay()->getPluginId();
        $internal['selection_display'] = $eb->getSelectionDisplay()->getConfiguration();
        $internal['selection_display']['plugin_id'] = $eb->getSelectionDisplay()->getPluginId();
        $internal['selector'] = $eb->getWidgetSelector()->getConfiguration();
        $internal['selector']['plugin_id'] = $pid_widget_selector = $eb->getWidgetSelector()->getPluginId();

        // Selection displays: modal, iframe, form, etc.
        $use_modal = $pid_widget_display == 'modal';
        $use_tabs = $pid_widget_selector == 'slick_browser_tabs';

        $blazies->set('use.modal', $use_modal)
          ->set('use.tabs', $use_tabs);

        $sb->set('widget', $internal, TRUE);
      }
    }

    // @todo move it upstream.
    if ($current = $element['current'] ?? []) {
      $children = Element::children($current);
      $count = count($children);
      if ($items = ($current['items'] ?? [])) {
        $count = count($items);
      }

      $settings['count'] = $count;
      $blazies->set('count', $count);
    }
  }

  /**
   * Modifies the widget form element.
   */
  private function widgetElement(array &$element, array &$settings, $context) {
    $blazies = $settings['blazies'];
    $sb = $settings['slickbrowsers'];
    $attributes = &$element['#attributes'] ?? [];

    // Build the SB widgets, nothing to do with SB browsers here on.
    // This used to be "Slick Widget", moved into "Slick Browser".
    $classes = $attributes['class'] ?? [];
    $sb_classes = ['sb', 'sb--wrapper', 'sb--launcher'];
    $attributes['class'] = array_merge($sb_classes, $classes);
    $attributes['class'][] = $blazies->use('modal') ? 'sb--wrapper-inline' : 'sb--wrapper-modal';
    $skin = $settings['skin'] ?? '';
    $attributes['class'][] = $settings['style'] == 'slick' && $skin
      ? 'sb--skin--' . str_replace('_', '-', $skin)
      : 'sb--skin--static';

    if ($blazies->use('autosubmit')) {
      $attributes['class'][] = 'sb--autoselect';
    }

    // Media Library integration: plugin_id_widget = media_library_widget.
    if (isset($element['selection'])) {
      $this->mediaLibraryElement($element, $settings, $context);
    }
    // Entity Browser integration has property current.
    elseif (isset($element['current'])) {
      $this->entityBrowserElement($element, $settings, $context);
    }

    $attributes['data-sb-bundle'] = $blazies->get('entity.bundle');
    $attributes['data-sb-entity-type-id'] = $blazies->get('entity.type_id');
    $attributes['data-sb-field-type'] = $blazies->get('field.type');
    $attributes['data-sb-target-type'] = $blazies->get('field.target_type');
    $attributes['data-sb-cardinality'] = $blazies->get('field.cardinality') ?: 0;
    $attributes['data-sb-entity-browser'] = $blazies->get('field.plugin_id');
    $attributes['data-sb-plugin-id-widget'] = $sb->get('widget.plugin_id');
  }

  /**
   * Modifies the entity browser widget identified by element current.
   */
  private function entityBrowserElement(array &$element, array &$settings, $context) {
    $current = &$element['current'];

    // Prevents collapsed details from breaking lazyload.
    if (empty($element['#open'])) {
      $element['#open'] = TRUE;
      $element['#attributes']['class'][] = 'sb--wrapper-hidden';
    }

    $current['#settings']       = $settings;
    $current['#attributes']     = [];
    $current['#theme_wrappers'] = [];
    $current['#theme']          = 'slick_browser';

    // Removes table markups for regular divities.
    if ($settings['plugin_id_widget'] == 'entity_browser_file') {
      unset(
        $current['#type'],
        $current['#header'],
        $current['#tabledrag']
      );
    }
  }

  /**
   * Provides asset attachments.
   */
  private function widgetAttach(array &$element, array $settings) {
    $formatter = $this->slickBrowser->formatter();

    // Enforce Blazy to work with hidden element such as with EB selection.
    $load = $formatter->attach($settings);
    $load['drupalSettings']['blazy']['loadInvisible'] = TRUE;
    $load['library'][] = 'slick_browser/widget';

    $blazies = $settings['blazies'];
    foreach (['autosubmit', 'modal', 'slick', 'tabs'] as $key) {
      if ($blazies->use($key)) {
        $load['library'][] = 'slick_browser/' . $key;
      }
    }

    if ($blazies->is('grid')) {
      $load['library'][] = 'slick_browser/grid';
    }

    // Disable tabledrag, including FBW table CSS, for Slick/ CSS grid.
    if ($settings['plugin_id_widget'] == 'entity_browser_file') {
      $attachments = $load;
    }
    else {
      $attachments = $formatter->merge($load, $element['current'] ?? [], '#attached');
    }

    $element['#attached'] = $formatter->merge($attachments, $element, '#attached');
  }

  /**
   * Implements hook_field_widget_WIDGET_TYPE_form_alter().
   */
  private function entityBrowserEntityReferenceFormAlter(array &$element, $context) {
    $widgetsets = $context['widget']->getSettings();
    if (empty($widgetsets['field_widget_display']) || strpos($widgetsets['field_widget_display'], 'slick_browser') === FALSE) {
      return [];
    }

    $settings = $widgetsets['field_widget_display_settings'];
    $settings['plugin_id_widget_formatter'] = $widgetsets['field_widget_display'];
    return empty($settings['style']) ? [] : array_merge(SlickBrowserDefault::entitySettings(), $settings);
  }

  /**
   * Implements hook_field_widget_WIDGET_TYPE_form_alter().
   */
  private function entityBrowserFileFormAlter(array &$element, $context) {
    $widgetsets = $context['widget']->getSettings();
    if (empty($widgetsets['entity_browser']) || strpos($widgetsets['entity_browser'], 'slick_browser') === FALSE) {
      return [];
    }

    // Allows Slick Browser to remove File Browser empty table.
    $settings = SlickBrowserUtil::buildThirdPartySettings($context['widget']);
    return empty($settings['style']) ? [] : $settings;
  }

  /**
   * Implements hook_field_widget_WIDGET_TYPE_form_alter().
   */
  private function mediaLibraryWidgetFormAlter(array &$element, $context) {
    // Allows to provide configurable grids.
    $settings = SlickBrowserUtil::buildThirdPartySettings($context['widget']);
    return empty($settings['style']) ? [] : $settings;
  }

  /**
   * Prepare entity displays for entity browser.
   *
   * EB only respects field_widget_display with cardinality -1. If not, we
   * may need to override its display such as for single-value file/ media.
   */
  private function entityBrowserDisplay(array &$element, array &$settings, $context) {
    $browser = $this->slickBrowser;
    $blazies = $settings['blazies'];
    $target_type = $blazies->get('field.target_type') ?: ($settings['target_type'] ?? NULL);

    // The items property is for entity, not file image, except cardinality -1.
    // Cannot rely on $context['items'] for AJAX results. The entity_browser
    // property is only available for:
    // File, indexed by entity ID: cardinality -1 and > 1, but not 1,
    // Media, grouped by items property: cardinality -1, but not 1, nor > 1.
    $entities = $element['entity_browser']['#default_value'] ?? [];
    if (empty($entities) && isset($element['current'])) {
      if ($children = Element::children($element['current'])) {

        // Maybe empty, but items is always set.
        // File is never here.
        // Media, grouped by items property: cardinality 1, > 1, not -1.
        $items = $element['current']['items'] ?? [];
        if ($items && $subchildren = Element::children($items)) {
          foreach ($subchildren as $delta) {
            $sets = $settings;
            $sets['delta'] = $delta;

            if ($entity = ($items[$delta]['display']['#entity'] ?? NULL)) {
              $this->entityDisplay($element, $sets, $entity, $delta);
            }
          }
        }
        else {
          // Indexed by entity ID.
          // File, indexed by entity ID: cardinality 1.
          foreach ($children as $delta => $id) {
            $sets = $settings;
            $sets['delta'] = $delta;

            if ($entity = $browser->formatter()->load($id, $target_type)) {
              $this->entityDisplay($element, $sets, $entity, $delta);
            }
          }
        }
      }
    }
    else {
      // Hence we have entities, except single file image.
      // File, indexed by entity ID: cardinality -1 and > 1, but not 1,
      // Media, grouped by items property: cardinality -1, but not 1, nor > 1.
      foreach ($entities as $delta => $entity) {
        $sets = $settings;
        $sets['delta'] = $delta;

        $this->entityDisplay($element, $sets, $entity, $delta);
      }
    }
  }

  /**
   * Prepares entity item display, applicable to EB and Media Library.
   */
  private function entityDisplay(array &$element, array &$settings, $entity, $delta = 0) {
    $content = [];
    // @todo $browser = $this->slickBrowser;
    // $blazies = $settings['blazies'];
    // $langcode = $blazies->get('language.current') ?: 'en';
    // $entity = $browser->formatter()->getTranslatedEntity($entity, $langcode);
    /*
    // If not already processed, proceed. Processed means plugin is respected
    // which is currently not the case given different cardinality for File.
    if (!$blazies->is('sb.processed')) {
    $data['#entity'] = $entity;
    $data['#settings'] = $settings;
    $data['fallback'] = $label;

    if (isset($element['selection'])) {
    $blazies->set('item.id', 'sb');

    $data['#wrapper_attributes']['class'][] = 'grid__content';
    $data['#media_attributes']['class'][] =
    'sb__preview media-library-item__preview js-media-library-item-preview';
    $data['overlay']['sb_label']['#markup'] =
    '<div class="sb__label">' . $label . '</div>';
    }

    $display = $browser->blazyEntity()->build($data);

    $settings = $data['#settings'];
    $display_settings = $display['#settings'] ?? [];
    $display['#settings'] = $browser->formatter()
    ->merge($display_settings, $settings);
    }
     */

    // EB put them in items property for cardinality -1 + entity, not image.
    // Do not modify anything if already processed such as cardinality -1.
    if (isset($element['current'])) {
      if (isset($element['current']['items'])) {
        $content = &$element['current']['items'][$delta];
      }
      else {
        // @todo recheck if should use translated entity here.
        $content = &$element['current'][$entity->id()];
      }

      // If ($display) {
      // $content['display'] = $display;
      // }.
    }
    /*
    elseif (isset($element['selection'])) {
    // $content = &$element['selection'][$delta];
    if ($display) {
    // $content['rendered_entity'] = $display;
    $element['selection'][$delta]['display'] = $display;
    $element['selection'][$delta]['rendered_entity'] = [];
    }
    }
     */
  }

  /**
   * Modifies the available media library widget settings.
   *
   * Unlike EB with full override, this is all we do with Media Library for now.
   * Basically making the Media Library grid configurable, and blazy-enabled.
   */
  private function mediaLibraryElement(array &$element, array $settings, $context) {
    $browser = $this->slickBrowser;
    $blazies = $settings['blazies'];

    $blazies->set('is.media_library', TRUE)
      ->set('is.grid', TRUE);

    if (isset($element['selection'])) {
      $selection = &$element['selection'];
      $attributes = &$selection['#attributes'];

      $children = Element::children($selection);
      $settings['count'] = $count = count($children);

      $blazies->set('count', $count);

      $browser->formatter()->gridAttributes($attributes, $settings);

      // Respects anyone adding a suffix here.
      $zoom = '<div class="sb__zoom"></div>';
      if (isset($selection['#suffix'])) {
        $selection['#suffix'] .= $zoom;
      }
      else {
        $selection['#suffix'] = $zoom;
      }

      // Cannot use content_attributes, not all core themes have it at fieldset.
      $attributes['class'][] = 'sb sb--widget';
      if ($children) {
        foreach ($children as $delta) {
          $sets = $settings;
          $sets['delta'] = $delta;

          $blazy = $sets['blazies']->reset($sets);
          $blazy->set('delta', $delta);

          $item = &$selection[$delta];
          $item_attrs = &$item['#attributes'];

          $item_attrs['class'][] = 'grid';
          $item_attrs['class'][] = 'grid--sb';
          $item_attrs['class'][] = 'grid--' . $delta;

          $rendered = $item['rendered_entity'] ?? NULL;
          $entity = ($rendered['#media'] ?? NULL);

          if ($rendered && $entity) {
            $blazy->set('is.sb.processed', FALSE);
            $output = $this->mediaLibraryDisplay($rendered, $sets, $entity, $delta);
            $element['selection'][$delta]['rendered_entity'] = $output;
          }
        }
      }
    }
  }

  /**
   * Prepares entity item display, applicable to EB and Media Library.
   */
  private function mediaLibraryDisplay(array $element, array $settings, $entity, $delta = 0) {
    $browser = $this->slickBrowser;
    $blazies = $settings['blazies'];
    // @todo $langcode = $blazies->get('language.current') ?: 'en';
    // $entity = $browser->formatter()->getTranslatedEntity($entity, $langcode);
    $label = $entity->label();

    // If not already processed, proceed. Processed means plugin is respected
    // which is currently not the case given different cardinality for File.
    if (!$blazies->is('sb.processed')) {
      $blazies->set('cache.metadata', $element['#cache'] ?? [], TRUE);
      $data = [];

      /** @var \Drupal\file\Entity\File $entity */
      $data['#entity']   = $entity;
      $data['#delta']    = $delta;
      $data['#settings'] = $settings;
      $data['fallback']  = $label;

      $blazies->set('item.id', 'sb')
        ->set('is.cache_deferred', TRUE);

      $data['#wrapper_attributes']['class'][] = 'grid__content';
      $data['#media_attributes']['class'][] = 'sb__preview media-library-item__preview js-media-library-item-preview';
      $data['overlay']['sb_label']['#markup'] = '<div class="sb__label">' . $label . '</div>';

      // $settings = $data['#settings'];
      // $display_settings = $display['#settings'] ?? [];
      // $display['#settings'] = $browser->formatter()
      // ->merge($display_settings, $settings);
      $output  = $browser->blazyEntity()->build($data);
      $blazies = $data['#settings']['blazies'];

      $output['#weight'] = $element['#weight'] ?? 0;
      $output['#cache'] = $blazies->get('cache.metadata', []);
      return $output;
    }
    return $element;
  }

}
