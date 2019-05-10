<?php
/**
 * Created by PhpStorm.
 * User: nikitakravchenko
 * Date: 25/04/2019
 * Time: 23:22
 */

namespace App\Service;


use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    private $targetDirectory;
    private $particularPath;
    private $withThumbnail;

    public function __construct($targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
        $this->particularPath = '';
        $this->withThumbnail = true;
    }

    public function upload(UploadedFile $file)
    {
        $fileNameMD5 = md5(uniqid()).'.'.$file->guessExtension();
        $fileName = $file->getClientOriginalName();


        try {
            $file->move($this->getTargetDirectory(), $fileNameMD5);
            if ($this->withThumbnail) {
                $this->createThumbnail($this->getTargetDirectory(). $fileNameMD5, $this->getTargetDirectory() . 'thumbnail/' . $fileName, 320, 213);
            }
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }


        return ['name'=>$fileName, 'name_md5' => $fileNameMD5];
    }

    public function setParticularPath(string $path)
    {
        $this->particularPath = $path;
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory . $this->particularPath;
    }


    public function createThumbnail($path, $save, $width, $height)
    {

        $info = getimagesize($path); //получаем размеры картинки и ее тип
        $size = array($info[0], $info[1]); //закидываем размеры в массив

        //В зависимости от расширения картинки вызываем соответствующую функцию
        if ($info['mime'] == 'image/png') {
            $src = imagecreatefrompng($path); //создаём новое изображение из файла
        } else if ($info['mime'] == 'image/jpeg') {
            $src = imagecreatefromjpeg($path);
        } else if ($info['mime'] == 'image/gif') {
            $src = imagecreatefromgif($path);
        } else {
            return false;
        }

        $thumb = imagecreatetruecolor($width, $height); //возвращает идентификатор изображения, представляющий черное изображение заданного размера
        $src_aspect = $size[0] / $size[1]; //отношение ширины к высоте исходника
        $thumb_aspect = $width / $height; //отношение ширины к высоте аватарки

        if ($src_aspect < $thumb_aspect) {
//	    узкий вариант (фиксированная ширина)
            $scale = $width / $size[0];
            $new_size = array($width, $width / $src_aspect);
            $src_pos = array(0, ($size[1] * $scale - $height) / $scale / 2);
//        Ищем расстояние по высоте от края картинки до начала картины после обрезки
        } else if ($src_aspect > $thumb_aspect) {
//		широкий вариант (фиксированная высота)
            $scale = $height / $size[1];
            $new_size = array($height * $src_aspect, $height);
            $src_pos = array(($size[0] * $scale - $width) / $scale / 2, 0); //Ищем расстояние по ширине от края картинки до начала картины после обрезки
        } else {
            //другое
            $new_size = array($width, $height);
            $src_pos = array(0, 0);
        }

        $new_size[0] = max($new_size[0], 1);
        $new_size[1] = max($new_size[1], 1);

        imagecopyresampled($thumb, $src, 0, 0, $src_pos[0], $src_pos[1], $new_size[0], $new_size[1], $size[0], $size[1]);
        //Копирование и изменение размера изображения с ресемплированием


        if ($save === false) {
            return imagejpeg($thumb); //Выводит JPEG/PNG/GIF изображение
        } else {
            return imagejpeg($thumb, $save);//Сохраняет JPEG/PNG/GIF изображение
        }

    }

    /**
     * @return bool
     */
    public function isWithThumbnail(): bool
    {
        return $this->withThumbnail;
    }

    /**
     * @param bool $withThumbnail
     */
    public function setWithThumbnail(bool $withThumbnail): void
    {
        $this->withThumbnail = $withThumbnail;
    }

}