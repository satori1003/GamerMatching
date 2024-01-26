<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>comment</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    </head>
    <x-app-layout>
        <x-slot name="header">
            comment
        </x-slot>
        <body class="antialiased">
            <div>
              <p>{{ $message->user->name}}</p>
              <p>{{ $message->body}}</p>
              <p>{{ $message->created_at}}</p>
            </div>
            <div class="row actions">
                <form class="w-100" id="new_comment" action="/comments/{{ $message->id }}/comments" accept-charset="UTF-8" data-remote="true" method="post"><input name="utf8" type="hidden" value="&#x2713;" />
                   @csrf
                    <input value="{{ $message->id }}" type="hidden" name="message_id" />
                    <input class="form-control comment-input border-0" placeholder="コメント ..." autocomplete="off" type="text" name="comment" />
                </form>
            </div>
            @foreach ($message->comments as $comment)
            <div class="mb-2">
                <p>{{ $comment->user->name }}</p>
                <p>{{ $comment->comment }}</p>
                <p>{{ $comment->created_at}}</p>
            </div>
            @endforeach
            
        </body>
    </x-app-layout>
</html>
