<?php

namespace Drupal\mailfish\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining MailFish entities.
 *
 * @ingroup mailfish
 */
interface MailFishInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the MailFish name.
   *
   * @return string
   *   Name of the MailFish.
   */
  public function getName();

  /**
   * Sets the MailFish name.
   *
   * @param string $name
   *   The MailFish name.
   *
   * @return \Drupal\mailfish\Entity\MailFishInterface
   *   The called MailFish entity.
   */
  public function setName($name);

  /**
   * Gets the MailFish creation timestamp.
   *
   * @return int
   *   Creation timestamp of the MailFish.
   */
  public function getCreatedTime();

  /**
   * Sets the MailFish creation timestamp.
   *
   * @param int $timestamp
   *   The MailFish creation timestamp.
   *
   * @return \Drupal\mailfish\Entity\MailFishInterface
   *   The called MailFish entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the MailFish published status indicator.
   *
   * Unpublished MailFish are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the MailFish is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a MailFish.
   *
   * @param bool $published
   *   TRUE to set this MailFish to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\mailfish\Entity\MailFishInterface
   *   The called MailFish entity.
   */
  public function setPublished($published);

}
