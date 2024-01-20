<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\Talk;
use App\Models\Room;
use App\Models\Message;
use App\Models\User;
use App\Events\MessageSent;

class TalkController extends Controller
{
    public function openTalk(User $user)
        {
            $myUserId = auth()->user()->id;
            $otherUserId = $user->id;
            
            $talk = Room::where(function($query) use ($myUseId, $otherUserId) {
                $query->where('owner_id', $myUserId)
                    ->where('guest_id',$otherUserId);
            })->orWhere(function($query) use ($myUserId, $otherUserId) {
                $query->where('owner_id', $otherUserId)
                    ->where('guest_id', $myUserId);
            })->first();
            
            if (!$talk) {
                $talk = new Room();
                $talk->owner_id = $myUserId;
                $talk->guest_id = $otherUserId;
                $talk->save();
            }
            
            $messages = Message::where('talk_id', $talk->id)->orderBy('updated_at', 'DESC')->get();;
            
            return view('talks/talk')->with(['talk' => $talk, 'messages' => $messages]);
        }
}
