<?php

namespace App\AI;

use OpenAI\Laravel\Facades\OpenAI;

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

        $response = OpenAI::chat()->create([
                    "model" => "gpt-3.5-turbo",
                    "messages" => $this->mesages
                ])->choices[0]->message->content;

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
