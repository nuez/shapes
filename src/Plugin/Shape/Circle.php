<?php

namespace Drupal\shapes\Plugin\Shape;

use Drupal\Component\Render\FormattableMarkup;
use Drupal\Core\Annotation\Translation;
use Drupal\Core\Form\FormStateInterface;
use Drupal\shapes\Annotation\Shape;

/**
 * Creates a circle shape
 *
 * @Shape(
 *   id = "circle",
 *   label = @Translation("Circle")
 * )
 */
class Circle extends ShapeBase {

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form += parent::buildConfigurationForm($form, $form_state);
    $form['radius'] = [
      '#title' => t('Radius'),
      '#type' => 'number',
      '#min' => 10,
      '#max' => 100,
      '#default_value' => isset($this->configuration['radius']) ? $this->configuration['radius'] : '',
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
        'radius' => '10',
      ] + parent::defaultConfiguration();
  }

  /**
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValue($form['#parents']);
    $this->configuration['radius'] = $values['radius'];
  }

  /**
   * {@inheritdoc}
   */
  public function renderShape() {
    $radius = $this->getConfiguration()['radius'];
    return [
      '#type' => 'markup',
      '#allowed_tags' => ['svg', 'circle'],
      '#markup' => new FormattableMarkup('<svg width="@width" height="@height"><circle cx="@radius" cy="@radius" r="@radius" fill="red" /></svg>',
        [
          '@radius' => $radius,
          '@width' => $radius*2,
          '@height' => $radius*2
        ]),
    ];
  }
}
