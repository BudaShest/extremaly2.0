<?php

namespace app\modules\admin\models\interfaces;

interface IFileWorkable
{
    public function upload(string $fileField): bool;

    public function deleteFiles(): bool;
}