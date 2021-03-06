<?php

require_once 'training.civix.php';

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function training_civicrm_config(&$config) {
  _training_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @param $files array(string)
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function training_civicrm_xmlMenu(&$files) {
  _training_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function training_civicrm_install() {
  _training_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function training_civicrm_uninstall() {
  _training_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function training_civicrm_enable() {
  _training_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function training_civicrm_disable() {
  _training_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed
 *   Based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function training_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _training_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function training_civicrm_managed(&$entities) {
  _training_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function training_civicrm_caseTypes(&$caseTypes) {
  _training_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function training_civicrm_angularModules(&$angularModules) {
_training_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function training_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _training_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Functions below this ship commented out. Uncomment as required.
 *

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
function training_civicrm_preProcess($formName, &$form) {

}

*/

/**
 *Fetches a county name for a given postal code
 *
 *@param string $postal_code
 *@retrun mixed Boolean False on error, county
 *name as string on success
 */

 
 function training_civicrm_post($op, $objectName, $objectId, &$objectRef) {
  if (($op == 'create' || $op == 'edit')  && $objectName == 'Address') {
    
    $zip = $objectRef->postal_code;
  $county = _trainingFetchCountyByPostalCode($zip);
   $id = $objectRef->contact_id;
   //print $id;
  // exit;
  if (isset($county)){
  
         $result = civicrm_api3('CustomValue', 'create', array(
    'entity_id' => $id,
     'custom_8'  =>$county
    
    ));
  }else{
     print "error";
  }
 
  
    
  }
  
 }
 
 
 function _trainingFetchCountyByPostalCode($postal_code){
  
 $url = "http://www.zipwise.com/webservices/zipinfo.php?key=u5maw9jgh0oerddb&zip=$postal_code&format=json";
 $result = CRM_Utils_HttpClient::singleton()->get($url) ;
//$test=function_exists("curl_init");

// var_dump($result);
$result = json_decode($result[1], true);
$county = $result['results']['county'];
return $county;
//print ($result[1]);
 //exit;
 
 }