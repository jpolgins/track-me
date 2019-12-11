<?php

declare(strict_types=1);

namespace TrackMe\Tests\Controller;

use PHPUnit\Framework\TestCase;
use TrackMe\Controller\RecordController;
use TrackMe\Model\Record;
use TrackMe\Repository\RecordRepositoryInterface;

class RecordControllerTest extends TestCase
{
    private RecordController $controller;

    protected function setUp()
    {
        /* @var RecordRepositoryInterface $recordRepositoryMock */
        $recordRepositoryMock = $this->getMockBuilder(RecordRepositoryInterface::class)->getMock();
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
            '2018-11-01' => [
                [
                    'timeSpent' => '1h',
                    'description' => 'test',
                    'createdAt' => '2018-11-01 20:10:10',
                    'title' => '2018-11-01',
                ],
            ],
        ];

        self::assertEquals($expected, $content);
    }
}
