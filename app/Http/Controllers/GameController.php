<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;

class GameController extends Controller
{
    public function index(Game $game)
    {
        return view('games/index')->with(['games' => $game->get()]);
    }
}
