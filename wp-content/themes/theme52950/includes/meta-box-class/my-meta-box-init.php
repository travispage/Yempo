<?php
require_once("my-meta-box-class.php");

if (is_admin()){
  
  $prefix = 'tm_';

  $config = array(
    'id'             => 'meta_box',
    'title'          => 'Meta Box',
    'pages'          => array('post','team'),
    'context'        => 'normal',
    'priority'       => 'high',
    'fields'         => array(),
    'local_images'   => false,
    'use_with_theme' => true
  );

  $my_meta =  new AT_Meta_Box($config);
  //text field
  $my_meta->addText($prefix.'text_field_id',array('name'=> 'Custom Text'));
  //textarea field
  //$my_meta->addTextarea($prefix.'textarea_field_id',array('name'=> 'My Textarea '));
  //checkbox field
  //$my_meta->addCheckbox($prefix.'checkbox_field_id',array('name'=> 'My Checkbox '));
  //select field
  //$my_meta->addSelect($prefix.'select_field_id',array('selectkey1'=>'Select Value1','selectkey2'=>'Select Value2'),array('name'=> 'My select ', 'std'=> array('selectkey2')));
  //radio field
  //$my_meta->addRadio($prefix.'radio_field_id',array('radiokey1'=>'Radio Value1','radiokey2'=>'Radio Value2'),array('name'=> 'My Radio Filed', 'std'=> array('radionkey2')));
  //Image field
  //$my_meta->addImage($prefix.'image_field_id',array('name'=> 'My Image '));
  //file upload field
  //$my_meta->addFile($prefix.'file_field_id',array('name'=> 'My File'));

  
  $my_meta->Finish();

}
