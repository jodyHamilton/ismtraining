<?php

namespace Drupal\mailfish\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;

class CSVController extends ControllerBase {

  public function view() {
    $output = '';

    $query = \Drupal::entityQuery('mailfish')->condition('status', 1);
    $ids = $query->execute();
    $entities = entity_load_multiple('mailfish', $ids);

    foreach ($entities as $entity) {
      $output .= $entity->get('email')->value . ','; 
    }
/*
    $entities = \Drupal::entityTypeManager()
      ->getStorage('mailfish')
      ->loadByProperties(['status' => 1])
      ->loadMultiple($id);
*/

    return [
      '#type' => 'textarea',
      '#value' => $output,
    ];
/*
    // Return a raw Symfony response
    $response = new Response();
    $response->setContent($output);
    return $response;
*/
  }
}