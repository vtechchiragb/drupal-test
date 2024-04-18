<?php

namespace Drupal\slick_browser\Plugin\EntityBrowser\FieldWidgetDisplay;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\file\FileInterface;
use Drupal\slick_browser\SlickBrowserDefault;

/**
 * Displays Slick Browser File thumbnail if applicable.
 *
 * The main difference from core EB is it strives to display a thumbnail image
 * before giving up to view mode because mostly dealing with small preview.
 *
 * @EntityBrowserFieldWidgetDisplay(
 *   id = "slick_browser_file",
 *   label = @Translation("Slick Browser: File"),
 *   description = @Translation("Displays a preview of a file or entity using Blazy, if applicable.")
 * )
 */
class SlickBrowserFieldWidgetDisplayFile extends SlickBrowserFieldWidgetDisplayBase {

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return SlickBrowserDefault::widgetFileSettings() + parent::defaultConfiguration();
  }

  /**
   * {@inheritdoc}
   */
  public function view(EntityInterface $entity) {
    // @todo remove post blazy:2.17.
    if ($denied = $this->denied($entity)) {
      return $denied;
    }

    if ($entity instanceof FileInterface) {
      $settings = $this->buildSettings();
      $id = $entity->id();
      $this->delta++;
      $delta[$id] = $this->delta;

      $data = [
        '#entity'   => $entity,
        '#delta'    => $delta[$id],
        '#settings' => $settings,
        'fallback'  => $entity->getFilename(),
      ];

      $content = $this->blazyEntity->build($data);

      /** @var \Drupal\file\FileInterface $entity */
      $content['#entity'] = $entity;
      return $content;
    }

    return [];
  }

  /**
   * {@inheritdoc}
   */
  public function isApplicable(EntityTypeInterface $entity_type) {
    return $entity_type->entityClassImplements(FileInterface::class);
  }

}
