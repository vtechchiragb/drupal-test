<?php

namespace Drupal\slick_browser;

use Drupal\Core\Form\FormStateInterface;

/**
 * Interface for Slick Browser widget utilities.
 */
interface SlickBrowserWidgetInterface extends SlickBrowserAlterInterface {

  /**
   * Implements hook_field_widget_WIDGET_TYPE_form_alter().
   */
  public function fieldWidgetFormAlter(array &$element, FormStateInterface $form_state, $context);

}
