<?php

namespace TrackMe\Tests\Controller;

use PHPUnit\Framework\TestCase;
use TrackMe\Controller\RecordController;
use TrackMe\Model\Record;
use TrackMe\Repository\RecordRepositoryInterface;

class RecordControllerTest extends TestCase
{
    /**
     * @var RecordController
     */
    private $controller;

    protected function setUp()
    {
        $recordRepositoryMock = $this->getMockBuilder(RecordRepositoryInterface::class)->getMock();
        $recordRepositoryMock->method('persist')->willReturn(new Record('1h', 'test'));
        $recordRepositoryMock->method('findAll')->willReturn([
            [
                'timeSpent'     => '1h',
                'description'   => 'test',
                'createdAt'     => '2018-11-01 20:10:10'
            ]
        ]);

        /** @var RecordRepositoryInterface $recordRepositoryMock */
        $this->controller = new RecordController($recordRepositoryMock);
    }

    /**
     * @runInSeparateProcess
     */
    public function testCreateAction()
    {
        $response = $this->controller->createAction('1h', 'test');
        self::assertJson($response);

        $content = $response->getContent();
        self::assertArrayHasKey('timeSpent', $content);
        self::assertArrayHasKey('description', $content);
        self::assertArrayHasKey('createdAt', $content);

        self::assertEquals('1h', $content['timeSpent']);
        self::assertEquals('test', $content['description']);
    }

    /**
     * @runInSeparateProcess
     */
    public function testGetAction()
    {
        $response = $this->controller->getAction();
        self::assertJson($response);

        $content = $response->getContent();
        $expected = [
            '2018-11-01' => [
                [
                    'timeSpent'     => '1h',
                    'description'   => 'test',
                    'createdAt'     => '2018-11-01 20:10:10',
                    'title'         => '2018-11-01'
                ]
            ]
        ];

        self::assertEquals($expected, $content);
    }
}
