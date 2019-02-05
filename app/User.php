<?php

namespace App;


use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Session;
use Lab404\Impersonate\Models\Impersonate;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    const DEFAULT_PHOTO = 'default.png';
//    const PHOTOS_PATH = 'user_photos';
    const DEFAULT_PHOTO_PATH = 'app/photos/' . self::DEFAULT_PHOTO;

    use HasRoles,Notifiable, HasApiTokens, Impersonate;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function photo()
    {
        return $this->hasOne(Photo::class);
    }

    public function assignPhoto(Photo $photo)
    {
        $photo->user_id = $this->id;
        $photo->save();
        return $this;
    }

    public function avatars()
    {
        return $this->hasMany(Avatar::class);
    }

    public function addAvatar(Avatar $avatar)
    {
        $this->avatars()->save($avatar);
        return $this;
    }

    /**
     * @return mixed
     */
    public function canImpersonate()
    {
        return $this->isSuperAdmin();
    }

    public function canBeImpersonated()
    {
        return !$this->isSuperAdmin();
    }

    public function impersonatedBy()
    {
        if ($this->isImpersonated()) return User::findOrFail(Session::get('impersonated_by'));
        return null;
    }

    public function tasks()
    {
         return $this->hasMany(Task::class);
    }

    public function addTask($task)
    {
        $this->tasks()->save($task);
    }

    public function addTasks($tasks)
    {
        $this->tasks()->saveMany($tasks);
    }

    public function haveTask(Task $task)
    {
        return $this->tasks()->where('id',$task->id)->first();
    }

    public function removeTask(Task $task)
    {
        $task = $this->haveTask($task);
        if(!is_null($task)) {
            return $task->delete();
        }
        return false;
    }

    public function tags()
    {
        return $this->hasMany(Tag::class);
    }

    public function addTag(Tag $tag){
        $this->tags()->save($tag);
    }

    public function addTags($tags){
        $this->tags()->saveMany($tags);
    }

    public function haveTag(Tag $tag)
    {
        return $this->tags()->where('id',$tag->id)->first();
    }

    public function removeTag(Tag $tag)
    {
        $tag = $this->haveTag($tag);
        if(!is_null($tag)) {
            return $tag->delete();
        }
        return false;
    }

    /**
     * @return mixed
     *
     */
    public function isSuperAdmin()
    {
        return $this->admin;
    }

    public function map()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'gravatar' => $this->gravatar,
            'admin' => (boolean)$this->admin,
            'roles' => $this->roles()->pluck('name')->unique()->toArray(),
            'permissions' => $this->getAllPermissions()->pluck('name')->unique()->toArray(),
            'hash_id' => $this->hash_id,
        ];
    }

    public function mapSimple()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'gravatar' => $this->gravatar,
            'admin' => (boolean) $this->admin,
            'hash_id' => $this->hash_id,
        ];
    }

    /**
     * Get the user's full name
     * @return string
     */
    public function getGravatarAttribute()
    {
        return 'https://www.gravatar.com/avatar/'.md5($this->email);
    }

    public function scopeRegular($query)
    {
        return $query ->where('admin', false);
    }

    public function scopeAdmin($query)
    {
        return $query ->where('admin', true);
    }


    /**
     * Hashed key.
     * @return string
     */
    protected function hashedKey()
    {
        $hashids = new \Hashids\Hashids(config('tasks.salt'));
        return $hashids->encode($this->getKey());
    }

    /**
     * Get the photo path prefix.
     *
     * @param  string  $value
     * @return string
     */
    public function getHashIdAttribute($value)
    {
        return $this->hashedKey();
    }
}
