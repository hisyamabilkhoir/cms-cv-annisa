<?php

if (!function_exists('upload_file')) {
    function upload_file($request, $fieldName, $uploadPath, $oldFileName = null)
    {
        $file = $request->getFile($fieldName);

        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Generate random name
            $newName = $file->getRandomName();
            
            // Move file
            $file->move(FCPATH . 'assets/uploads/' . $uploadPath, $newName);

            // Delete old file if exists
            if ($oldFileName && file_exists(FCPATH . 'assets/uploads/' . $uploadPath . '/' . $oldFileName)) {
                @unlink(FCPATH . 'assets/uploads/' . $uploadPath . '/' . $oldFileName);
            }

            return $newName;
        }

        return $oldFileName;
    }
}
