<?php

declare(strict_types=1);

namespace TrackMe\Tests\Application\Controller;

use PHPUnit\Framework\TestCase;
use TrackMe\Application\Controller\RecordController;
use TrackMe\Domain\Model\Record\Record;
use TrackMe\Domain\Model\Record\RecordRepository;

class RecordControllerTest extends TestCase
{
    private RecordController $controller;

    protected function setUp()
    {
        /* @var RecordRepository $recordRepositoryMock */
        $recordRepositoryMock = $this->getMockBuilder(RecordRepository::class)->getMock();
        $recordRepositoryMock->method('add')->willReturn(new Record('1h', 'test'));
        $recordRepositoryMock->method('all')->willReturn([
            [
                'timeSpent' => '1h',
                'description' => 'test',
                'createdAt' => '2018-11-01 20:10:10',
            ],
        ]);

        $this->controller = new RecordController($recordRepositoryMock);
    }

    /**
     * @runInSeparateProcess
     */
    public function testCreateAction(): void
    {
        $response = $this->controller->createAction('1h', 'test');
        self::assertJson((string) $response);

        $content = $response->content();
        self::assertArrayHasKey('timeSpent', $content);
        self::assertArrayHasKey('description', $content);
        self::assertArrayHasKey('createdAt', $content);

        self::assertEquals('1h', $content['timeSpent']);
        self::assertEquals('test', $content['description']);
    }

    /**
     * @runInSeparateProcess
     */
    public function testGetAction(): void
    {
        $response = $this->controller->getAction();
        self::assertJson((string) $response);

        $content = $response->content();
        $expected = [
            [
                'timeSpent' => '1h',
                'description' => 'test',
                'createdAt' => '2018-11-01 20:10:10',
            ],
        ];

        self::assertEquals($expected, $content);
    }
}
