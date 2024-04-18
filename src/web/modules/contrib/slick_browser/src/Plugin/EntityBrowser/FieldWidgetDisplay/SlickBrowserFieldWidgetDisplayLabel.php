<?php

namespace Drupal\slick_browser\Plugin\EntityBrowser\FieldWidgetDisplay;

use Drupal\Core\Entity\EntityInterface;

/**
 * Displays a label of the entity.
 *
 * @EntityBrowserFieldWidgetDisplay(
 *   id = "slick_browser_label",
 *   label = @Translation("Slick Browser: Label"),
 *   description = @Translation("Displays an entity label.")
 * )
 */
class SlickBrowserFieldWidgetDisplayLabel extends SlickBrowserFieldWidgetDisplayBase {

  /**
   * {@inheritdoc}
   */
  public function view(EntityInterface $entity) {
    if ($denied = $this->denied($entity)) {
      return $denied;
    }
    return $entity->label();
  }

}
