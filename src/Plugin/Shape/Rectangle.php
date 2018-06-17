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
 *   id = "rectangle",
 *   label = @Translation("Rectangle")
 * )
 */
class Rectangle extends ShapeBase {

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form += parent::buildConfigurationForm($form, $form_state);
    $form['width'] = [
      '#title' => t('Width'),
      '#type' => 'number',
      '#min' => 10,
      '#max' => 100,
      '#default_value' => isset($this->configuration['width']) ? $this->configuration['width'] : '',
    ];
    $form['height'] = [
      '#title' => t('Height'),
      '#type' => 'number',
      '#min' => 10,
      '#max' => 100,
      '#default_value' => isset($this->configuration['height']) ? $this->configuration['height'] : '',
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
        'width' => '10',
        'height' => '10',
      ] + parent::defaultConfiguration();
  }

  /**
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValue($form['#parents']);
    $this->configuration['width'] = $values['width'];
    $this->configuration['height'] = $values['height'];
  }

  /**
   * {@inheritdoc}
   */
  public function renderShape() {
    $width = $this->getConfiguration()['width'];
    $height = $this->getConfiguration()['height'];
    return [
      '#type' => 'markup',
      '#allowed_tags' => ['svg', 'rectangle'],
      '#markup' => new FormattableMarkup('<svg width="@width" height="@height"><rect x="0" y="0" width="@width" height="@height" fill="green" /></svg>', [
        '@width' => $width,
        '@height' => $height,
      ]),
    ];
  }

}
