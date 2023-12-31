<!DOCTYPE html>
<html lang="en" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>OpenAI</title>
        <script src="https://cdn.tailwindcss.com"></script>

    </head>
    <body class="h-full grid place-items-center p-5">
        @if(session('file'))
            <div>
                <iframe src="https://giphy.com/embed/7hZlPx3Nu506WJ1gWc" width="480" height="480" frameBorder="0" class="giphy-embed" allowFullScreen></iframe>
                <a href="{{asset(session('file'))}}" download class="block w-full text-center rounded p-2 bg-gray-200 hover:bg-blue-500 hover:text-white mt-3">Downoad Audio</a>
            </div>
        @else
            <form action="/roast" method="POST" class="w-full lg:max-w-md lg:mx-auto">
                @csrf
                <div class="flex gap-2">
                    <input type="text" name="topic" placeholder="What do you want to roast?" required class="border p-2 rounded flex-1">
                    <button type="submit" class="rounded p-2 bg-gray-200 hover:bg-blue-500 hover:text-white">Roast</button>
                </div>
            </form>
        @endif
    </body>
</html>
