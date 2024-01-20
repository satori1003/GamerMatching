<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Message;
use App\Library\Chat;
use App\Events\MessageSent;

class GameController extends Controller
{
    public function index(Game $game)
    {
        return view('games/index')->with(['games' => $game->get()]);
    }
    
    public function show(Game $game)
    {
        $messages = Message::where('game_id',$game->id)->orderBy('updated_at', 'DESC')->get();
        return view('games/show')->with(['game' => $game,'messages' => $messages]);
    }
    
    public function sendMessage(Message $message, Request $request,)
    {
        // auth()->user() : 現在認証しているユーザーを取得
        $user = auth()->user();
        $strUserId = $user->id;
        $strUsername = $user->name;

        // リクエストからデータの取り出し
        $strMessage = $request->input('message');

        // メッセージオブジェクトの作成
        $chat = new Chat;
        $chat->body = $strMessage;
        $chat->game_id = $request->input('game_id');

        $chat->userName = $strUsername;
        MessageSent::dispatch($chat);    

        //データベースへの保存処理
        $message->user_id = $strUserId;
        $message->body = $strMessage;
        $message->game_id = $request->input('game_id');
        $message->save();

        return response()->json(['message' => 'Message sent successfully']);
    }
}
