<?php

namespace Drupal\slick_browser\Plugin\EntityBrowser\FieldWidgetDisplay;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\media\Entity\Media;
use Drupal\slick_browser\SlickBrowserDefault;

/**
 * Displays Slick Browser Media thumbnail.
 *
 * @EntityBrowserFieldWidgetDisplay(
 *   id = "slick_browser_media",
 *   label = @Translation("Slick Browser: Media"),
 *   description = @Translation("Displays a preview of a Media using Blazy, if applicable.")
 * )
 */
class SlickBrowserFieldWidgetDisplayMedia extends SlickBrowserFieldWidgetDisplayBase {

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return SlickBrowserDefault::widgetMediaSettings() + parent::defaultConfiguration();
  }

  /**
   * {@inheritdoc}
   */
  public function view(EntityInterface $entity) {
    // @todo remove post blazy:2.17.
    if ($denied = $this->denied($entity)) {
      return $denied;
    }

    if ($entity instanceof Media) {
      $settings = $this->buildSettings();
      $id = $entity->id();

      $this->delta++;
      $delta[$id] = $this->delta;

      $label = [
        '#theme'      => 'container',
        '#attributes' => ['class' => ['sb__label']],
        '#children'   => $entity->label(),
      ];

      $data = [
        '#entity'   => $entity,
        '#delta'    => $delta[$id],
        '#settings' => $settings,
        'fallback'  => $entity->label(),
        'overlay'   => ['sb__label' => $label],
      ];

      $content = $this->blazyEntity->build($data);

      /** @var \Drupal\media\Entity\Media $entity */
      $content['#entity'] = $entity;
      return $content;
    }

    return [];
  }

  /**
   * {@inheritdoc}
   */
  public function isApplicable(EntityTypeInterface $entity_type) {
    return $entity_type->getClass() == 'Drupal\media\Entity\Media'
      || $entity_type->entityClassImplements('MediaInterface');
  }

}
