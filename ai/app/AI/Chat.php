<?php

namespace App\AI;

use Illuminate\Support\Facades\Http;

class Chat
{
    protected array $mesages = [];

    public function systemMessage(string $message): static
    {
        $this->mesages[] = [
            'role' => 'system',
            'content' => $message
        ];

        return $this;
    }

    public function send(string $message): ?string
    {
        $this->mesages[] = [
            'role' => 'user',
            'content' => $message
        ];

        $response = Http::withToken(config('services.openai.secret'))
            ->post('https://api.openai.com/v1/chat/completions',
                [
                    "model" => "gpt-3.5-turbo",
                    "messages" => $this->mesages
                ])->json('choices.0.message.content');

            $this->mesages[] = [
                'role' => 'assistant',
                'content' => $message
            ];

        return $response;
    }

    public function reply(string $message): ?string
    {
        return $this->send($message);
    }

    public function messages(){
        return $this->messages();
    }
}
