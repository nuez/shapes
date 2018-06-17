<?php

namespace Drupal\shapes;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Shape entities.
 *
 * @ingroup shapes
 */
class ShapeListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Shape ID');
    $header['name'] = $this->t('Name');
    $header['shape'] = $this->t('Shape');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\shapes\Entity\Shape */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.shape.edit_form',
      ['shape' => $entity->id()]
    );
    $shape = \Drupal::entityTypeManager()->getViewBuilder('shape')->view($entity, 'default');
    /** @var \Drupal\Core\Render\Renderer $renderer */
    $renderer = \Drupal::service('renderer');
    $shape = $renderer->render($shape);
    $row['shape'] = $shape;
    return $row + parent::buildRow($entity);
  }

}
