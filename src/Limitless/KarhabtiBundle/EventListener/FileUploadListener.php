<?php
/**
 * Created by PhpStorm.
 * User: sana
 * Date: 14/02/2017
 * Time: 21:40
 */
namespace Limitless\KarhabtiBundle\EventListener;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Limitless\KarhabtiBundle\Entity\Image;
use Limitless\KarhabtiBundle\FileUploader;

class FileUploadListener
{
    private $uploader;

    public function __construct(  $uploader)
    {
        $this->uploader = $uploader;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    private function uploadFile($entity)
    {
        // upload only works for Product entities
        if (!$entity instanceof Image) {
            return;
        }

        $file = $entity->getFile();

        // only upload new files
        if (!$file instanceof UploadedFile) {
            return;
        }

        $fileName = $this->uploader->upload($file);
        $entity->setFile($fileName);
    }
}