<?php

use Illuminate\Support\Facades\Route;
use App\AI\Chat;

Route::get('/sillier', function () {
    $chat = new Chat();
    $poem = $chat->systemMessage('You are a poetic assistant, skilled in explaining complex programming concepts with creative flair.')
        ->send('Compose a poem that explains the concept of recursion in programming.');

    $chat->reply('Cool, can you make much, much sillier.');

    return view('welcome', ['poem' => $poem]);
});


Route::get('/', function (){
    return view('roast');
});

Route::post('/roast', function (){
    $attributes = request()->validate([
        'topic' => [
            'required', 'string', 'min:2', 'max:50'
        ]
    ]);

    $prompt = "Please roast {$attributes['topic']} in a sarcastic tone.";

    $chat = new Chat();
    $mp3 = $chat->send(
        message: $prompt,
        speech: true
    );

    $file = "/roasts/".md5($mp3). ".mp3";
    file_put_contents(public_path($file), $mp3);

    return redirect('/')->with([
        'file' => $file,
        'flash' => 'Boom. Roasted.'
    ]);
});

