<?php
/**
 * La clase de redimensionamiento de imagen le permitirá redimensionar una imagen
 *
 * Puede cambiar el tamaño a tamaño exacto
 * Ancho máximo mientras se mantiene la relación de aspecto
 * Altura máxima mientras se mantiene la relación de aspecto
 * Automático mientras se mantiene la relación de aspecto
 */

namespace Mini\Libs;

class ResizeImage
{
	private $ext;
	private $image;
	private $newImage;
	private $origWidth;
	private $origHeight;
	private $resizeWidth;
	private $resizeHeight;
	/**
	 * El constructor de la clase requiere enviar a través del nombre de archivo de la imagen
	 *
	 * @param string $filename - Nombre de archivo de la imagen que desea redimensionar
	 */
	public function __construct( $filename )
	{
		if(file_exists($filename))
		{
			$this->setImage( $filename );
		} else {
			throw new Exception('Imagen ' . $filename . ' no se puede encontrar, pruebe con otra imagen.');
		}
	}
	/**
	 * Establezca la variable de imagen
	 *
	 * @param string $filename - El nombre del archivo de imagen
	 */
	private function setImage( $filename )
	{
		$size = getimagesize($filename);
		$this->ext = $size['mime'];
		switch($this->ext)
	    {
	    	// Imagen es JPG
	        case 'image/jpg':
	        case 'image/jpeg':
	        	// crear una extensión jpeg
	            $this->image = imagecreatefromjpeg($filename);
	            break;
	        // Imagen es GIF
	        case 'image/gif':
	            $this->image = @imagecreatefromgif($filename);
	            break;
	        // Imagen es PNG
	        case 'image/png':
	            $this->image = @imagecreatefrompng($filename);
	            break;
	        // Tipo de mime no encontrado
	        default:
	            throw new Exception("El archivo no es una imagen, por favor utilice otro tipo de archivo.", 1);
	    }
	    $this->origWidth = imagesx($this->image);
	    $this->origHeight = imagesy($this->image);
	}
	/**
	 * Guardar la imagen como el tipo de imagen que era la imagen original
	 *
	 * @param  String[type] $savePath     - La ruta para almacenar la nueva imagen
	 * @param  string $imageQuality 	  - El nivel de calidad de la imagen a crear
	 *
	 * @return Saves la imagen
	 */
	public function saveImage($savePath, $imageQuality="100", $download = false)
	{
	    switch($this->ext)
	    {
	        case 'image/jpg':
	        case 'image/jpeg':
	        	// Compruebe que PHP soporta este tipo de archivo
	            if (imagetypes() & IMG_JPG) {
	                imagejpeg($this->newImage, $savePath, $imageQuality);
	            }
	            break;
	        case 'image/gif':
	        	// Compruebe que PHP soporta este tipo de archivo
	            if (imagetypes() & IMG_GIF) {
	                imagegif($this->newImage, $savePath);
	            }
	            break;
	        case 'image/png':
	            $invertScaleQuality = 9 - round(($imageQuality/100) * 9);
	            // Compruebe que PHP soporta este tipo de archivo
	            if (imagetypes() & IMG_PNG) {
	                imagepng($this->newImage, $savePath, $invertScaleQuality);
	            }
	            break;
	    }
	    if($download)
	    {
	    	header('Content-Description: File Transfer');
			header("Content-type: application/octet-stream");
			header("Content-disposition: attachment; filename= ".$savePath."");
			readfile($savePath);
	    }
	    imagedestroy($this->newImage);
	}
	/**
	 * Cambie el tamaño de la imagen a estas dimensiones establecidas
	 *
	 * @param  int $width        	- Ancho máximo de la imagen
	 * @param  int $height       	- Altura máxima de la imagen
	 * @param  string $resizeOption - Opción de escala para la imagen
	 *
	 * @return Save Nueva imagen
	 */
	public function resizeTo( $width, $height, $resizeOption = 'default' )
	{
		switch(strtolower($resizeOption))
		{
			case 'exact':
				$this->resizeWidth = $width;
				$this->resizeHeight = $height;
			break;
			case 'maxwidth':
				$this->resizeWidth  = $width;
				$this->resizeHeight = $this->resizeHeightByWidth($width);
			break;
			case 'maxheight':
				$this->resizeWidth  = $this->resizeWidthByHeight($height);
				$this->resizeHeight = $height;
			break;
			default:
				if($this->origWidth > $width || $this->origHeight > $height)
				{
					if ( $this->origWidth > $this->origHeight ) {
				    	 $this->resizeHeight = $this->resizeHeightByWidth($width);
			  			 $this->resizeWidth  = $width;
					} else if( $this->origWidth < $this->origHeight ) {
						$this->resizeWidth  = $this->resizeWidthByHeight($height);
						$this->resizeHeight = $height;
					}
				} else {
		            $this->resizeWidth = $width;
		            $this->resizeHeight = $height;
		        }
			break;
		}
		$this->newImage = imagecreatetruecolor($this->resizeWidth, $this->resizeHeight);
    	imagecopyresampled($this->newImage, $this->image, 0, 0, 0, 0, $this->resizeWidth, $this->resizeHeight, $this->origWidth, $this->origHeight);
	}
	/**
	 * Obtener el tamaño de la altura desde el ancho manteniendo la relación de aspecto
	 *
	 * @param  int $width - Ancho máximo de la imagen
	 *
	 * @return Height mantener la relación de aspecto
	 */
	private function resizeHeightByWidth($width)
	{
		return floor(($this->origHeight/$this->origWidth)*$width);
	}
	/**
	 * Obtener el ancho redimensionado de la altura manteniendo la relación de aspecto
	 *
	 * @param  int $height - Altura máxima de la imagen
	 *
	 * @return Width mantener la relación de aspecto
	 */
	private function resizeWidthByHeight($height)
	{
		return floor(($this->origWidth/$this->origHeight)*$height);
	}
}