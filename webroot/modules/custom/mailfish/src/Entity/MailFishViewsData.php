<?php

namespace Drupal\mailfish\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for MailFish entities.
 */
class MailFishViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.

    return $data;
  }

}
