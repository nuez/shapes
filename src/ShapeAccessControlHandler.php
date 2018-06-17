<?php

namespace Drupal\shapes;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Shape entity.
 *
 * @see \Drupal\shapes\Entity\Shape.
 */
class ShapeAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\shapes\Entity\ShapeInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished shape entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published shape entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit shape entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete shape entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add shape entities');
  }

}
