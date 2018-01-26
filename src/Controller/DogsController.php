<?php

/**
* @file
* Contains \Drupal\dogs\Controller\DogsController.
*/

namespace Drupal\dogs\Controller;

use Drupal\Component\Utility\Html;
use Drupal\Component\Serialization\Json;

use Drupal\Core\Controller\ControllerBase;


class DogsController extends ControllerBase {
  /**
  * This callback is mapped to the path
  * 'dogs/generate/{breed}/.
  *
  * @param string $dogs
  *   Dog breed to display picture of
  */
  public function generate( $breed ) {

    $client = \Drupal::httpClient();
    $response = $client->get('http://dog.ceo/api/breed/' . $breed . '/images/random');
    $response_content = $response->getBody()->getContents();

    $body = Json::decode($response_content);
    $img_src = $body['message'];

    return array(
      '#type' => 'markup',
      '#markup' => '<img src= "' . $img_src . '"/>',
    );
  }

  public function getTitle( $breed ) {
    return $breed;
  }
}
