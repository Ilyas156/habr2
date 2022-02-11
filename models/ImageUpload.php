<?php

namespace app\models;

use Yii;
use yii\base\Model;


class ImageUpload extends Model
{
    public $image;

    public function rules()
    {
        return [
            // username and password are both required
            [['image'], 'required'],
            [['image'], 'file', 'extensions' => 'jpg,png']
        ];
    }

    public function uploadImage($image, $currentImage=null) // upload image to server
    {

        $this->image = $image;

        if($this->validate())
        {
            $this->deleteCurrentImage($currentImage);
            return $this->saveImage();
        }

        return false;
    }

    private function getFolder() // returns the folder in which the images should be stored
    {
        return Yii::getAlias('@web') . 'images/';
    }

    private function generateFilename() // generate random name for image
    {
        return strtolower(md5(uniqid($this->image->baseName)) . '.' . $this->image->extension);
    }

    public function deleteCurrentImage($currentImage)
    {
        if($this->fileExists($currentImage))
        {
            unlink($this->getFolder() . $currentImage);
        }
    }

    public function fileExists($currentImage)
    {
        if(!empty($currentImage))
        {
            return file_exists($this->getFolder() . $currentImage);
        }

        return false;
    }

    public function saveImage() // save image on server
    {
        $filename = $this->generateFilename();

        $this->image->saveAs($this->getFolder() . $filename);

        return $filename;
    }

}