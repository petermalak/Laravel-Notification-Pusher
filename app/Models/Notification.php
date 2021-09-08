<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table = "notification";
    protected $fillable=['user_id','comment_id','owner_id','created_at','updated_at'];
    protected $hidden =['created_at','updated_at'];
    public $timestamps = true;


     //Notification Causer (How wrote a comment to send a notification)
     public function user(){
        return $this ->  belongsTo('App\Models\User','user_id','id');
    }

     //Notification Reciver (How recive the notification)
    public function owner(){
        return $this ->  belongsTo('App\Models\User','owner_id','id');
    }

    //Commert
    public function comment(){
        return $this ->  belongsTo('App\Models\Comment','comment_id','id');
    }

}
