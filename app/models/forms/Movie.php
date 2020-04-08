<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 07.04.2020
 * Time: 14:36
 */

namespace app\models\forms;

use app\models\Movie as Model;

/**
 * Form for adding or changing movie
 * @package app\models\forms
 */
class Movie extends Model
{
    /**
     * Image code for src attribute
     * @var string
     */
    public $posterCode;

    /**
     * @return bool
     */
    public function validate() : bool
    {
        if(!empty($_FILES["poster"]["tmp_name"]) && is_uploaded_file($_FILES['poster']['tmp_name'])) {
            // Allow certain file formats
            $allowTypes = array('image/jpg', 'image/png', 'image/jpeg', 'image/gif');
            $fileType = mime_content_type($_FILES["poster"]["tmp_name"]);
            if (in_array($fileType, $allowTypes)) {
                $size = filesize($_FILES['poster']['tmp_name']);
                if ($size <= 200000) {
                    $this->poster = 'data:' . $fileType . ';base64,' . base64_encode(file_get_contents($_FILES['poster']['tmp_name']));
                } else {
                    $this->error = 'Sorry, Maximum size of the uploaded image should not be more than 200 kb.';
                    return false;
                }
            } else {
                $this->error = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed to upload.';
                return false;
            }
        } else if (!empty($this->posterCode)) {
            $this->poster = $this->posterCode;
        }else{
            $this->error = 'Please select a file to upload.';
            return false;
        }
        return parent::validate();
    }
}