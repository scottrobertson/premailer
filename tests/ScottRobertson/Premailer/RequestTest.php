<?php

namespace ScottRobertson\Premailer;

use ScottRobertson\Premailer\Request;
use Mockery;

class RequestTest extends TestCase
{

  public function testConstructor_NewClient()
  {
    $request = new Request; // Just making sure it does not fail when no Client is passed
  }

  public function testConvert_Html()
  {
    $url = 'http://example.com';

    $data = array(
      'adapter' => 'adapter',
      'base_url' => 'http://example-url.com/',
      'line_length' => 100,
      'link_query_string' => 'query_string',
      'preserve_styles' => false,
      'remove_ids' => false,
      'remove_classes' => false,
      'remove_comments' => false,
      'source' => '<h1>Hi</h1>'
    );

    $mockGuzzleRequest = Mockery::mock('\GuzzleHttp\Message\RequestInterface')
      ->shouldReceive('getBody')->once()->andReturn(Mockery::self())
      ->shouldReceive('setField')->once()->with('adapter', $data['adapter'])->andReturn(Mockery::self())
      ->shouldReceive('setField')->once()->with('base_url', $data['base_url'])->andReturn(Mockery::self())
      ->shouldReceive('setField')->once()->with('line_length', $data['line_length'])->andReturn(Mockery::self())
      ->shouldReceive('setField')->once()->with('link_query_string', $data['link_query_string'])->andReturn(Mockery::self())
      ->shouldReceive('setField')->once()->with('preserve_styles', $data['preserve_styles'])->andReturn(Mockery::self())
      ->shouldReceive('setField')->once()->with('remove_ids', $data['remove_ids'])->andReturn(Mockery::self())
      ->shouldReceive('setField')->once()->with('remove_classes', $data['remove_classes'])->andReturn(Mockery::self())
      ->shouldReceive('setField')->once()->with('remove_comments', $data['remove_comments'])->andReturn(Mockery::self())
      ->shouldReceive('setField')->once()->with('html', $data['source'])->andReturn(Mockery::self())
      ->mock();

    $mockGuzzle = Mockery::mock('\GuzzleHttp\Client')
      ->shouldReceive('createRequest')->with('POST', $url)->once()->andReturn($mockGuzzleRequest)
      ->shouldReceive('send')->once()->with($mockGuzzleRequest)->andReturn(Mockery::self())
      ->shouldReceive('json')->once()->andReturn([])
      ->mock();

    $request = new Request($mockGuzzle, $url);

    $response = $request->convert(
      $data['source'],
      $data['adapter'],
      $data['base_url'],
      $data['line_length'],
      $data['link_query_string'],
      $data['preserve_styles'],
      $data['remove_ids'],
      $data['remove_classes'],
      $data['remove_comments']
    );

    $this->assertInstanceOf('\ScottRobertson\Premailer\Response', $response);
  }

  public function testConvert_Url()
  {
    $url = 'http://example.com';

    $data = array(
      'adapter' => 'adapter',
      'base_url' => 'http://example-url.com/',
      'line_length' => 100,
      'link_query_string' => 'query_string',
      'preserve_styles' => false,
      'remove_ids' => false,
      'remove_classes' => false,
      'remove_comments' => false,
      'source' => 'http://example-url.com/email.html'
    );

    $mockGuzzleRequest = Mockery::mock('\GuzzleHttp\Message\RequestInterface')
      ->shouldReceive('getBody')->once()->andReturn(Mockery::self())
      ->shouldReceive('setField')->once()->with('adapter', $data['adapter'])->andReturn(Mockery::self())
      ->shouldReceive('setField')->once()->with('base_url', $data['base_url'])->andReturn(Mockery::self())
      ->shouldReceive('setField')->once()->with('line_length', $data['line_length'])->andReturn(Mockery::self())
      ->shouldReceive('setField')->once()->with('link_query_string', $data['link_query_string'])->andReturn(Mockery::self())
      ->shouldReceive('setField')->once()->with('preserve_styles', $data['preserve_styles'])->andReturn(Mockery::self())
      ->shouldReceive('setField')->once()->with('remove_ids', $data['remove_ids'])->andReturn(Mockery::self())
      ->shouldReceive('setField')->once()->with('remove_classes', $data['remove_classes'])->andReturn(Mockery::self())
      ->shouldReceive('setField')->once()->with('remove_comments', $data['remove_comments'])->andReturn(Mockery::self())
      ->shouldReceive('setField')->once()->with('url', $data['source'])->andReturn(Mockery::self())
      ->mock();

    $mockGuzzle = Mockery::mock('\GuzzleHttp\Client')
      ->shouldReceive('createRequest')->with('POST', $url)->once()->andReturn($mockGuzzleRequest)
      ->shouldReceive('send')->once()->with($mockGuzzleRequest)->andReturn(Mockery::self())
      ->shouldReceive('json')->once()->andReturn([])
      ->mock();

    $request = new Request($mockGuzzle, $url);

    $response = $request->convert(
      $data['source'],
      $data['adapter'],
      $data['base_url'],
      $data['line_length'],
      $data['link_query_string'],
      $data['preserve_styles'],
      $data['remove_ids'],
      $data['remove_classes'],
      $data['remove_comments']
    );

    $this->assertInstanceOf('\ScottRobertson\Premailer\Response', $response);
  }

  /**
   * @expectedException ScottRobertson\Premailer\Exception\Request
   * @expectedExceptionMessage Request Failed
   */
  public function testConvert_Fail()
  {
    $url = 'http://example.com';

    $data = array(
      'adapter' => 'adapter',
      'base_url' => 'http://example-url.com/',
      'line_length' => 100,
      'link_query_string' => 'query_string',
      'preserve_styles' => false,
      'remove_ids' => false,
      'remove_classes' => false,
      'remove_comments' => false,
      'source' => 'http://example-url.com/email.html'
    );

    $mockGuzzleRequest = Mockery::mock('\GuzzleHttp\Message\RequestInterface')
      ->shouldReceive('getBody')->once()->andReturn(Mockery::self())
      ->shouldReceive('setField')->once()->with('adapter', $data['adapter'])->andReturn(Mockery::self())
      ->shouldReceive('setField')->once()->with('base_url', $data['base_url'])->andReturn(Mockery::self())
      ->shouldReceive('setField')->once()->with('line_length', $data['line_length'])->andReturn(Mockery::self())
      ->shouldReceive('setField')->once()->with('link_query_string', $data['link_query_string'])->andReturn(Mockery::self())
      ->shouldReceive('setField')->once()->with('preserve_styles', $data['preserve_styles'])->andReturn(Mockery::self())
      ->shouldReceive('setField')->once()->with('remove_ids', $data['remove_ids'])->andReturn(Mockery::self())
      ->shouldReceive('setField')->once()->with('remove_classes', $data['remove_classes'])->andReturn(Mockery::self())
      ->shouldReceive('setField')->once()->with('remove_comments', $data['remove_comments'])->andReturn(Mockery::self())
      ->shouldReceive('setField')->once()->with('url', $data['source'])->andReturn(Mockery::self())
      ->mock();

    $mockGuzzle = Mockery::mock('\GuzzleHttp\Client')
      ->shouldReceive('createRequest')->with('POST', $url)->once()->andReturn($mockGuzzleRequest)
      ->shouldReceive('send')->once()->with($mockGuzzleRequest)->andThrow(new \Exception('Request Failed'))
      ->shouldReceive('json')->once()->andReturn([])
      ->mock();

    $request = new Request($mockGuzzle, $url);

    $response = $request->convert(
      $data['source'],
      $data['adapter'],
      $data['base_url'],
      $data['line_length'],
      $data['link_query_string'],
      $data['preserve_styles'],
      $data['remove_ids'],
      $data['remove_classes'],
      $data['remove_comments']
    );

    $this->assertInstanceOf('\ScottRobertson\Premailer\Response', $response);
  }
}
