<?php

class Response
{
    public function init(string $uri, string $version): array
    {
        if ($uri === '/' and !empty($version)) {
            return [
                'status' => 200,
                'body' => [
                    'status' => 'ok',
                    'versao' => $version
                ]
            ];
        }
        return [];
    }
}
