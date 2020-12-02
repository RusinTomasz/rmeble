<?php

/**
 * @file
 * Theme settings in this file
 */

/**
 * Implements hook_from_system_thme_settings_alter(),
 *
 * @param $form
 * @param \Drupal\Core\Form\FormStateInterface $form_state
 * @param null $form_id
 */
function rmeble_form_system_theme_settings_alter(&$form, \Drupal\Core\Form\FormStateInterface $form_state, $form_id = NULL) {
  if (isset($form_id)) {
    return;
  }

  $form['#attached']['library'][] = 'rmeble/cms_settings_js';
  $form['#attached']['library'][] = 'rmeble/cms_settings_css';

  $form['rmeble_settings'] = [
    '#type' => 'vertical_tabs',
    '#weight' => -99,
    '#prefix' => t('<h3>rmeble BasicTheme Settings</h3>'),
  ];


  /* GOOGLE SETTINGS */
  $form['rmeble_settings']['google'] = [
    '#type' => 'details',
    '#title' => t('Google setings'),
    '#weight' => 6,
    '#group' => 'rmeble_settings',
  ];

  $form['rmeble_settings']['google']['google-analytics'] = [
    '#type' => 'fieldset',
    '#title' => t('Google Tag Manager'),
    '#description' => t(''),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  ];

  $form['rmeble_settings']['google']['google-analytics']['googletracker'] = [
    '#type' => 'textfield',
    '#title' => t('Tracker'),
    '#default_value' => theme_get_setting('googletracker'),
  ];

  /* LAYOUT SETTINGS */
  $form['rmeble_settings']['layout'] = [
    '#type' => 'details',
    '#title' => t('Layout'),
    '#weight' => 2,
    '#group' => 'rmeble_settings',
  ];

  $form['rmeble_settings']['layout']['display'] = [
    '#type' => 'fieldset',
    '#title' => t('Display settings'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  ];

  $form['rmeble_settings']['layout']['display']['sticky-header'] = [
    '#type' => 'checkbox',
    '#prefix' => '<label class="custom-label">Sticky Header</label>',
    '#title' => t('Enable Sticky Header?'),
    '#description' => t('Checking this option will enable a sticky header on desktop/widescreen devices.'),
    '#default_value' => theme_get_setting('sticky-header'),
  ];

  $form['rmeble_settings']['layout']['media'] = [
    '#type' => 'fieldset',
    '#title' => t('Media settings'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  ];


  $form['rmeble_settings']['layout']['media']['csTopImage'] = array(
    '#type'          => 'managed_file',
    '#title'         => t('Top Image'),
    '#default_value' => theme_get_setting('csTopImage'),
    '#description'   => t("The sites default Top image."),
    '#upload_validators' => array(
      'file_validate_extensions' => array(0 => 'png jpg jpeg gif'),
    ),
    '#upload_location' => 'public://theme-seting',
  );

  $form['rmeble_settings']['layout']['media']['csBottomImage'] = array(
    '#type'          => 'managed_file',
    '#title'         => t('Bottom Image'),
    '#default_value' => theme_get_setting('csBottomImage'),
    '#description'   => t("The sites default Bottom image."),
    '#upload_validators' => array(
      'file_validate_extensions' => array(0 => 'png jpg jpeg gif'),
    ),
    '#upload_location' => 'public://theme-seting',
  );

  $form['rmeble_settings']['layout']['page-settings'] = [
    '#type' => 'fieldset',
    '#title' => t('Page settings'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  ];

  $form['rmeble_settings']['layout']['page-settings']['cs_pagetitle'] = [
    '#type' => 'textfield',
    '#title' => t('Homepage Title'),
    '#default_value' => theme_get_setting('cs_pagetitle'),
  ];

  $form['rmeble_settings']['layout']['page-settings']['cs_subpagetitle'] = [
    '#type' => 'textarea',
    '#rows' => '3',
    '#title' => t('Homepage Subtitle'),
    '#default_value' => theme_get_setting('cs_subpagetitle'),
  ];

  $form['rmeble_settings']['layout']['page-settings']['cs_footer'] = [
    '#type' => 'textarea',
    '#rows' => '3',
    '#title' => t('Footer'),
    '#default_value' => theme_get_setting('cs_footer'),
  ];

  $form['rmeble_settings']['layout']['page-settings']['main_phone'] = [
    '#type' => 'textfield',
    '#title' => t('Main Phone number'),
    '#default_value' => theme_get_setting('main_phone'),
  ];

  $form['rmeble_settings']['layout']['page-settings']['main_mobile'] = [
    '#type' => 'textfield',
    '#title' => t('Main Mobile Phone number'),
    '#default_value' => theme_get_setting('main_mobile'),
  ];

  $form['rmeble_settings']['layout']['page-settings']['main_address'] = [
    '#type' => 'textfield',
    '#title' => t('Main address'),
    '#default_value' => theme_get_setting('main_address'),
  ];

  /* Social SETTINGS */
  $form['rmeble_settings']['layout']['page-settings']['social'] = [
    '#type' => 'fieldset',
    '#title' => t('Social media settings'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  ];
  $form['rmeble_settings']['layout']['page-settings']['social']['facebook'] = [
    '#type' => 'textfield',
    '#title' => t('Facebook'),
    '#default_value' => theme_get_setting('facebook'),
  ];
  $form['rmeble_settings']['layout']['page-settings']['social']['youtube'] = [
    '#type' => 'textfield',
    '#title' => t('Youtube'),
    '#default_value' => theme_get_setting('youtube'),
  ];

  $form['rmeble_settings']['layout']['page-settings']['social']['instagram'] = [
    '#type' => 'textfield',
    '#title' => t('Instagram'),
    '#default_value' => theme_get_setting('instagram'),
  ];

  _rmeble_settings_global_tab($form);

  $form['#submit'][] = 'rmeble_form_system_theme_settings_submit';
}

function rmeble_form_system_theme_settings_submit(&$form, $form_state) {
  $image_fid = $form_state->getValue('csTopImage');
  $image_bottom = $form_state->getValue('csBottomImage');
  if (count($image_fid) > 0 || count($image_bottom) > 0) {
    $default_file_dir = 'public://theme-seting';
    $folder = file_prepare_directory($default_file_dir, FILE_CREATE_DIRECTORY);
    if ($folder){
      if(count($image_fid) > 0) {
        $image =  Drupal\file\Entity\File::load( $image_fid[0]);
        if(count($image_bottom) > 0) {
          $image_bottom =  Drupal\file\Entity\File::load($image_bottom[0]);
        }
      } else if (count($image_bottom) > 0) {
        $image =  Drupal\file\Entity\File::load($image_bottom[0]);
      }
      if (is_object($image)) {
        // Check to make sure that the file is set to be permanent.
        if (!$image->isPermanent()) {
          $image->setPermanent();
          $image->save();
          // Add a reference to prevent warnings.
          $file_usage = \Drupal::service('file.usage');
          $file_usage->add($image, 'renoplast', 'theme', 1, $image_bottom[0], 'file' );
          \Drupal::messenger()->addMessage('Say something else');
        }
        if(is_object($image_bottom)) {
          if (!$image_bottom->isPermanent()) {
            $image_bottom->setPermanent();
            $image_bottom->save();
            // Add a reference to prevent warnings.
            $file_usage = \Drupal::service('file.usage');
            $file_usage->add($image_bottom, 'renoplast', 'theme', 1 );
            \Drupal::messenger()->addMessage('Say something else');
          }
        }
      }
    }
  }
}

function _rmeble_settings_global_tab(&$form) {
  // Toggles
  $form['theme_settings']['toggle_logo']['#default_value'] = theme_get_setting('toggle_logo');
  $form['theme_settings']['toggle_name']['#default_value'] = theme_get_setting('toggle_name');
  $form['theme_settings']['toggle_slogan']['#default_value'] = theme_get_setting('toggle_slogan');
  $form['theme_settings']['toggle_node_user_picture']['#default_value'] = theme_get_setting('toggle_node_user_picture');
  $form['theme_settings']['toggle_comment_user_picture']['#default_value'] = theme_get_setting('toggle_comment_user_picture');
  $form['theme_settings']['toggle_comment_user_verification']['#default_value'] = theme_get_setting('toggle_comment_user_verification');
  $form['theme_settings']['toggle_favicon']['#default_value'] = theme_get_setting('toggle_favicon');
  $form['theme_settings']['toggle_secondary_menu']['#default_value'] = theme_get_setting('toggle_secondary_menu');


  $form['logo']['default_logo']['#default_value'] = theme_get_setting('default_logo');
  $form['logo']['settings']['logo_path']['#default_value'] = theme_get_setting('logo_path');
  $form['favicon']['default_favicon']['#default_value'] = theme_get_setting('default_favicon');
  $form['favicon']['settings']['favicon_path']['#default_value'] = theme_get_setting('favicon_path');


  /* GOOGLE SETTINGS */
  $form['rmeble_settings']['global_settings'] = [
    '#type' => 'details',
    '#title' => t('Global'),
    '#weight' => 1,
    '#group' => 'rmeble_settings',
  ];

  $form['theme_settings']['#collapsible'] = TRUE;
  $form['theme_settings']['#collapsed'] = TRUE;
  $form['logo']['#collapsible'] = TRUE;
  $form['logo']['#collapsed'] = FALSE;
  $form['favicon']['#collapsible'] = TRUE;
  $form['favicon']['#collapsed'] = FALSE;

  $form['rmeble_settings']['global_settings']['logo'] = $form['logo'];
  $form['rmeble_settings']['global_settings']['favicon'] = $form['favicon'];
  $form['rmeble_settings']['global_settings']['theme_settings'] = $form['theme_settings'];

  unset($form['theme_settings']);
  unset($form['logo']);
  unset($form['favicon']);
}

