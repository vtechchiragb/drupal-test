<?php

namespace Drupal\slick_browser\Plugin\EntityBrowser\FieldWidgetDisplay;

use Drupal\Core\Entity\EntityInterface;
use Drupal\slick_browser\SlickBrowserDefault;

/**
 * Displays Slick Browser as a rendered entity.
 *
 * @EntityBrowserFieldWidgetDisplay(
 *   id = "slick_browser_rendered_entity",
 *   label = @Translation("Slick Browser: Rendered entity"),
 *   description = @Translation("Displays a rendered entity.")
 * )
 */
class SlickBrowserFieldWidgetDisplayRenderedEntity extends SlickBrowserFieldWidgetDisplayBase {

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return SlickBrowserDefault::widgetEntitySettings() + parent::defaultConfiguration();
  }

  /**
   * {@inheritdoc}
   */
  public function view(EntityInterface $entity) {
    // @todo remove post blazy:2.17.
    if ($denied = $this->denied($entity)) {
      return $denied;
    }

    $settings = $this->buildSettings();
    $settings['view_mode'] = $this->configuration['view_mode'] ?? 'slick_browser';

    $id = $entity->id();
    $this->delta++;
    $delta[$id] = $this->delta;

    $data = [
      '#entity'   => $entity,
      '#delta'    => $delta[$id],
      '#settings' => $settings,
      'fallback'  => $entity->label(),
    ];

    $content = $this->blazyEntity->view($data);
    $content['#entity'] = $entity;
    return $content;
  }

  /**
   * {@inheritdoc}
   */
  public function calculateDependencies() {
    $dependencies = parent::calculateDependencies();
    if ($view_mode = $this->blazyManager->load($this->configuration['entity_type'] . '.' . $this->configuration['view_mode'], 'entity_view_mode')) {
      $dependencies[$view_mode->getConfigDependencyKey()][] = $view_mode->getConfigDependencyName();
    }
    return $dependencies;
  }

}
