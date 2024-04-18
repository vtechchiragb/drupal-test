<?php

/**
 * @file
 * Hooks and preprocess functions for the Slick Browser module.
 */

use Drupal\Component\Serialization\Json;
use Drupal\Core\Render\Element;
use Drupal\slick_browser\SlickBrowserDefault as Defaults;
use Drupal\slick_browser\SlickBrowserUtil;

/**
 * Prepares variables for slick-browser.html.twig templates.
 *
 * @todo Core image, Focal Point, Crop integration outside EB.
 */
function template_preprocess_slick_browser(&$variables) {
  $element = $variables['element'];

  // Pre 2.10 only used variables were added, now many in case needed.
  foreach (Defaults::themeProperties() as $key => $default) {
    $k = $key == 'items' ? 'items' : "#$key";
    $variables[$key] = $element[$k] ?? $default;
  }

  $widgets   = $build = $draggables = $thumbs = [];
  $content   = &$variables['content'];
  $settings  = &$variables['settings'];
  $settings += Defaults::htmlSettings();
  $manager   = slick_browser()->manager();

  $manager->verifySafely($settings);
  $blazies = $settings['blazies'];
  $sb = &$settings['slickbrowsers'];

  // Get our list of widgets in order (needed when the form comes back after
  // preview or failed validation).
  // Image is stored as indexed children, media as items.
  $items = empty($variables['items']) ? $element : $variables['items'];
  foreach (Element::children($items) as $key) {
    $widgets[] = &$items[$key];
  }

  // Sort the items if required.
  if ($sb->get('widget.plugin_id') != 'entity_browser_entity_reference') {
    usort($widgets, '_field_multiple_value_form_sort_helper');
  }

  // Provides basic settings.
  $count      = count($widgets);
  $uploading  = isset($element['#file_upload_delta']);
  $element_id = $element['#id'];

  $settings['count'] = $count;
  $blazies->set('count', $count)
    ->set('total', $count)
    ->set('css.element_id', $element_id);

  $sb->set('is.uploading', $uploading);

  // Massage settings.
  _slick_browser_massage_settings($variables, $settings);

  foreach ($widgets as $delta => &$widget) {
    $sets = $settings;
    $blazy = $sets['blazies']->reset($sets);
    $blazy->set('delta', $delta);
    $sets['delta'] = $delta;

    // EB uses 'display' while core Image 'preview', get them consistent here.
    if (isset($widget['display'])) {
      $widget['preview'] = $widget['display'];
      unset($widget['display']);
    }

    if ($blazy->is('eb')) {
      if ($defaults = $widget['#attributes']['class'] ?? []) {
        $classes = ['item-container', 'draggable'];
        $widget['#attributes']['class'] = array_diff($defaults, $classes);
      }
    }
    else {
      // Save the uploading row for last, for image widget, not entity browser.
      if (isset($widget['#files']) && empty($widget['#files'])) {
        if (isset($element['#file_upload_title'])) {
          $widget['#title'] = $element['#file_upload_title'];
          $widget['#description'] = $manager->renderer()->renderPlain($element['#file_upload_description']);
        }

        foreach (Element::children($widget) as $sub_key) {
          if (!in_array($sub_key, ['display', 'fids', 'upload', 'upload_button'])) {
            unset($widget[$sub_key]);
          }
        }

        continue;
      }
    }

    // Masages widget value.
    _slick_browser_prepare_widget_item($widget, $sets, $delta);

    // Pass $thumbs to container.
    if (isset($widget['thumb'])) {
      hide($widget['thumb']);
      $thumbs[] = $widget['thumb'];
    }

    // Build the widget slides.
    $build['items'][$delta] = $widget;

    // We don't do early rendering, hide em all now.
    foreach (Element::children($widget) as $sub_key) {
      hide($widget[$sub_key]);
    }

    // Place _weight and thumb into sortable element.
    if ($sb->is('sortable')) {
      $draggables[] = _slick_browser_get_draggable($widget, $sets);
    }
  }

  // Build the thumbnails.
  $nav = $blazies->is('nav');
  if ($nav && $thumbs) {
    _slick_browser_build_thumb($build, $thumbs, $settings);
  }
  else {
    $settings['nav'] = FALSE;
    $blazies->set('is.nav', FALSE);
  }

  // Pass variables to template.
  $content['header'] = $content['main'] = [];

  // Build buttons.
  $buttons = _slick_browser_get_buttons($settings);

  // Build draggable.
  $content['draggable'] = _slick_browser_build_draggables($buttons, $draggables);

  $build['#settings'] = $settings;
  if ($count > 1) {
    $build['options']['initialSlide'] = $sb->get('end');
  }
  if (!empty($build['items'])) {
    // Provide Blazy attributes for the containing element.
    $blazy_data = '';
    $preview = $build['items'][0]['preview'] ?? [];

    if (!empty($preview['#uri'])) {
      // @todo $item = isset($preview['#item']) ? $preview['#item'] : NULL;
      $_uri = $preview['#uri'];
      $blazies->set('first.uri', $_uri);
    }

    $variables['attributes']['data-blazy'] = $blazy_data ? Json::encode($blazy_data) : '';

    $style = $settings['style'] ?? '';
    if ($style) {
      // $attrs['class'][] = 'sb__grid';
      $item_attrs['class'][] = 'grid--sb';

      // If ($style != 'single') {
      // $attrs['class'][] = 'sb__sortable';
      // }.
      // $blazies->set('grid.attributes', $attrs);.
      $blazies->set('grid.item_attributes', $item_attrs);
    }

    switch ($style) {
      case 'column':
      case 'grid':
      case 'flex':
      case 'nativegrid':
        $content['main'] = $manager->buildGrid($build['items'], $settings)[0]['slide'];

        // Prevents collapsed details from breaking lazyload.
        $load = $manager->attach($settings);
        $load['drupalSettings']['blazy']['loadInvisible'] = TRUE;
        $content['main']['#attached'] = $load;
        break;

      case 'single':
      case 'slick':
        $content['main'] = $manager->build($build);
        break;
    }

    $content['header'] = _slick_browser_build_buttons($buttons);
  }

  $variables['items']   = $items;
  $variables['blazies'] = $settings['blazies']->storage();
  $variables['sb']      = $settings['slickbrowsers']->storage();
}

/**
 * Prepares variables for slick-vanilla--browser.html.twig templates.
 */
function template_preprocess_slick_vanilla__browser(array &$variables) {
  $settings = &$variables['settings'];
  $item = $variables['item'];

  if (empty($item)) {
    return;
  }

  $attributes = &$variables['attributes'];
  if (!isset($attributes['data-row-id'])) {
    $attributes['data-row-id'] = $variables['delta'];
  }

  // Group item for easy placement while considering the different
  // structures between core Image and Entity browser. Reset item.
  $variables['item'] = $sub_item = [];
  foreach (Element::children($item) as $child) {
    $sub_item[$child] = &$item[$child];

    $fid = 0;
    if (in_array($child, ['upload', 'upload_button'])) {
      unset($sub_item[$child]);
    }

    foreach (Defaults::widgetButtons() + ['display_field'] as $sub_key) {
      if (isset($sub_item[$sub_key])) {
        if (!empty($sub_item[$sub_key]['#access'])) {
          $variables['item']['action'][$sub_key] = $sub_item[$sub_key];
        }
        unset($sub_item[$sub_key]);
      }
    }

    if (!empty($settings['grid']) && isset($sub_item['_weight'])) {
      show($sub_item['_weight']);
      $variables['item']['action']['_weight'] = $sub_item['_weight'];
      unset($sub_item['_weight']);
    }

    if (isset($sub_item['meta'])) {
      // Must not use show() to avoid dup.
      $variables['item']['meta'] = $sub_item['meta'];
      unset($sub_item['meta']);
    }

    if (isset($sub_item['#files'])) {
      $file = reset($sub_item['#files']);
      $fid = $file->id();
      $variables['item']['meta']['file_' . $fid]['filename']['#suffix'] = '<span class="file-size"> [' . format_size($file->getSize()) . ']</span> ';
    }

    $meta = [
      'fids',
      'focal_point',
      'width',
      'height',
      'alt',
      'title',
      'file_' . $fid,
      'filename',
    ];

    foreach ($meta as $sub_key) {
      if (isset($sub_item[$sub_key])) {
        $variables['item']['meta'][$sub_key] = $sub_item[$sub_key];
        unset($sub_item[$sub_key]);
      }
    }

    // Respects what we know nothing about.
    if (isset($sub_item[$child])) {
      $variables['item'][$child] = $sub_item[$child];
      unset($sub_item[$child]);
    }
  }
}

/**
 * Massages settings.
 */
function _slick_browser_massage_settings(array &$variables, array &$settings) {
  $blazies = $settings['blazies'];
  $sb = &$settings['slickbrowsers'];

  // This is because empty file upload is counted one.
  $count = $blazies->get('count') ?: 0;
  $cardinality = $blazies->get('field.cardinality') ?: 0;
  $field_name = $blazies->get('field.name');
  $multiple = $cardinality != 1;

  if ($sb->is('uploading')) {
    $count = $count > 1 ? ($count - 1) : $count;
  }
  if (!$multiple) {
    $count = 1;
  }

  $nav = !empty($settings['optionset_thumbnail']) && $count > 1 && $multiple;
  $field_name_css = str_replace('_', '-', $field_name);

  // Vanilla is on, rebuild own logic to support asnavfor as needed.
  $settings['id'] = $id = 'sb-slick-' . $field_name_css;
  $settings['display'] = 'main';
  $is_text = !empty($settings['alt_field']) || !empty($settings['title_field']);
  $grids = ['column', 'grid', 'flex', 'nativegrid'];

  $blazies->set('css.id', $id)
    ->set('is.blazy', TRUE)
    ->set('is.vanilla', TRUE)
    ->set('is.grid', FALSE)
    ->set('is.noscript', FALSE);

  $sb->set('is.text', $is_text)
    ->set('is.widget', TRUE);

  // @todo remove settings after another check.
  $settings['noscript'] = $settings['_grid'] = FALSE;

  if ($settings['style'] == 'slick') {
    $settings['grid']
      = $settings['grid_small']
        = $settings['grid_medium']
          = $settings['visible_items']
            = '';
  }
  elseif (in_array($settings['style'], $grids)) {
    $blazies->set('is.grid', TRUE)
      ->set('is.unslick', TRUE);

    $settings['unslick'] = TRUE;

    // Provides sensible defaults for the ignorant who doesn't provide Grid as
    // otherwise confusingly invisible items.
    if (empty($settings['grid'])) {
      $settings['grid']        = 3;
      $settings['grid_medium'] = 2;
      $settings['grid_small']  = 1;
    }

    if (empty($settings['visible_items'])) {
      $settings['visible_items'] = 12;
    }
  }

  // Pass the settings to template.
  $element_id = $blazies->get('css.element_id');
  $settings['skin_widget'] = $settings['skin'] ?? '';
  $weight_class = $element_id . '-weight';
  $sortable = empty($settings['grid']) && $count > 1 && $multiple;

  $sb->set('is.sortable', $sortable);
  $sb->set('weight_class', $weight_class);

  // Update attributes.
  $sbend = $sb->is('uploading') ? ($count - 2) : ($count - 1);
  if ($count > 1) {
    $variables['attributes']['data-end'] = $sbend;
  }

  $sb->set('end', $sbend);

  // Defines ID if not provided.
  $variables['attributes']['id'] = $element_id;
  $variables['attributes']['data-drupal-selector'] = $element_id;

  $blazies->set('is.nav', $nav)
    ->set('item.id', 'slide')
    ->set('lazy.id', 'blazy')
    ->set('count', $count);

  // @todo remove settings after migrations.
  $settings['count']   = $count;
  $settings['nav']     = $nav;
  $settings['item_id'] = 'slide';
  $settings['lazy']    = 'blazy';
}

/**
 * Massages widget value.
 */
function _slick_browser_prepare_widget_item(array &$widget, array $settings, $delta) {
  $manager = slick_browser()->formatter();
  $preview = &$widget['preview'];
  $blazies = $settings['blazies'];
  $sb = $settings['slickbrowsers'];
  $target_type = $blazies->get('field.target_type');
  $uri = $blazies->get('image.uri');

  // Provide ImageItem.
  $item = $manager->toHashtag($preview['#build'] ?? [], 'item', NULL)
    ?: $manager->toHashtag($preview, 'item', NULL);

  // Adds thumbnail elements for each entity.
  if ($uri) {
    if (empty($preview['#uri'])) {
      $preview['#uri'] = $uri;
    }

    // Add small thumbnails for either asNavFor, or custom draggable elements.
    $tn_style = $settings['thumbnail_style'] ?? NULL;
    $settings['thumbnail_style'] = $tn_style ?: 'slick_browser_thumbnail';
    $widget['thumb'] = slick_browser()->formatter()->getThumbnail($settings, $item);
  }

  // Self-closed elements cannot be iconized, add the wrappers.
  foreach (Defaults::widgetButtons() as $button) {
    if (isset($widget[$button])) {
      SlickBrowserUtil::wrapButton($widget[$button], $button);
    }
  }

  // Delay rendering of the weight selector, so that can be rendered later.
  if (isset($widget['_weight'])) {
    if (empty($settings['grid'])) {
      hide($widget['_weight']);
    }

    $classes = [$sb->get('weight_class'), 'sb__weight'];
    $widget['_weight']['#attributes']['class'] = $classes;
    $widget['_weight']['#attributes']['data-slick-index'] = $delta;
    $widget['_weight']['#wrapper_attributes']['class'][] = 'visually-hidden';
  }

  // Arrange the row without the normal form_element wrappers.
  unset($widget['#theme'], $widget['#theme_wrappers']);

  // Makes grids draggable.
  if (!empty($settings['grid']) && isset($widget['#attributes'])) {
    $attributes = &$widget['#attributes'];
    $attributes['tabindex'] = -1;
    $attributes['class'][] = 'sb__sortitem';
    $attributes['class'][] = 'js-form-managed-file';
    $attributes['class'][] = 'form-managed-file';
    // $attributes['class'][] = 'grid--sb';
    // If using Blazy::grid, not Slick grid.
    if ($delta) {
      $attributes['class'][] = 'grid--' . $delta;
    }

    if ($target_type) {
      $attributes['class'][] = 'grid--' . str_replace('_', '-', $target_type);
    }
  }

  // Pass to theme_slick_grid(), theme_slick_slide() as plain array.
  // @todo remove when slick uses # instead.
  if (isset($widget['#attributes'])) {
    $widget['attributes'] = $widget['#attributes'];
  }

  $label = $widget['filename'] ?? '';
  $widget['preview'] = slick_browser()->toBlazy($preview, $settings, $delta, $label);
}

/**
 * Provides thumb navigation if so configured.
 */
function _slick_browser_build_thumb(array &$build, array $thumbs, array $settings) {
  $sb = &$settings['slickbrowsers'];

  foreach ($thumbs as $delta => &$thumb) {
    show($thumb);
    $slide = [];
    $slide[$settings['item_id']]['#markup'] = slick_browser()->formatter()->renderer()->render($thumb);
    $build['thumb']['options']['initialSlide'] = $sb->get('end');
    $build['thumb']['items'][$delta] = $slide;
    unset($slide);
  }
}

/**
 * Prepares buttons if any.
 */
function _slick_browser_get_buttons(array $settings) {
  $blazies = $settings['blazies'];
  $sb = &$settings['slickbrowsers'];

  $buttons = [];
  if (isset($settings['crop_list'])) {
    $buttons['crop'] = 'Crop';
  }

  if ($blazies->get('field.cardinality') != 1) {
    if ($sb->is('text')) {
      $buttons['caption'] = 'Text';
    }

    $buttons['removeall'] = 'Remove all';
  }

  return $buttons;
}

/**
 * Builds buttons if any.
 */
function _slick_browser_build_buttons(array $buttons) {
  $actions = [];
  if ($buttons) {
    foreach ($buttons as $key => $title) {
      $actions[$key . '_button'] = [
        '#type' => 'button',
        '#value' => t('@title', ['@title' => $title]),
        '#submit' => [],
        '#attributes' => [
          'class' => ['button--sb', 'button--js', 'button--' . $key],
          'data-target' => $key,
        ],
      ];
    }
  }
  return $actions;
}

/**
 * Returns a draggable item.
 */
function _slick_browser_get_draggable(array &$widget, array $settings) {
  $blazies = $settings['blazies'];
  $sb = $settings['slickbrowsers'];

  $draggable = $attributes = [];
  if (isset($widget['_weight']) && empty($settings['grid'])) {
    show($widget['_weight']);
    $draggable[] = $widget['_weight'];
    unset($widget['_weight']);
  }

  // Provides the draggable thumbnails, if any.
  if (isset($widget['thumb'])) {
    if ($sb->is('sortable')) {
      show($widget['thumb']);
      $draggable[] = $widget['thumb'];
    }

    unset($widget['thumb']);
  }

  if (!isset($widget['thumb']) && isset($widget['filename'])) {
    // At least we need something for custom draggable elements.
    $filename = is_string($widget['filename']) ? $widget['filename'] : $widget['filename']['#markup'];
    $draggable[] = ['#markup' => '<span class="slide__filename">' . $filename . '</span>'];
  }

  if (isset($widget['#attributes'])) {
    $attributes = $widget['#attributes'];
  }

  $attributes['class'][] = 'slide sb__sortitem';
  if (!isset($attributes['data-row-id'])) {
    $attributes['data-row-id'] = $blazies->get('delta');
  }

  return $draggable ? [
    '#markup' => slick_browser()->formatter()->renderer()->render($draggable),
    '#wrapper_attributes' => $attributes,
  ] : [];
}

/**
 * Provides draggable items if any.
 */
function _slick_browser_build_draggables(array &$buttons, array $draggables = []) {
  $content = [];
  if ($draggables) {
    $content = [
      '#theme' => 'item_list',
      '#items' => $draggables,
      '#wrapper_attributes' => [
        'class' => ['sb__sortlist'],
      ],
      '#attributes' => [
        'class' => ['sb__sortable', 'clearfix'],
      ],
    ];

    $buttons += [
      'sort' => 'Sort',
      'done' => 'Done',
    ];
  }
  return $content;
}
