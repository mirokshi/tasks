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
            'permissions' => $this->getAllPermissions()->pluck('name')->unique()->toArray()
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
}
