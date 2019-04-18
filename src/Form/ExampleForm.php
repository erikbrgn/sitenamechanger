<?php

namespace Drupal\sitename_changer\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Implements an example form.
 */
class ExampleForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'example_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $site_name = \Drupal::config('system.site')->get('name');
    $form['site_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t($site_name),
    ];
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    /* No need to validate input since site name can be anything */
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = \Drupal::service('config.factory')->getEditable('system.site');
    $config->set('name', $form_state->getValue('site_name')); 
    $config->save();
    // Displaying success message. Fetching saved site name instead of textfield value.
    drupal_set_message($this->t('Site name has been changed to "@name"', ['@name' => $config->get('name')]));
  }

}