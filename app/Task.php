<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
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
        $this->tags()->saveMany($tags);
    }

    public function addTag($tag)
    {
        $this->tags()->save($tag);
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
            'completed' => $this->completed,
            'user_id' => $this->user_id,
            'user_name' => optional($this->user)->name,
//            'tags' => $this->tags,
//            'file' => $this->file

        ];
    }

}
