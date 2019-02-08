<?php

namespace App;

use App\Traits\FormattedDates;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use FormattedDates;

    const TASKS_CACHE_KEY= 'tasks.mirokshi.scool.cat' ;

    protected $guarded = [];
//    protected $fillable = ['name', 'completed'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
protected $hidden = [
    'created_at'
    ];

    public function file()
    {
        return $this->hasOne(File::class);

    }

    //Modular
//    assing_file_to_task($task,$file) {
//        $file-> task_id = $task->id;
//        $file -> save();
//}

    //Programacion orientado a objectos
//    $task->assign_file($file){
//        $file ->task_id = this->id;
//        $file-> save();
//}

    public function assignFile(File $file)
    {
        $file->task_id = $this->id;
        $file->save();

    }
    public function addTags($tags)
    {
        try{
            $this->tags()->saveMany($tags);
        }catch (\Exception $e){

        }
    }

    public function addTag($tag)
    {

        !is_int($tag) ?: $tag = Tag::find($tag);
        try {
            $this->tags()->save($tag);
        }catch (\Exception $e){

        }
        return $this;
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function assignUser(User $user)
    {
        $this->user()->associate($user);
        $this->save();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function toggleCompleted()
    {
        $this->completed = !$this->completed;
        $this->save();
    }

    public function map()
    {
        return [
            'id' => $this->id,
            'name' => $this-> name,
            'description' => $this->description,
            'completed' => (boolean)$this->completed,
            'user_id' => (int)$this->user_id,
            'user_name' => optional($this->user)->name,
            'user_email' => optional($this->user)->email,
            'user_gravatar' => optional($this->user)->gravatar,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_at_formatted' => $this->created_at_formatted,
            'updated_at_formatted' => $this->updated_at_formatted,
            'created_at_human' => $this->created_at_human,
            'updated_at_human'=>$this->updated_at_human,
            'created_at_timestamp'=>$this->created_at_timestamp,
            'updated_at_timestamp'=>$this->updated_at_timestamp,
            'user' => $this->user,
            'full_search' => $this->full_search,
            'tags' => $this->tags,
//            'file' => $this->file

        ];
    }
    public function getFullSearchAttribute()
    {
        $state = $this->completed ? 'Completada' : 'Pendiente';
        $username = optional($this->user)->name;
        $useremail = optional($this->user)->email;
        return "$this->id $this->name $this->description $state $username $useremail";
    }

    public function subject()
    {
        return ellipsis('Cambios en la aplicación de Tasks (' . $this->id . '): ' . $this->name, 80);
    }
}
