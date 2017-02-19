<?php
return array (
  'Common' => 
  array (
    'afterSave' => 
    array (
      0 => '\\Espo\\Hooks\\Common\\AssignmentEmailNotification',
      1 => '\\Espo\\Hooks\\Common\\Stream',
      2 => '\\Espo\\Hooks\\Common\\NextNumber',
      3 => '\\Espo\\Hooks\\Common\\Notifications',
    ),
    'beforeSave' => 
    array (
      0 => '\\Espo\\Hooks\\Common\\CurrencyConverted',
      1 => '\\Espo\\Hooks\\Common\\Formula',
      2 => '\\Espo\\Hooks\\Common\\NextNumber',
    ),
    'beforeRemove' => 
    array (
      0 => '\\Espo\\Hooks\\Common\\Notifications',
    ),
    'afterRemove' => 
    array (
      0 => '\\Espo\\Hooks\\Common\\Stream',
      1 => '\\Espo\\Hooks\\Common\\Notifications',
    ),
    'afterRelate' => 
    array (
      0 => '\\Espo\\Hooks\\Common\\Stream',
    ),
    'afterUnrelate' => 
    array (
      0 => '\\Espo\\Hooks\\Common\\Stream',
    ),
  ),
  'Integration' => 
  array (
    'afterSave' => 
    array (
      0 => '\\Espo\\Hooks\\Integration\\GoogleMaps',
    ),
  ),
  'Note' => 
  array (
    'beforeSave' => 
    array (
      0 => '\\Espo\\Hooks\\Note\\Mentions',
    ),
    'afterSave' => 
    array (
      0 => '\\Espo\\Hooks\\Note\\Notifications',
    ),
  ),
);
?>