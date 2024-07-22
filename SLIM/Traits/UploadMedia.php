<?php


namespace App\Traits;


use Illuminate\Database\Eloquent\Model;

Trait UploadMedia
{


      public function uploadFile($model, $file, $directory)
      {
          $fileName=$file->HashName();
          $file->storeAs($directory, $fileName);
          $model->media()->create(['file'=>$directory.'/'.$fileName]);
      }
}
