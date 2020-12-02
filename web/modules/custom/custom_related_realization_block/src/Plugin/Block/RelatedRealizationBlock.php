<?php

namespace Drupal\custom_related_realization_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\views\Views;
/**
 * Provides a block called "Related realizations".
 *
 * @Block(
 *  id = "custom_related_realization_block",
 *  admin_label = @Translation("Related realization block")
 * )
 */
class RelatedRealizationBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  private $currentNodeId;




  public function build() {
    $language = \Drupal::languageManager()->getCurrentLanguage()->getId();

    $node = \Drupal::routeMatch()->getParameter('node');
    if ($node instanceof \Drupal\node\NodeInterface) {
      $nid = $node->id();
      $this->currentNodeId = $nid;
      $node = \Drupal::entityTypeManager()->getStorage('node')->load($nid);
      $term = $node->get('field_taxonomy_refrence')->getValue()[0]["target_id"]; 
    }
    
    $query = \Drupal::entityQuery('node')
    ->condition('status', 1) 
    ->condition('type', 'realization') 
    ->condition('langcode', $language) 
    ->condition('field_taxonomy_refrence', $term) 
    ->pager(10); 
    $nids = $query->execute();

    $filteredNids = array_filter($nids, function($var) {
      return $var != $this->currentNodeId;
    });

    $nodes = \Drupal\node\Entity\Node::loadMultiple($filteredNids);

    $build = \Drupal::entityTypeManager()->getViewBuilder('node')->viewMultiple($nodes, 'token');

    return [
      '#theme'    => 'custom_related_realization_block',
      '#cache'    => ['max-age' => 0,],
      '#title' => 'Related realizations block',
      '#currentLanguage' => $language,
      '#nodes' => $build,
    ];
  }
}
