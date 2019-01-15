<?php

/**
 * @file
 * Contains mailfish.page.inc.
 *
 * Page callback for MailFish entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for MailFish templates.
 *
 * Default template: mailfish.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_mailfish(array &$variables) {
  // Fetch MailFish Entity Object.
  $mailfish = $variables['elements']['#mailfish'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
