<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    

    //ORM
    //$folder->folders as subfolder
    public function folders()
    {
        return $this->hasMany(Folder::class, 'parent_id', 'id'); //mapping folders to its 'parent_id'
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
