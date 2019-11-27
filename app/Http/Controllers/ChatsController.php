<?php

namespace App\Http\Controllers;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;


class ChatsController extends Controller
{
    public function __construct()
    {
    $this->middleware('auth');
    }

    /**
     * Show chats
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth = Auth::user();
        $receiver_friend = Message::select('receiver_id')->distinct()->where('user_id',$auth->id)->get()->pluck('receiver_id')->toArray();
        $sender_friend = Message::select('user_id')->distinct()->where('receiver_id',$auth->id)->get()->pluck('user_id')->toArray();
        $friend_ids = array_unique (array_merge($receiver_friend, $sender_friend));
        $friends = User::whereIn('id',$friend_ids)->get();
        return view('chat', ['friends'=>$friends]);
    }

    public function friend(User $friend)
    {
        $auth = Auth::user();
        $receiver_friend = Message::select('receiver_id')->distinct()->where('user_id',$auth->id)->get()->pluck('receiver_id')->toArray();
        $sender_friend = Message::select('user_id')->distinct()->where('receiver_id',$auth->id)->get()->pluck('user_id')->toArray();
        $friend_ids = array_unique (array_merge($receiver_friend, $sender_friend));
        $friends = User::whereIn('id',$friend_ids)->get();
        return view('chat', ['friends'=>$friends, 'active_friend'=>$friend]);
    }

    public function users()
    {
        $auth = Auth::user();
        $ids = [];
        $friends_id = Message::select('receiver_id','user_id')->distinct()->where('user_id',$auth->id)->orWhere('receiver_id', $auth->id)->get();
        foreach($friends_id as $id){
            if($id['user_id']!=$auth->id) array_push($ids,$id['user_id']);
            elseif($id['receiver_id'!=$auth->id]) array_push($ids,$id['receiver_id']);
        }
        return response()->json($ids);
    }

    /**
     * Fetch all messages
     *
     * @return Message
     */
    public function fetchMessages(User $friend)
    {
        $auth = Auth::user();
        $ids = [$auth->id,$friend->id];
        $messages = Message::whereIn('user_id',$ids)->whereIn('receiver_id',$ids)->with('user')->get();
        return $messages;
    }

    /**
     * Persist message to database
     *
     * @param  Request $request
     * @return Response
     */
    public function sendMessage(Request $request)
    {
    $user = Auth::user();
    $receiver_id = $request->input('receiver_id');

    $message = $user->messages()->create([
        'message' => $request->input('message'),
        'receiver_id' => $receiver_id,
    ]);

    broadcast(new MessageSent($user, $message, $receiver_id))->toOthers();

    return ['status' => 'Message Sent!'];
    }
}
