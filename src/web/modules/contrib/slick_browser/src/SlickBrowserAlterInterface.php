<?php

namespace Drupal\slick_browser;

use Drupal\Core\Form\FormStateInterface;

/**
 * Interface for a Slick Browser hook_alter().
 */
interface SlickBrowserAlterInterface {

  /**
   * Implements hook_form_alter().
   */
  public function formAlter(&$form, FormStateInterface &$form_state, $form_id);

}
