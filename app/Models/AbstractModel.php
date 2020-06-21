<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractModel extends Model
{
   protected $hidden = [
       'created_at',
       'updated_at',
       'deleted_at',
       'password',
       'remember_token',
       'store_image'
   ];
}
