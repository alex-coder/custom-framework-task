<?php
    namespace Core;


    class Resizer
    {
        protected $imageWidth;
        protected $imageHeight;
        protected $imageType;
        protected $image;
        private $file;

        public function __construct($file)
        {
            $this->file = $file;
            list($this->imageWidth, $this->imageHeight, $this->imageType) = getimagesize($file);
            $this->image = $this->crateImage();
        }

        protected function crateImage()
        {
            switch ($this->imageType) {
                case IMAGETYPE_JPEG:
                    return imagecreatefromjpeg($this->file);
                case IMAGETYPE_PNG:
                    return imagecreatefrompng($this->file);
                case IMAGETYPE_GIF:
                    return imagecreatefromgif($this->file);
                default:
                    throw new \ErrorException("Unsupported image type {$this->imageType}");
            }
        }

        public function resize($width, $height)
        {
            $imageRatio = $this->imageWidth / $this->imageHeight;
            $newRatio = $width / $height;

            if ($imageRatio === $newRatio) return;

            if ($imageRatio > $newRatio) {
                $newWidth = $width;
                $newHeight = ($width * $this->imageHeight) / $this->imageWidth;
            } else {
                $newHeight = $height;
                $newWidth = ($width * $this->imageWidth) / $this->imageHeight;
            }

            $this->imageResize($newWidth, $newHeight);
        }

        protected function imageResize($width, $height)
        {
            $newImage = imagecreatetruecolor($width, $height);
            imagecopyresampled(
                $newImage,
                $this->image,
                0, 0, 0, 0,
                $width, $height,
                $this->imageWidth, $this->imageHeight
            );

            $this->imageWidth = $width;
            $this->imageHeight = $height;
            $this->image = $newImage;
        }

        public function write($saveTo, $filename)
        {
            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            $filePath = rtrim($saveTo, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . basename($filename, ".{$ext}");
            switch ($ext) {
                case 'jpeg':
                case 'jpg':
                    return imagejpeg($this->image, "{$filePath}.jpg", 100);
                case 'png':
                    return imagepng($this->image, "{$filePath}.png");
                case 'gif':
                    return imagegif($this->image, "{$filePath}.gif");
            }

            throw new \ErrorException("Unsupported file extension {$ext}");
        }
    }