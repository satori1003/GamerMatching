<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Talk</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    </head>
    
    <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Chat
        </h2>
    </x-slot>
    <body class="antialiased">
        <h1 class='title'>
            {{ $game->gametitle }} トークルーム
        </h1>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="post" return false;">
                        メッセージ : <input type="text" id="input_message" autocomplete="off" />
                        <input type="hidden" id="talk_id" name="talk_id" value="{{ $talk->id }}"> 
                        <button type="submit" class="text-white bg-blue-700 px-5 py-2">送信</button>
                    </form>
                
                    <ul class="list-disc" id="list_message">
                        @foreach ($messages as $message)
                            <li>
                                <strong>{{ $message->user->name }}:</strong>
                                <div>{{ $message->body }}</div>
                            </li>
                         @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
        <div class='footer'>
            <a href="/home">戻る</a>
        </div>
    </body>
    </x-app-layout>
</html>
