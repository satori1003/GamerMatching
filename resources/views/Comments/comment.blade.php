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
            @foreach ($messages->comments as $comment)
            <div class="mb-2">
                <span>
                    <strong>
                        <a class="no-text-decoration black-color" href="{{ route('users.show', ['name' => $comments->user->name]) }}">{{ $comments->user->name }}</a>
                    </strong>
                </span>
                <span>{{ $comments->comment }}</span>
                @if ($comments->user->id == Auth::id())
                    <a class="delete-comment" data-remote="true" rel="nofollow" data-method="delete" href="/comments/{{ $comments->id }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </a>
                @endif
            </div>
            @endforeach
        </body>
    </x-app-layout>
</html>
