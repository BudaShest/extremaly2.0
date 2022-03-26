<?php

namespace app\modules\admin\models\interfaces;

interface IFileWorkable
{
    public function upload(string $fileFolder): bool;

    public function deleteFiles(string $fileFolder): bool;
}