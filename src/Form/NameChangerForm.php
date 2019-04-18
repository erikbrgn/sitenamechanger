<?php

namespace Drupal\sitename_changer\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Implements an example form.
 */
class NameChangerForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'sitename_changer';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['site_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t("Current site name: " . $this->getSiteName()),
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
    /* Checks to see if specified name is the same as the current site name */
    if ($form_state->getValue('site_name')==$this->getSiteName()) {
      $form_state->setErrorByName('site_name', $this->t('Site name is already set to '. $form_state->getValue('site_name')));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = \Drupal::service('config.factory')->getEditable('system.site');
    $config->set('name', $form_state->getValue('site_name')); 
    $config->save();
    // Displaying success message. Fetching saved site name instead of textfield value.
    drupal_set_message($this->t('Site name has been changed to "@name"', ['@name' => $this->getSiteName()]));
  }

  // method to retrieve current name of site
  private function getSiteName () {
    $site_name = \Drupal::config('system.site')->get('name');
    return $site_name;
  }
}