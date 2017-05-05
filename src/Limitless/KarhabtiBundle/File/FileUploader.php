<?php
/**
 * Created by PhpStorm.
 * User: sana
 * Date: 14/02/2017
 * Time: 21:08
 */
namespace Limitless\KarhabtiBundle\File;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    private $targetDir;

    public function __construct($targetDir)
    {
        $this->targetDir = $targetDir;
    }

    public function upload(UploadedFile $file)
    {
        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        $file->move($this->targetDir, $fileName);

        return $fileName;
    }
}