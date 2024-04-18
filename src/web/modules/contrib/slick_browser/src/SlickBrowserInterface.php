<?php

namespace Drupal\slick_browser;

/**
 * Interface for a Slick Browser.
 */
interface SlickBrowserInterface {

  /**
   * Returns the slick admin service.
   */
  public function slickAdmin();

  /**
   * Returns the slick manager.
   */
  public function manager();

  /**
   * Returns the slick formatter.
   */
  public function formatter();

  /**
   * Returns the blazy manager.
   */
  public function blazyManager();

  /**
   * Returns the blazy entity.
   */
  public function blazyEntity();

  /**
   * Defines common widget form elements.
   */
  public function buildWigetSettingsForm(array &$form, array $definition);

  /**
   * Implements hook_preprocess_views_view().
   */
  public function preprocessViewsView(&$variables);

  /**
   * Implements hook_preprocess_blazy().
   */
  public function preprocessBlazy(&$variables);

  /**
   * Overrides image style since preview is not always available.
   *
   * Not called after AJAX.
   */
  public function toBlazy(array $display, array $sets, $delta = 0, $label = NULL): array;

}
