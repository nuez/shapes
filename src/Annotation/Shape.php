<?php

namespace Drupal\shapes\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a shape
 *
 * @Annotation
 */
class Shape extends Plugin {

  /**
   * The plugin ID.
   *
   * @var string
   */
  public $id;

  /**
   * The label of the plugin.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $label;

}
