<?php

namespace App\Http\Controllers;
use App\Events\NewNotification;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Notification;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::with(['comments' => function($q){
            $q -> select('id','post_id','content');
        }])->get();


//        $notifications = Notification::with(['user','comment'])->where('owner_id','=',Auth::id())->get();
        view()->composer(
            'layouts.app',
            function ($view) {
                $view->with('notifications', Notification::with(['user','comment'])->where('owner_id','=',Auth::id())->get());
            }
        );
        return view('home', compact('posts'));
    }

    public function  saveComment(Request $request){


        $auth_id = Auth::id();
        $comment = Comment::create([
            'post_id' => $request -> post_id ,
            'user_id' => $auth_id,
            'content' => $request -> content,
        ]);


        $owner_id = Post::find($request->post_id)->user_id;
        Notification::create([
            'user_id' => $auth_id,
            'comment_id' => $comment->id ,
            'owner_id' => $owner_id,
        ]);


          $data =[
                'user_id' => $auth_id,
                'user_name'  => Auth::user() -> name,
                'content' => $request -> content,
                'post_id' =>$request -> post_id ,
          ];

           ///   save  notify in database table

         event(new NewNotification($data));

        return redirect() -> back() -> with(['success'=> 'Comment added successfully']);
    }
}
