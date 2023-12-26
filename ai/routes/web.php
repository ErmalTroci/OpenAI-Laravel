<?php

use Illuminate\Support\Facades\Route;
use App\AI\Chat;

Route::get('/', function () {
        $chat = new Chat();
        $poem = $chat->systemMessage('You are a poetic assistant, skilled in explaining complex programming concepts with creative flair.')
            ->send('Compose a poem that explains the concept of recursion in programming.');

        $chat->reply('Cool, can you make much, much sillier.');

        return view('welcome', ['poem' => $poem]);
    });
