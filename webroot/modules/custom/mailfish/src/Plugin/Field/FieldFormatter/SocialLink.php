<?php

namespace Drupal\mailfish\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;

/**
 * Field formatter for Social Links.
 *
 * @FieldFormatter(
 *   id = "mailfish_social_link",
 *   label = @Translation("Mailfish Social Link"),
 *   field_types = {
 *     "link"
 *   }
 * )
 */
class SocialLink extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
  	foreach ($items as $delta => $item) {
  	  $url = $item->getUrl();
  	  $domain = parse_url($url->toString(), PHP_URL_HOST);
  	  switch ($domain) {
  	  	case 'www.instagram.com':
  	  	  $text = 'ig';
          break;
  	    case 'twitter.com':
          $text = 't';
          break;
  	    case 'www.facebook.com':
          $text = 'f';
          break;
  	    case 'www.linkedin.com':
          $text = 'in';
          break;
  	    default: 
          $text = 'other';
  	  }
  	  $elements[$delta] = [
        '#type' => 'link',
        '#url' => $url,
        '#title' => $text,
        '#attributes' => [
          'target' => '_blank',
          'class' => 'social-link--' . $text,
        ],
      ];
  	}
    return $elements;
  }

}