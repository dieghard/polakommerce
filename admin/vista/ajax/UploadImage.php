<?php

$superArray = array();
$superArray['success'] = true;
$superArray['carpetaimagen'] = '';
$path = '';

if (!isset($_POST["vengode"])) :
   $superArray['success'] = false;
   return json_encode($superArray);
endif;

if (isset($_POST["vengode"]) == 'rubros') :
   $path = '../../../assets/img/rubros/';
endif;

$superArray['success'] = false;

if (($_FILES["file"]["type"] == "image/pjpeg")
   || ($_FILES["file"]["type"] == "image/jpeg")
   || ($_FILES["file"]["type"] == "image/png")
   || ($_FILES["file"]["type"] == "image/gif")
) :

   if (move_uploaded_file($_FILES["file"]["tmp_name"], $path . $_FILES['file']['name'])) :
      //more code here...
      $pathTotal = $path . $_FILES['file']['name'];
      //echo $pathTotal;
      $superArray['nombreArchivo'] = $_FILES['file']['name'];
      $superArray['carpetaimagen'] = $pathTotal;
      $superArray['success'] = true;
   endif;
endif;

echo json_encode($superArray);
