<?php namespace Controllers;

use Models\File as File;
class FileController
{
     private $uploadFilePath;
     private $allowedExtensions;
     private $maxSize;

     function __construct() {
           $this->allowedExtensions = array('png', 'jpg', 'gif','mp4');
           $this->maxSize = 5000000;
           $this->uploadFilePath = IMG_ROOT;
     }

     /**
      *
      */
     public function getAllowedExtensions() {
          return $this->allowedExtensions;
     }

     /**
      *
      */
     public function getMaxSize() {
          return $this->maxSize;
     }


     /**
      * @method upluad
      *
      * @param File $archivo
      * @param String $tipo  (avatars, covers, walls)
      */
        public function upload($file, $tipo= null) {

          $fileAvatar = new File($file['name'], $file['full_path'], $file['type'],$file['tmp_name'],$file['error'],$file['size']);

          $filePath = $this->uploadFilePath . "/$tipo/";

          // Si no existe el directorio, lo crea.
          if(!file_exists($filePath))
               mkdir($filePath);

          $fileName = $fileAvatar->getName();

          $fileLocation = $filePath . $fileName;	// ruta completa y archivo.

          //Obtenemos la extensión del archivo. No sirve para comprobar el verdadero tipo del archivo
          $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

          if(in_array($fileExtension, $this->allowedExtensions) ) {


               if(!file_exists($fileLocation)) {

                    if($fileAvatar->getSize() < $this->maxSize) { //Menor a 5 MB

                         if (move_uploaded_file( $fileAvatar->getTmp_name(), $fileLocation)){	//guarda el archivo subido en el directorio 'images/' tomando true si lo subio, y false si no lo hizo

                              //$alerta = 'el archivo '. $nombreArchivo .' fue subido correctamente.';
                              return IMG_PATH."/".$tipo."/".$fileName;
                         }
                    }
               }
          }
          return false;
     }
}