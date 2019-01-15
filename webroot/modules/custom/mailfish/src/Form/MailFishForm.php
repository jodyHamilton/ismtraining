<?php

namespace Drupal\mailfish\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for MailFish edit forms.
 *
 * @ingroup mailfish
 */
class MailFishForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\mailfish\Entity\MailFish */
    $form = parent::buildForm($form, $form_state);

    $entity = $this->entity;

    $form['actions']['submit']['#value'] = $this->t('Sign Up');

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->entity;

    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Thanks for signing up. We have signed you up as %email.', [
          '%email' => $entity->get('email')->value,
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label MailFish.', [
          '%label' => $entity->label(),
        ]));
    }
  }

}
