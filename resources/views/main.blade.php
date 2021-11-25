<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>C O M M E N T : : B O A R D</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="/css/main.css" rel="stylesheet">
        
        <!-- JS -->
        <script src="/js/main.js"></script>
    </head>
    <body>
        <div class="comments-block">
            <form class="filter" name="comments-filter">
                <div class="circle"></div>
                <input name="by-name" type="text" placeholder="filter by name">
                <div class="circle"></div>
            </form>
            <div class="comments">
                @foreach ($users as $user)
                    @foreach ($user->comments as $comment)
                        <div class="comment" data-id="{{ $comment->id }}">
                            <span class="author">{{ $user->name }} : :&nbsp;</span>
                            <span class="content">{{ $comment->content }}</span>    
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </body>
</html>
