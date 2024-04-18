<?php

namespace Drupal\slick_browser;

use Drupal\slick\SlickDefault;

/**
 * Defines shared plugin default settings for field widget and Views style.
 */
class SlickBrowserDefault extends SlickDefault {

  /**
   * Returns the selection entity display plugin settings.
   */
  public static function baseFieldWidgetDisplaySettings() {
    return [
      '_context'           => 'widget',
      'entity_type'        => '',
      'display'            => '',
      'selection_position' => 'bottom',
    ];
  }

  /**
   * Returns the views style plugin settings.
   */
  public static function viewsSettings() {
    return [
      'vanilla' => TRUE,
    ] + parent::imageSettings();
  }

  /**
   * Returns the form mode widget plugin settings.
   */
  public static function widgetSettings() {
    return [
      'image_style'  => 'slick_browser_preview',
      'image'        => '',
      'media_switch' => 'media',
      'ratio'        => 'fluid',
    ] + self::baseFieldWidgetDisplaySettings()
      + self::viewsSettings();
  }

  /**
   * Returns the form mode widget base plugin settings.
   */
  public static function widgetBaseSettings() {
    return [
      '_context' => 'widget',
      'field_name' => '',
      // 'visible_items' => '',
      // 'preserve_keys', => 0
      // 'entity_type' => 'media',
      // 'media_switch' => 'media',
      // 'ratio'        => 'fluid',
    ] + parent::gridSettings();
  }

  /**
   * Returns the form mode widget plugin settings.
   */
  public static function widgetFileSettings() {
    return [
      'image_style' => 'slick_browser_preview',
      'thumbnail_style' => 'slick_browser_thumbnail',
      // 'visible_items' => '',
      // 'preserve_keys', => 0
      // 'entity_type' => 'media',
      // 'media_switch' => 'media',
      // 'ratio'        => 'fluid',
    ] + self::widgetBaseSettings();
  }

  /**
   * Returns the form mode rendered entity widget plugin settings.
   */
  public static function widgetEntitySettings() {
    return [
      'entity_type' => '',
      'view_mode' => 'default',
    ] + self::widgetBaseSettings();
  }

  /**
   * Returns the form mode media widget plugin settings.
   */
  public static function widgetMediaSettings() {
    return [
      'image' => '',
    ]
      + self::widgetFileSettings()
      + self::widgetEntitySettings();
  }

  /**
   * Returns the extended plugin settings.
   */
  public static function extendedSettings() {
    return self::widgetMediaSettings()
      + self::baseFieldWidgetDisplaySettings()
      + self::entitySettings()
      + self::viewsSettings();
  }

  /**
   * Returns the widget common buttons.
   */
  public static function widgetButtons() {
    return ['preview_link', 'edit_button', 'remove_button', 'replace_button'];
  }

  /**
   * Returns the supported third party widgets.
   */
  public static function thirdPartyWidgets() {
    return ['entity_browser_file', 'media_library_widget'];
  }

  /**
   * Returns the theme properties.
   */
  public static function themeProperties() {
    return [
      'attributes' => [],
      'content'    => [],
      'items'      => [],
      'settings'   => [],
    ];
  }

}
