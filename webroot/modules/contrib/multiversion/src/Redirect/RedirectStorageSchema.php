<?php

namespace Drupal\multiversion\Redirect;

use Drupal\Core\Entity\ContentEntityTypeInterface;
use Drupal\Core\Entity\Sql\SqlContentEntityStorageSchema;

/**
 * Defines the redirect schema.
 */
class RedirectStorageSchema extends SqlContentEntityStorageSchema {

  /**
   * {@inheritdoc}
   */
  protected function getEntitySchema(ContentEntityTypeInterface $entity_type, $reset = FALSE) {
    $schema = parent::getEntitySchema($entity_type, $reset);

    $schema['redirect']['indexes'] += [
      // Limit length to 191.
      'source_language' => [['redirect_source__path', 191], 'language'],
    ];

    return $schema;
  }

}
