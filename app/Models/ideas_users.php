<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ideas_users extends Model
{
    use HasFactory;
 /**
 * The table associated with the model.
 *
 * @var string
 */
protected $table = 'ideas_user';
protected $guarded=[];

}
