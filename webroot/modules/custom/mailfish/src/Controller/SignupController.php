<?php

namespace Drupal\mailfish\Controller;

use Drupal\Core\Controller\ControllerBase;

class SignupController extends ControllerBase {

  public function view() {
    $output = [
      '#markup' => '<p>Sign up for our mailing list.</p>',
    ];

    // Make a new entity.
    $entity = \Drupal::entityTypeManager()->getStorage('mailfish')->create();

    // Get the form.
    $form = \Drupal::entityTypeManager()
      ->getFormObject('mailfish', 'default')
      ->setEntity($entity);
    $output[] = \Drupal::formBuilder()->getForm($form);

    return $output;
  }
}