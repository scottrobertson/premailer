<?php

namespace ScottRobertson\Premailer;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Request
{
  /**
   * Holds the Guzzle Client
   * @var GuzzleHttp\Client
   */
  private $client;

  /**
   * Holds the Premailer API url
   * @var string
   */
  private $url = ;

  /**
   * @param string $url API url for premailer
   */
  public function __construct(\GuzzleHttp\Client $client = null, $url = 'http://premailer.dialect.ca/api/0.1/documents')
  {
    if (! $client) {
      $client = new Client();
    }

    $this->client = $client;
    $this->url = $url;
  }

  /**
   * Convert an email using Premailer
   * @param  string  $source            Can either be a url, or raw html
   * @param  string  $adapter           Which document handler to use
   * @param  string  $base_url          Base URL for converting relative links
   * @param  integer $line_length       Length of lines in the plain text version
   * @param  string  $link_query_string Query string appended to links
   * @param  boolean $preserve_styles   Whether to preserve any link rel=stylesheet and style elements
   * @param  boolean $remove_ids        Remove IDs from the HTML document?
   * @param  boolean $remove_classes    Remove classes from the HTML document?
   * @param  boolean $remove_comments   Remove comments from the HTML document?
   * @return \ScottRobertson\Premailer\Response
   */
  public function convert(
    $source,
    $adapter = 'hpricot',
    $base_url = null,
    $line_length = 65,
    $link_query_string = null,
    $preserve_styles = true,
    $remove_ids = true,
    $remove_classes = true,
    $remove_comments = true
    )
  {

    $params = array(
      'adapter' => $adapter,
      'base_url' => $base_url,
      'line_length' => $line_length,
      'link_query_string' => $link_query_string,
      'preserve_styles' => $preserve_styles,
      'remove_ids' => $remove_ids,
      'remove_classes' => $remove_classes,
      'remove_comments' => $remove_comments,
    );

    if (filter_var($source, FILTER_VALIDATE_URL)) {
      $params['url'] = $source;
    } else {
      $params['html'] = $source;
    }

    return $this->request($params);

  }

  /**
   * Make the request to Premailer
   * @param  array  $params
   * @return \ScottRobertson\Premailer\Response
   */
  private function request(array $params = array())
  {
    $request = $this->client->createRequest('POST', $this->url);

    $body = $request->getBody();
    foreach ($params as $key => $value) {
      $body->setField($key, $value);
    }

    try {
      $response = $this->client->send($request);
    } catch (\Exception $e) {
      throw new \ScottRobertson\Premailer\Exception\Request($e->getMessage());
    }

    return new Response(
      $response->json(),
      $this->client
    );
  }
}
