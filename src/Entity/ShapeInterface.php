<?php

namespace Drupal\shapes\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Shape entities.
 *
 * @ingroup shapes
 */
interface ShapeInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Shape name.
   *
   * @return string
   *   Name of the Shape.
   */
  public function getName();

  /**
   * Sets the Shape name.
   *
   * @param string $name
   *   The Shape name.
   *
   * @return \Drupal\shapes\Entity\ShapeInterface
   *   The called Shape entity.
   */
  public function setName($name);

  /**
   * Gets the Shape creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Shape.
   */
  public function getCreatedTime();

  /**
   * Sets the Shape creation timestamp.
   *
   * @param int $timestamp
   *   The Shape creation timestamp.
   *
   * @return \Drupal\shapes\Entity\ShapeInterface
   *   The called Shape entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Shape published status indicator.
   *
   * Unpublished Shape are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Shape is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Shape.
   *
   * @param bool $published
   *   TRUE to set this Shape to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\shapes\Entity\ShapeInterface
   *   The called Shape entity.
   */
  public function setPublished($published);

}
