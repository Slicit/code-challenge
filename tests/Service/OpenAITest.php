<?php

namespace App\Tests\Service;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Service\OpenAIService;

class OpenAITest extends KernelTestCase
{
    public function testOpenAI()
    {
        self::bootKernel();

        $service = self::getContainer()->get(OpenAIService::class);

        $response = $service->uploadFile(__DIR__ . '/data/01_dpe.pdf');

        self::assertEquals('processed', $response['status']);
        self::assertNotEmpty($response['id']);
    }
}
