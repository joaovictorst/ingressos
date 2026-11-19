<?php

class Response
{
    private array $rotas = ['/', '/saude'];
    public function init(string $uri, string $version): array
    {
        if(in_array($uri, $this->rotas)) {
            return [
                'status' => 200,
                'body' => [
                    'status' => 'ok',
                    'versao' => $version
                ]
            ];
        }
        return [
            'status' => 404,
            'body' => [
                'status' => 'error',
                'message' => 'Rota nao encontrada'
            ]
        ];
    }
}
