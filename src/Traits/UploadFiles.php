<?php
/**
 * Created by PhpStorm.
 * User: nikitakravchenko
 * Date: 20/04/2019
 * Time: 00:15
 */

namespace App\Traits;


trait UploadFiles
{
/**TODO CHANGE THE METHODS FOR A TRAIT USE**/
    public function createNewImageToGallery($params)
    {

        $this->confirm = false;

        $uploadDir = $this->uploadDir;
        $allowedFormat = ['jpg', 'jpeg', 'gif', 'png', 'svg'];

        if (!empty($_FILES['file'])) {

            foreach ($_FILES['file']["error"] as $key => $error) {
                if ($error == UPLOAD_ERR_OK) {
                    $tmp_name = $_FILES['file']["tmp_name"][$key];
                    // basename() может спасти от атак на файловую систему;
                    // может понадобиться дополнительная проверка/очистка имени файла
                    $name = basename($_FILES['file']["name"][$key]);
                    $file_parts = explode('.', $name);    //разделить имя файла и поместить его в массив
                    $ext = strtolower(array_pop($file_parts));    //последний элеменет - это расширение
                    $imagePath = $this->imagePath;
                    $simplePath = '/image/' . $imagePath;
                    $thumbsPath = $simplePath. 'thumbnail/';
                    $md5FileName = md5($name . time()) . "." . $ext;
                    $fileSize = $_FILES['file']['size'][$key];

                    $params['name'] = $name;
                    $params['name_md5'] = $md5FileName;
                    $params['path'] = $simplePath;
                    $params['path_thumbnail'] = $thumbsPath;
                    $uploadPath = $uploadDir . $imagePath . $md5FileName;

                    if ($fileSize <= MAX_TO_UPLOAD && in_array($ext, $allowedFormat)) {

//                        var_dump(mkdir(dirname($uploadPath), 0777, true));

                        if (!is_dir(dirname($uploadPath))){
                            mkdir(dirname($uploadPath),0777, true);
                        }

//                        var_dump(move_uploaded_file($tmp_name,  $uploadPath));

                        if(move_uploaded_file($tmp_name, $uploadPath)) {



                            if (!is_dir(dirname($thumbsPath . $md5FileName))){
                                mkdir(dirname($thumbsPath . $md5FileName),0777, true);
                            }

//                            var_dump($this->uploadDir . 'gallery/thumbnail/' . $md5FileName);

                            if ($this->createThumbnail($uploadPath, $this->uploadDir . 'gallery/thumbnail/' . $md5FileName, 320, 213)){


                                if ($this->create($params)){
                                    $this->confirm = true;
                                } else $this->confirm = false;

                            }





                        }
                    }
                }
            }
        }
        return $this->confirm;
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

    public function deleteImage($params)
    {
        if (!empty($params->get('id')) && !empty($params->get('name_md5'))){


            $id = $params->get('id');
            $name_md5 = $params->get('name_md5');
            $file = $this->uploadDir . $this->imagePath . $name_md5;
            $thumbnail = $this->uploadDir . $this->imagePath . 'thumbnail/'. $name_md5;
//            var_dump(is_file($thumbnail));



            if ($this->delete($id)){
                if(is_file($file) && is_file($thumbnail)){
                    return (unlink($file) && unlink($thumbnail));
                }
            } return false;


        } return false;
    }

}