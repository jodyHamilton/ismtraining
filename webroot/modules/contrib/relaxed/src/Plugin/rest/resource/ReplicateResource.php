<?php

namespace Drupal\relaxed\Plugin\rest\resource;

use Drupal\rest\ModifiedResourceResponse;

/**
 * @RestResource(
 *   id = "relaxed:replicate",
 *   label = "Replicate",
 *   serialization_class = {
 *     "canonical" = "Drupal\relaxed\Replicate\Replicate",
 *   },
 *   uri_paths = {
 *     "canonical" = "/_replicate",
 *   }
 * )
 */
class ReplicateResource extends ResourceBase {

  /**
   * @param \Drupal\relaxed\Replicate\Replicate $replicate
   *
   * @return \Drupal\rest\ModifiedResourceResponse
   */
  public function post($replicate) {
    $replicate->doReplication();

    return new ModifiedResourceResponse($replicate, 200);
  }
}
