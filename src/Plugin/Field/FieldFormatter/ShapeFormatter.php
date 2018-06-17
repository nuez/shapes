<?php

namespace Drupal\shapes\Plugin\Field\FieldFormatter;

use Drupal\Component\Plugin\PluginManagerInterface;
use Drupal\Core\Field\Annotation\FieldFormatter;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Plugin implementation of the 'shape formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "shape_formatter",
 *   label = @Translation("Shape"),
 *   field_types = {
 *     "commerce_plugin_item:shape"
 *   }
 * )
 */
class ShapeFormatter extends FormatterBase implements ContainerFactoryPluginInterface {

  /**
   * The plugin manager for the field's plugin type.
   *
   * @var \Drupal\Component\Plugin\PluginManagerInterface
   */
  protected $pluginManager;

  /**
   * Constructs a new Shape formatter.
   *
   * @param $plugin_id
   * @param $plugin_definition
   * @param \Drupal\Core\Field\FieldDefinitionInterface $field_definition
   * @param array $settings
   * @param $label
   * @param $view_mode
   * @param array $third_party_settings
   * @param \Drupal\Component\Plugin\PluginManagerInterface $plugin_manager
   */
  public function __construct($plugin_id, $plugin_definition, \Drupal\Core\Field\FieldDefinitionInterface $field_definition, array $settings, $label, $view_mode, array $third_party_settings, PluginManagerInterface $plugin_manager) {
    parent::__construct($plugin_id, $plugin_definition, $field_definition, $settings, $label, $view_mode, $third_party_settings);
    $this->pluginManager = $plugin_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    list(, $plugin_type) = explode(':', $configuration['field_definition']->getType());
    return new static(
      $plugin_id,
      $plugin_definition,
      $configuration['field_definition'],
      $configuration['settings'],
      $configuration['label'],
      $configuration['view_mode'],
      $configuration['third_party_settings'],
      $container->get('plugin.manager.' . $plugin_type)
    );
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];
    foreach ($items as $delta => $item) {
      /** @var \Drupal\shapes\ShapeInterface $pluginInstance */
      $pluginInstance =  $pluginInstance = $item->getTargetInstance();
      $elements[$delta] = $pluginInstance->renderShape();
    }
    return $elements;
  }


}
