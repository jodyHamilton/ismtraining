<?php

namespace Drupal\mailfish;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of MailFish entities.
 *
 * @ingroup mailfish
 */
class MailFishListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('MailFish ID');
    $header['email'] = $this->t('Email');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\mailfish\Entity\MailFish */
    $row['id'] = $entity->id();
    $row['email'] = $entity->get('email')->value;
    return $row + parent::buildRow($entity);
  }


  public function getTitle() {
    return 'Email Signups';
  }
}
