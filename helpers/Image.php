<?php
namespace app\helpers;

use Yii;
use yii\helpers\BaseFileHelper;
use yii\web\UploadedFile;
use yii\web\HttpException;

use app\utils\SimpleImage;

class Image
{
    public static function upload(UploadedFile $fileInstance, $dir = '')
    {
        $fileName = Upload::getUploadPath($dir) . DIRECTORY_SEPARATOR . Upload::getFileName($fileInstance);

        $uploaded = $fileInstance->saveAs($fileName);

        if(!$uploaded){
            throw new HttpException(500, 'Cannot upload file "'.$fileName.'". Please check write permissions.');
        }

        return Upload::getLink($fileName);
    }

    public static function thumbnail($path, $width, $height)
    {
        if (!file_exists(\Yii::getAlias('@webroot') . $path)) {
            return null;
        }
        $width = (int)$width;
        $height = (int)$height;

        $thumbpath = \Yii::getAlias('@webroot/thumbnails/') . $width . "x" . $height . $path;

        if (!file_exists($thumbpath)) {
            BaseFileHelper::createDirectory(dirname($thumbpath));
            $img = new SimpleImage(\Yii::getAlias('@webroot') . $path);
            $img->resizeToSquare($width, $height)->save($thumbpath);
        }

        return \Yii::getAlias('@web/thumbnails/') . $width . "x" . $height . $path;
    }
}