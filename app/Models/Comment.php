<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = "comment";
    protected $fillable=['post_id','user_id','content','created_at','updated_at'];
    protected $hidden =['created_at','updated_at'];
    public $timestamps = true;



     //owner
    public function user(){
        return $this ->  belongsTo('App\Models\User','user_id','id');
    }

    //notification
    public function notification(){
        return $this ->  belongsTo('App\Models\Notification','comment_id','id');
    }


}
