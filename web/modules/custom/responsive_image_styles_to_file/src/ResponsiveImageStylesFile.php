<?php

namespace Drupal\responsive_image_styles_to_file;

use Drupal\responsive_image_styles_to_file\ResponsiveBackgroundImage;

class ResponsiveImageStylesFile
{
    public static function generateResponsiveImageStylesFile() {
      file_put_contents("themes/custom/rmeble/css/responsive-style.css", "");
      self::generateNodeResponsiveImageStyles();
      self::generateBlockResponsiveImageStyles();
      // self::generateTaxonomyResponsiveImageStyles();
    }


    private static function generateBlockResponsiveImageStyles() {
      $query = \Drupal::entityQuery('block_content');
      $query->condition('type', array('offer_frontpage', 'about', 'first_step', 'description_frontpage', 'footer_block'), 'IN');    
      $result = $query->execute();
      $blocks = entity_load_multiple('block_content', $result);

      foreach ($blocks as $block) {
        $block_id = $block->bundle();
        $css_class = 'block--bundle--' . $block_id;

      if($block_id == "offer_frontpage") {
        if ($block->hasField('field_b_single_image') &&
        !empty($block->get('field_b_single_image')
        ->getValue()[0]['target_id'])) {
          $css_selector = '.' . $css_class . ' .offer-item-1';
          $style_tag = ResponsiveBackgroundImage::generateMediaQueries($css_selector, $block, 'field_b_single_image', 'offerblock');
          if ($style_tag) {
            $styles = $style_tag[0]["#all_media"];
            file_put_contents("themes/custom/rmeble/css/responsive-style.css", $styles, FILE_APPEND);
          }
        }
        if ($block->hasField('field_b_single_image_2') &&
        !empty($block->get('field_b_single_image_2')
        ->getValue()[0]['target_id'])) {
          $css_selector = '.' . $css_class . ' .offer-item-2';
          $style_tag = ResponsiveBackgroundImage::generateMediaQueries($css_selector, $block, 'field_b_single_image_2', 'offerblock');
          if ($style_tag) {
            $styles = $style_tag[0]["#all_media"];
            file_put_contents("themes/custom/rmeble/css/responsive-style.css", $styles, FILE_APPEND);
          }
        }
        if ($block->hasField('field_b_single_image_3') &&
        !empty($block->get('field_b_single_image_3')
        ->getValue()[0]['target_id'])) {
          $css_selector = '.' . $css_class . ' .offer-item-3';
          $style_tag = ResponsiveBackgroundImage::generateMediaQueries($css_selector, $block, 'field_b_single_image_3', 'offerblock');
          if ($style_tag) {
            $styles = $style_tag[0]["#all_media"];
            file_put_contents("themes/custom/rmeble/css/responsive-style.css", $styles, FILE_APPEND);
          }
        }
        if ($block->hasField('field_b_single_image_4') &&
        !empty($block->get('field_b_single_image_4')
        ->getValue()[0]['target_id'])) {
          $css_selector = '.' . $css_class . ' .offer-item-4';
          $style_tag = ResponsiveBackgroundImage::generateMediaQueries($css_selector, $block, 'field_b_single_image_4', 'offerblock');
          if ($style_tag) {
            $styles = $style_tag[0]["#all_media"];
            file_put_contents("themes/custom/rmeble/css/responsive-style.css", $styles, FILE_APPEND);
          }
        }      
      } 

      if($block_id == "about") {
        if ($block->hasField('field_b_single_image') &&
        !empty($block->get('field_b_single_image')
        ->getValue()[0]['target_id'])) {
          $css_selector = '.' . $css_class . ' .block-image';
          $style_tag = ResponsiveBackgroundImage::generateMediaQueries($css_selector, $block, 'field_b_single_image', 'aboutblock');
          if ($style_tag) {
            $styles = $style_tag[0]["#all_media"];
            file_put_contents("themes/custom/rmeble/css/responsive-style.css", $styles, FILE_APPEND);
          }
        }      
      }

      if($block_id == "first_step") {
        if ($block->hasField('field_b_single_image') &&
        !empty($block->get('field_b_single_image')
        ->getValue()[0]['target_id'])) {
          $css_selector = '.' . $css_class . ' .block-image';
          $style_tag = ResponsiveBackgroundImage::generateMediaQueries($css_selector, $block, 'field_b_single_image', 'firststepblock');
          if ($style_tag) {
            $styles = $style_tag[0]["#all_media"];
            file_put_contents("themes/custom/rmeble/css/responsive-style.css", $styles, FILE_APPEND);
          }
        }      
      }

      if($block_id == "description_frontpage") {
        if ($block->hasField('field_b_single_image_3') &&
        !empty($block->get('field_b_single_image_3')
        ->getValue()[0]['target_id'])) {
          $css_selector = '.' . $css_class . ' .descriptionblock-image';
          $style_tag = ResponsiveBackgroundImage::generateMediaQueries($css_selector, $block, 'field_b_single_image_3', 'descriptionblock');
          if ($style_tag) {
            $styles = $style_tag[0]["#all_media"];
            file_put_contents("themes/custom/rmeble/css/responsive-style.css", $styles, FILE_APPEND);
          }
        }      
      }

      if($block_id == "footer_block") {
        if ($block->hasField('field_b_single_image') &&
        !empty($block->get('field_b_single_image')
        ->getValue()[0]['target_id'])) {
          $css_selector = '.' . $css_class . ' .footer-block-image';
          $style_tag = ResponsiveBackgroundImage::generateMediaQueries($css_selector, $block, 'field_b_single_image', 'footerblock');
          if ($style_tag) {
            $styles = $style_tag[0]["#all_media"];
            file_put_contents("themes/custom/rmeble/css/responsive-style.css", $styles, FILE_APPEND);
          }
        }      
      }

      }
    }

    private static function generateNodeResponsiveImageStyles() {
      $query = \Drupal::entityQuery('node');
      $query->condition('type', array('slide', 'realization', 'offer'), 'IN');    
      $result = $query->execute();
      foreach ($result as $nodeId) {
        $node = \Drupal\node\Entity\Node::load($nodeId);
        $node_id = $node->id();
        $css_class = 'node--id--' . $node_id;
        $type_name = $node->bundle();

         if($type_name == "slide") {
          if ($node->hasField('field_slide_image') &&
          !empty($node->get('field_slide_image')
          ->getValue()[0]['target_id'])) {
            $css_selector = '.' . $css_class . '.slide-item';
            $style_tag = ResponsiveBackgroundImage::generateMediaQueries($css_selector, $node, 'field_slide_image', 'slider');
            if ($style_tag) {
              $styles = $style_tag[0]["#all_media"];
              file_put_contents("themes/custom/rmeble/css/responsive-style.css", $styles, FILE_APPEND);
            }
          }
         } 
    
         if($type_name == "realization") {
          if ($node->hasField('field_single_image') &&
          !empty($node->get('field_single_image')
          ->getValue()[0]['target_id'])) {
            $css_selector = '.' . $css_class . ' .image-realization-teaser';
            $style_tag = ResponsiveBackgroundImage::generateMediaQueries($css_selector, $node, 'field_single_image', 'realizationslider');
            if ($style_tag) {
              $styles = $style_tag[0]["#all_media"];
              file_put_contents("themes/custom/rmeble/css/responsive-style.css", $styles, FILE_APPEND);
            }
          }

          if ($node->hasField('field_single_image_5') &&
          !empty($node->get('field_single_image_5')
          ->getValue()[0]['target_id'])) {
            $css_selector = '.' . $css_class . ' .intro-image-small';
            $style_tag = ResponsiveBackgroundImage::generateMediaQueries($css_selector, $node, 'field_single_image_5', 'realizationfrontpagesmall');
            if ($style_tag) {
              $styles = $style_tag[0]["#all_media"];
              file_put_contents("themes/custom/rmeble/css/responsive-style.css", $styles, FILE_APPEND);
            }
          }

          if ($node->hasField('field_single_image_4') &&
          !empty($node->get('field_single_image_4')
          ->getValue()[0]['target_id'])) {
            $css_selector = '.' . $css_class . ' .intro-image-big';
            $style_tag = ResponsiveBackgroundImage::generateMediaQueries($css_selector, $node, 'field_single_image_4', 'realizationfrontpagebig');
            if ($style_tag) {
              $styles = $style_tag[0]["#all_media"];
              file_put_contents("themes/custom/rmeble/css/responsive-style.css", $styles, FILE_APPEND);
            }
          }

          if ($node->hasField('field_single_image_6') &&
          !empty($node->get('field_single_image_6')
          ->getValue()[0]['target_id'])) {
            $css_selector = '.' . $css_class . ' .intro-image-background';
            $style_tag = ResponsiveBackgroundImage::generateMediaQueries($css_selector, $node, 'field_single_image_6', 'realizationfrontpagematerial');
            if ($style_tag) {
              $styles = $style_tag[0]["#all_media"];
              file_put_contents("themes/custom/rmeble/css/responsive-style.css", $styles, FILE_APPEND);
            }
          }
         }

         if($type_name == "offer") {
          if ($node->hasField('field_single_image') &&
          !empty($node->get('field_single_image')
          ->getValue()[0]['target_id'])) {
            $css_selector = '.' . $css_class . ' .offer-teaser-image';
            $style_tag = ResponsiveBackgroundImage::generateMediaQueries($css_selector, $node, 'field_single_image', 'offerintro');
            if ($style_tag) {
              $styles = $style_tag[0]["#all_media"];
              file_put_contents("themes/custom/rmeble/css/responsive-style.css", $styles, FILE_APPEND);
            }
          }
         }

         
      }
    }

    private static function generateTaxonomyResponsiveImageStyles() {
      $queryTax = \Drupal::entityQuery('taxonomy_term');
      $queryTax->condition('vid', array('individual_customer','institutional_client'), 'IN');    
      $resultTax = $queryTax->execute();
      foreach ($resultTax as $termId) {
        $term = \Drupal\taxonomy\Entity\Term::load($termId);
        $term_id = $term->id();
        $term_vid = $term->bundle();
        $css_class = 'term--id--' . $term_id;

        if($term_vid == "individual_customer") {
          if ($term->hasField('field_tx_single_image') &&
          !empty($term->get('field_tx_single_image')
          ->getValue()[0]['target_id'])) {
            $css_selector = '.' . $css_class . ' .taxonomy-list-image';
            $style_tag = ResponsiveBackgroundImage::generateMediaQueries($css_selector, $term, 'field_tx_single_image', 'taxonomy_list');
            if ($style_tag) {
              $styles = $style_tag[0]["#all_media"];
              file_put_contents("themes/custom/rmeble/css/responsive-style.css", $styles, FILE_APPEND);
            }
          }
        }
      }
    }
}