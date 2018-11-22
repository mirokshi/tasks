<?php

namespace App;

use App\Traits\FormattedDates;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use FormattedDates;

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
            'completed' => (boolean)$this->completed,
            'user_id' => $this->user_id,
            'user_name' => optional($this->user)->name,
            'user_email' => optional($this->user)->email,
            'user' => $this->user,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_at_formatted' => $this->created_at_formatted,
            'updated_at_formatted' => $this->updated_at_formatted,
            'created_at_human' => $this->created_at_human,
            'updated_at_human'=>$this->updated_at_human,
            'created_at_timestamp'=>$this->created_at_timestamp,
            'updated_at_timestamp'=>$this->updated_at_timestamp,
//            'tags' => $this->tags,
//            'file' => $this->file

        ];
    }

}
