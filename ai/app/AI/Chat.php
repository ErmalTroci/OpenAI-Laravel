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

    public function send(string $message, bool $speech = false): ?string
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

        return $speech ? $this->speech($response) : $response;
    }

    public function speech(string $message): string
    {
        return OpenAI::audio()->speech([
            'model' => 'tts-1',
            'input' => $message,
            'voice' => 'nova'
        ]);
    }

    public function reply(string $message): ?string
    {
        return $this->send($message);
    }

    public function messages(){
        return $this->messages();
    }
}
