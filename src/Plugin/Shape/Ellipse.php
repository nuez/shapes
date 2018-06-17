<?php

namespace Drupal\shapes\Plugin\Shape;

use Drupal\Component\Render\FormattableMarkup;
use Drupal\Core\Annotation\Translation;
use Drupal\Core\Form\FormStateInterface;
use Drupal\shapes\Annotation\Shape;

/**
 * Creates a circle shape.
 *
 * @Shape(
 *   id = "ellipse",
 *   label = @Translation("Ellipse")
 * )
 */
class Ellipse extends ShapeBase {

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form += parent::buildConfigurationForm($form, $form_state);
    $form['radius_x'] = [
      '#title' => t('Radius X'),
      '#type' => 'number',
      '#min' => 10,
      '#max' => 100,
      '#default_value' => isset($this->configuration['radius_x']) ? $this->configuration['radius_x'] : '',
    ];
    $form['radius_y'] = [
      '#title' => t('Radius Y'),
      '#type' => 'number',
      '#min' => 10,
      '#max' => 100,
      '#default_value' => isset($this->configuration['radius_y']) ? $this->configuration['radius_y'] : '',
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
        'radius_x' => '10',
        'radius_y' => '10',
      ] + parent::defaultConfiguration();
  }

  /**
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValue($form['#parents']);
    $this->configuration['radius_x'] = $values['radius_x'];
    $this->configuration['radius_y'] = $values['radius_y'];
  }

  /**
   * {@inheritdoc}
   */
  public function renderShape() {
    $radius_x = $this->getConfiguration()['radius_x'];
    $radius_y = $this->getConfiguration()['radius_y'];
    return [
      '#type' => 'markup',
      '#allowed_tags' => ['svg', 'ellipse'],
      '#markup' => new FormattableMarkup('<svg width="@width" height="@height"><ellipse cx="@radius_x" cy="@radius_y" rx="@radius_x" ry="@radius_y" fill="blue" /></svg>',
        [
          '@radius_x' => $radius_x,
          '@radius_y' => $radius_y,
          '@width' => $radius_x * 2,
          '@height' => $radius_y * 2,
        ]),
    ];
  }
}
