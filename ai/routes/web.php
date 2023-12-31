<?php

use Illuminate\Support\Facades\Route;
use App\AI\Assistant;

Route::get('/sillier', function () {
    $chat = new Assistant();
    $poem = $chat->systemMessage('You are a poetic assistant, skilled in explaining complex programming concepts with creative flair.')
        ->send('Compose a poem that explains the concept of recursion in programming.');

    $chat->reply('Cool, can you make much, much sillier.');

    return view('welcome', ['poem' => $poem]);
});


Route::get('/roast', function (){
    return view('roast');
});

Route::get('/', function (){
    return view('image', [
        'messages' => session('messages', [])
    ]);
});

Route::post('/image', function (){
    $attributes = request()->validate([
        'description' => ['required', 'string', 'min:3']
    ]);

    $assistant = new Assistant(session('messages', []));

    $assistant->visualize($attributes['description']);
    session(['messages' => $assistant->messages()]);
    return redirect('/');
});

Route::post('/roast', function (){
    $attributes = request()->validate([
        'topic' => [
            'required', 'string', 'min:2', 'max:50'
        ]
    ]);

    $prompt = "Please roast {$attributes['topic']} in a sarcastic tone.";

    $chat = new Assistant();
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

