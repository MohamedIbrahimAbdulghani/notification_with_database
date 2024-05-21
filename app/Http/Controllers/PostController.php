<?php

namespace App\Http\Controllers;

use App\Models\post;
use App\Models\User;
use App\Notifications\CreatePost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create_post');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = post::create([
            "title"=>$request->title,
            "body"=>$request->body
        ]);
        $user = User::where("id", "!=", auth()->user()->id)->get(); // this line to choose all users without current user
        $create_user = auth()->user()->name; // this is line to get user name
        Notification::send($user, new CreatePost($post->id, $create_user, $post->title)); // this is line to send notification from table (post) to another table (notifications)
        return redirect()->route("dashboard");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = post::findOrFail($id);
        $getID = DB::table("notifications")->where("data->post_id", $id)->pluck("id"); //  data["post_id"] الخاص بالبوست نفسه عن طريق ال  id من خلال ال  notifications الخاص بجدول ال id انت هنا عايز تجيب ال
        DB::table("notifications")->where("id", $getID)->update(["read_at"=>now()]); // now() وخليها بالوقت الحالي وده طبعا عن طريق داله اسمها  read_at اللي مبعوت غيرلي ال  id لو يساوي ال  notifications الخاص بال id انت هنا بتقوله لو ال
        return redirect()->route("dashboard");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(post $post)
    {
        //
    }
    public function markAsRead() {
        $user = User::find(auth()->user()->id);
        foreach($user->unreadNotifications as $notification):
            $notification->markAsRead();
        endforeach;
        return redirect()->route("dashboard");
    }
}
