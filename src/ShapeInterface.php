<?php

namespace Drupal\shapes;

use Drupal\Component\Plugin\ConfigurablePluginInterface;
use Drupal\Component\Plugin\PluginInspectionInterface;
use Drupal\Core\Plugin\PluginFormInterface;

/**
 * Defines the interface for shapes.
 *
 * @see plugin_api
 */
interface ShapeInterface extends  ConfigurablePluginInterface, PluginFormInterface, PluginInspectionInterface {

  /**
   * Render the shape based on the settings.
   *
   * @return array
   *   The render array of the shape.
   */
  public function renderShape();
}
