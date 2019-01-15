<?php

namespace Drupal\mailfish\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'SignupCTA' block. 
 *
 * @Block(
 *  id = "mailfish_signup_cta",
 *  admin_label = @Translation("MailFish Signup CTA"),
 * )
 */
class SignupCTA extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
  	$build['time'] = [
      '#markup' => '<time datetime="" class="datetime mailfish-time"></time>',
  	];
    $build['CTA'] = [
      '#prefix' => '<div class="cta-text">',
      '#suffix' => '</div>',
      '#markup' => $this->configuration['cta'],
    ];
    // Attach Javascript.
    $build['#attached']['library'][] = 'mailfish/user-time';
    return $build;
  }

  public function baseConfigurationDefaults() {
    return [
      'cta' => $this->t('The perfect time to <a href=:url>sign up for our newsletter</a>.', [':url' => '/mailfish-signup'])
    ];
  }

  public function blockForm($form, FormStateInterface $form_state) {
    $form['cta'] = [
      '#title' => $this->t('CTA text'),
      '#type' => 'textarea',
      '#default_value' => $this->configuration['cta'],
    ];
    return $form;
  }

  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['cta'] = $form_state->getValue('cta');
  }
}