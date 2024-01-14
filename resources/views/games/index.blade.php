<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Top</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    </head>
    <x-app-layout>
        <x-slot name="header">
            Home
        </x-slot>
        <body class="antialiased">
            <h1>GamerMatching</h1>
            <p>やりたいゲームを選択して一緒にプレイする人を探そう！</p>
            <div class='selects'>
                @foreach($games as $game)
                    <div class='select'>
                    <a href="/chat/{{ $post->user->id }}"> <h2 class='title'>{{ $game->gametitle }} フリートーク</h2></a>
                        <p class='detail'>{{ $game->gametitle }}に関する話題なら何でもOK！</p>
                    </div>
                @endforeach
            </div>
        </body>
    </x-app-layout>
</html>
