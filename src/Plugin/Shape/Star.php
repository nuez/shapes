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
 *   id = "star",
 *   label = @Translation("Star")
 * )
 */
class Star extends ShapeBase {

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form += parent::buildConfigurationForm($form, $form_state);
    $form['inner_radius'] = [
      '#title' => t('Inner Radius'),
      '#type' => 'number',
      '#min' => 10,
      '#max' => 100,
      '#default_value' => isset($this->configuration['inner_radius']) ? $this->configuration['inner_radius'] : '',
    ];
    $form['outer_radius'] = [
      '#title' => t('Outer Radius'),
      '#type' => 'number',
      '#min' => 10,
      '#max' => 100,
      '#default_value' => isset($this->configuration['outer_radius']) ? $this->configuration['outer_radius'] : '',
    ];
    $form['points'] = [
      '#title' => t('Points'),
      '#type' => 'number',
      '#min' => 3,
      '#max' => 40,
      '#default_value' => isset($this->configuration['outer_radius']) ? $this->configuration['outer_radius'] : '',
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
        'inner_radius' => '10',
        'outer_radius' => '10',
        'points' => '10',
      ] + parent::defaultConfiguration();
  }

  /**
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValue($form['#parents']);
    $this->configuration['inner_radius'] = $values['inner_radius'];
    $this->configuration['outer_radius'] = $values['outer_radius'];
    $this->configuration['points'] = $values['points'];
  }

  /**
   * {@inheritdoc}
   */
  public function renderShape() {
    $inner_radius = $this->getConfiguration()['inner_radius'];
    $outer_radius = $this->getConfiguration()['outer_radius'];
    $points = $this->getConfiguration()['points'];
    return [
      '#type' => 'markup',
      '#allowed_tags' => ['svg', 'polygon'],
      '#markup' => $this->getStar($points, $inner_radius, $outer_radius),
    ];
  }

  /**
   * Generate a star.
   *
   * @param int $pointCount
   *   The points the star should have.
   * @param int $inner_radius
   *   The inner radius.
   * @param int $outer_radius
   *   The outer radius.
   *
   * @return FormattableMarkup
   */
  protected function getStar($pointCount, $inner_radius, $outer_radius) {
    $piPart = (pi() / $pointCount);
    $starX = $outer_radius;
    $starY = $outer_radius;
    $points = [];
    $piOffset = pi();

    for ($i = 0; $i < $pointCount * 2; $i += 2) {
      $points[] = ($starX + (sin($piOffset + $piPart * $i) * $outer_radius)) . ',' .
        ($starY + (cos($piOffset + $piPart * $i)) * $outer_radius);
      $points[] = ($starX + (sin($piOffset + $piPart * ($i + 1)) * $inner_radius)) . ',' .
        ($starY + (cos($piOffset + $piPart * ($i + 1))) * $inner_radius);
    }

    return new FormattableMarkup('<svg width="@width" height="@height"><polygon cx="@star_x" cy="@star_y" fill="purple" points="@points"></polygon></svg>', [
      '@star_x' => $starX,
      '@star_y' => $starY,
      '@points' => implode(' ', $points),
      '@width' => $outer_radius * 2,
      '@height' => $outer_radius * 2,
    ]);
  }
}
