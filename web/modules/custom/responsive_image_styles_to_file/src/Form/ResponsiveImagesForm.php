<?php  
/**  
 * @file  
 * Contains Drupal\responsive_image_styles_to_file\Form\ResponsiveImageForm.  
 */  
namespace Drupal\responsive_image_styles_to_file\Form;  
use Drupal\Core\Form\ConfigFormBase;  
use Drupal\Core\Form\FormStateInterface;  

use Drupal\responsive_image_styles_to_file\ResponsiveImageStylesFile;

class ResponsiveImagesForm extends ConfigFormBase {  
    /**  
   * {@inheritdoc}  
   */  

  protected function getEditableConfigNames() {  
    return [  
      'responsive_image_styles_to_file.adminsettings',  
    ];  
  }

   /**  
   * {@inheritdoc}  
   */  
  public function getFormId() {  
    return 'responsive_image_styles_to_file_form';
  }


  public function buildForm(array $form, FormStateInterface $form_state) {
    // Retrieve the stored configuration settings
    $config = $this->config('responsive_image_styles_to_file.adminsettings');

    return parent::buildForm($form, $form_state);
    
  }

    /**  
   * {@inheritdoc}  
   */  
  public function submitForm(array &$form, FormStateInterface $form_state) {  
    parent::submitForm($form, $form_state);  

    drupal_set_message($this
    ->t('The responsive image styles have been genereted.'));
    
    ResponsiveImageStylesFile::generateResponsiveImageStylesFile();
    drupal_flush_all_caches();

  }  


}  