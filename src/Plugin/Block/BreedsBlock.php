<?php

/**
* @file
* Contains \Drupal\dogs\Plugin\Block\BreedsBlock.
*/

namespace Drupal\dogs\Plugin\Block;


use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;


/**
* Provides a 'Dog Breeds' block.
*
* @Block(
*   id = "dog_breeds",
*   admin_label = @Translation("Dog Breeds"),
*   category = @Translation("Dogs"),
* )
*/
class BreedsBlock extends BlockBase {

  /**
  * {@inheritdoc}
  */
  public function build() {
     return \Drupal::formBuilder()->getForm('Drupal\dogs\Form\DogsForm');
  }

}
