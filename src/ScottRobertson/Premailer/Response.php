<?php

namespace ScottRobertson\Premailer;

use GuzzleHttp\Exception\RequestException;

class Response
{
  /**
   * Holds the response data from \ScottRobertson\Premailer\Request
   * @var array
   */
  private $data = array();

  /**
   * Holds the Guzzle client
   * @var \GuzzleHttp\Client
   */
  private $client;

  /**
   * @param array            $data
   * @param GuzzleHttpClient $client
   */
  public function __construct(array $data, \GuzzleHttp\Client $client)
  {
    $this->data = $data;
    $this->client = $client;
  }

  /**
   * Download the HTML version of this email
   * @return string
   */
  public function downloadHtml()
  {
    return $this->download('html');
  }

  /**
   * Download the Text version of this email
   * @return string
   */
  public function downloadText()
  {
    return $this->download('txt');
  }

  /**
   * Download the Html/Text version of this email
   * @param  string $type
   * @return string
   */
  private function download($type)
  {
    try {
      $response = $this->client->get($this->data['documents'][$type]);
    } catch (\Exception $e) {
      throw new \ScottRobertson\Premailer\Exception\Request($e->getMessage());
    }

    return (string) $response->getBody();
  }
}
