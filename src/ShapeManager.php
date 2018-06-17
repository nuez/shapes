<?php

namespace Drupal\shapes;

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Plugin\DefaultPluginManager;

/**
 * Manages shape plugins.

 * @see plugin_api
 */
class ShapeManager extends DefaultPluginManager {

  /**
   * Constructs a new ShapeManager.
   *
   * @param \Traversable $namespaces
   *   An object that implements \Traversable which contains the root paths
   *   keyed by the corresponding namespace to look for plugin implementations.
   * @param \Drupal\Core\Cache\CacheBackendInterface $cache_backend
   *   Cache backend instance to use.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler.
   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    parent::__construct('Plugin/Shape', $namespaces, $module_handler, 'Drupal\shapes\ShapeInterface', 'Drupal\shapes\Annotation\Shape');
    $this->setCacheBackend($cache_backend, 'shape_plugins');
  }

}
