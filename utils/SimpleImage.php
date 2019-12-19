<?php
namespace app\utils;

class SimpleImage
{

    private $image;
    private $image_type;

    public function __construct($filename)
    {
        $image_info = getimagesize($filename);
        $this->image_type = $image_info[2];
        if ($this->image_type == IMAGETYPE_JPEG) {
            $this->image = imagecreatefromjpeg($filename);
        } elseif ($this->image_type == IMAGETYPE_GIF) {
            $this->image = imagecreatefromgif($filename);
        } elseif ($this->image_type == IMAGETYPE_PNG) {
            $this->image = imagecreatefrompng($filename);
        }
    }

    public function save($filename, $image_type = null, $compression = 75, $permissions = null)
    {
        if (is_null($image_type)) {
            $image_type = $this->image_type;
        }

        $this->fixAlpha();

        if ($image_type == IMAGETYPE_JPEG) {
            imagejpeg($this->image, $filename, $compression);
        } elseif ($image_type == IMAGETYPE_GIF) {
            imagegif($this->image, $filename);
        } elseif ($image_type == IMAGETYPE_PNG) {
            imagepng($this->image, $filename);
        }
        if ($permissions != null) {
            chmod($filename, $permissions);
        }
    }

    public function getWidth()
    {
        return imagesx($this->image);
    }

    public function getHeight()
    {
        return imagesy($this->image);
    }

    public function resizeToHeight($height)
    {
        $ratio = $height / $this->getHeight();
        $width = $this->getWidth() * $ratio;
        $this->resize($width, $height);
        return $this;
    }

    public function resizeToWidth($width)
    {
        $ratio = $width / $this->getWidth();
        $height = $this->getHeight() * $ratio;
        $this->resize($width, $height);
        return $this;
    }

    public function scale($scale)
    {
        $width = $this->getWidth() * $scale / 100;
        $height = $this->getHeight() * $scale / 100;
        $this->resize($width, $height);
        return $this;
    }

    public function resizeToSquare($width, $height)
    {
        $width_ratio = $width / $this->getWidth();
        $height_ratio = $height / $this->getHeight();
        $ratio = min($width_ratio, $height_ratio);
        if ($ratio < 1){
            $this->scale($ratio*100);
        }
        return $this;
    }

    public function resize($width, $height)
    {
        $new_image = imagecreatetruecolor($width, $height);

        $this->fixAlpha($new_image);

        imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(),
            $this->getHeight());
        $this->image = $new_image;
        return $this;
    }

    public function fixAlpha($image = null)
    {
        if ($this->image_type == IMAGETYPE_PNG) {
            if (is_null($image)) {
                $image = $this->image;
            }
            imagealphablending($image, true);
            $transparent = imagecolorallocatealpha($image, 0, 0, 0, 127 );
            imagefill($image, 0, 0, $transparent );
            imagealphablending( $image, false );
            imagesavealpha( $image, true );
        }
    }
}