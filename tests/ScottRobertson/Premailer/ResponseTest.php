<?php

namespace ScottRobertson\Premailer;

use ScottRobertson\Premailer\Response;
use Mockery;

class ResponseTest extends TestCase
{
  public function testDownloadHtml()
  {
    $expectedResponse = 'response';
    $data = [
      'documents' => [
        'html' => 'http://example.com'
      ]
    ];

    $mockGuzzle = Mockery::mock('\GuzzleHttp\Client')
      ->shouldReceive('get')
      ->once()
      ->with($data['documents']['html'])
      ->andReturn(Mockery::self())
      ->shouldReceive('getBody')
      ->once()
      ->andReturn($expectedResponse)
      ->mock();

    $response = new Response($data, $mockGuzzle);
    $this->assertEquals(
      $expectedResponse,
      $response->downloadHtml()
    );
  }

  public function testDownloadText()
  {
    $expectedResponse = 'response';
    $data = [
      'documents' => [
        'text' => 'http://example.com'
      ]
    ];

    $mockGuzzle = Mockery::mock('\GuzzleHttp\Client')
      ->shouldReceive('get')
      ->once()
      ->with($data['documents']['text'])
      ->andReturn(Mockery::self())
      ->shouldReceive('getBody')
      ->once()
      ->andReturn($expectedResponse)
      ->mock();

    $response = new Response($data, $mockGuzzle);
    $this->assertEquals(
      $expectedResponse,
      $response->downloadText()
    );
  }

  /**
   * @expectedExceptionMessage Get failed
   * @expectedException ScottRobertson\Premailer\Exception\Request
   */
  public function testDownload_Fail()
  {
    $expectedResponse = 'response';
    $data = [
      'documents' => [
        'text' => 'http://example.com'
      ]
    ];

    $mockGuzzle = Mockery::mock('\GuzzleHttp\Client')
      ->shouldReceive('get')
      ->once()
      ->with($data['documents']['text'])
      ->andThrow(new \Exception('Get failed'))
      ->mock();

    $response = new Response($data, $mockGuzzle);
    $this->assertEquals(
      $expectedResponse,
      $response->downloadText()
    );
  }
}
