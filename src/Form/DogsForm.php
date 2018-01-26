<?php

namespace Drupal\dogs\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Serialization\Json;
use Drupal\Core\Url;

/**
* Dogs Form
*/
class DogsForm extends FormBase {

  /**
  * {@inheritdoc}
  */
  public function getFormId() {
    return 'dog_block_form';
  }

  /**
  * {@inheritdoc}
  */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $client = \Drupal::httpClient();
    $response = $client->get('http://dog.ceo/api/breeds/list');
    $response_content = $response->getBody()->getContents();

    $body = Json::decode($response_content);
    $breeds = $body['message'];

    $options = array();

    foreach ($breeds as $key => $breed) {;
      $options[$breed] = t($breed);
    }

    $form['breed'] = array(
      '#type' => 'select',
      '#title' => $this->t("Select Breed"),
      '#options' => $options,
      '#default_value' => NULL,
      '#required' => TRUE,
    );

    // Submit.
    $form['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Generate'),
    );

    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
    $breed = $form_state->getValue('breed');
    if ( $breed == NULL ) {
      $form_state->setErrorByName('breed', $this->t('Please pick a breed.'));
    }
  }

  /**
  * {@inheritdoc}
  */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $breed = $form_state->getValue('breed');

    $form_state->setRedirect(
    'dogs.breed',
    array(
      'breed' => $form_state->getValue('breed'),
      )
    );
  }
}
