<?php

 return  array(        
     array (
    'module' => 'com.civicrm.training',
    'name' => 'countyfield',
    'entity' => 'CustomField',
    'params' => array(
      'version' => 3,
      'label' => 'County',
      'component' => 'CiviContact',
      'data_type' => 'String',
      'custom_group_id' => civicrm_api3('CustomGroup', 'getvalue', array(
      'name' => 'constituent_information',
      'return' => 'id',
       )),
      'is-active' => '1',
      'html_type' => 'Text',
      'name' => 'county',
      
    ),
  
  )
     
     
     
     
     
     
     
     
     );
 