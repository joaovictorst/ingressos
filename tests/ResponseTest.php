<?php declare(strict_types=1);

require_once __DIR__ . '/../src/Response.php';

class ResponseTest extends \PHPUnit\Framework\TestCase
{
    public function testInitNaRaizRetorna200()
    {
        $response = new Response();
        $result = $response->init('/', '1.0.0');

        $this->assertEquals(200, $result['status']);
        $this->assertEquals(['status' => 'ok', 'versao' => '1.0.0'], $result['body']);
    }

    public function testRotaInexistenteRetorna404()
    {
        $response = new Response();
        $result = $response->init('/rota-teste', '1.0.0');

        $this->assertEquals(404, $result['status']);
        $this->assertEquals(['status' => 'error', 'message' => 'Rota nao encontrada'], $result['body']);
    }

    public function testRotaSaudeRetorna200()
    {
        $response = new Response();
        $result = $response->init('/saude', '1.0.0');

        $this->assertEquals(200, $result['status']);
        $this->assertEquals(['status' => 'ok', 'versao' => '1.0.0'], $result['body']);
    }
}