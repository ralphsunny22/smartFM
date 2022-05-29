<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Folder;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            $slug = Str::slug($user->name);
            $root_file_name = $slug.'-'.$user->id;
            $user->root_file_name = $slug.'-'.$user->id;
            Storage::disk('public')->makeDirectory($root_file_name);
            $user->save(); 

            //$path = storage_path('app/path/to');
            
            $folder = new Folder;
            $folder->unique_key = Str::random(30);
            $folder->title = 'Main'; //what users will see
            $folder->slug = $root_file_name;
            $folder->created_by = $user->id;
            $folder->path_by_slug = $root_file_name;
            $folder->path_by_title = 'Main';
            $folder->save();
            
        });
    }

    public function folders(){
        return $this->hasMany(Folder::class, 'created_by');
    }
    public function myFiles(){
        return $this->hasMany(MyFile::class, 'created_by');
    }

    // public function permissions(){
    //     return $this->belongsToMany(Permission::class, 'user_permissions');
    // }

    public static function not_user_permissions($permission_id, $user_id){
        $user = User::find($user_id);
        $user_perms = $user->getDirectPermissions();
        foreach($user_perms as $perm){
            $user_perms_ids[] = $perm->id; //[1,2]
        }

        if (in_array($permission_id, $user_perms_ids)) {
            return true;
        }
        return false;
        
    }
}
