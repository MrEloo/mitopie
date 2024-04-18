<?php

class Uploader
{
    public function upload(array $files, string $inputName): void
    {
        $tempImagePath = $files[$inputName]['tmp_name'];

        $name = $files[$inputName]['name'];

        move_uploaded_file($tempImagePath, "./uploads/$name");
    }
}
