<?php

declare(strict_types=1);

namespace Greenplugin\TelegramBot;

use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

class ApiClient implements ApiClientInterface
{
    private $client;
    private $botKey;
    private $endPoint;
    private $streamFactory;
    private $requestFactory;

    /**
     * ApiApiClient constructor.
     *
     * @param RequestFactoryInterface $requestFactory
     * @param StreamFactoryInterface  $streamFactory
     * @param ClientInterface         $client
     */
    public function __construct(
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface $streamFactory,
        ClientInterface $client
    ) {
        $this->streamFactory = $streamFactory;
        $this->requestFactory = $requestFactory;
        $this->client = $client;
    }

    /**
     * @param string $method
     * @param array  $data
     * @param array  $files
     *
     * @throws \Psr\Http\Client\ClientException
     *
     * @return mixed
     */
    public function send(string $method, array $data, array $files = [])
    {
        $request = $this->requestFactory->createRequest('POST', $this->generateUri($method));

        $boundary = \uniqid('', true);

        $stream = $this->streamFactory->createStream($this->createStreamBody($boundary, $data, $files));

        $response = $this->client->sendRequest($request
            ->withHeader('Content-Type', 'multipart/form-data; boundary="' . $boundary . '"')
            ->withBody($stream));

        $content = $response->getBody()->getContents();

        return \json_decode($content);
    }

    public function setBotKey(string $botKey)
    {
        $this->botKey = $botKey;
    }

    public function setEndpoint(string $endPoint)
    {
        $this->endPoint = $endPoint;
    }

    /**
     * @param string $method
     *
     * @return string
     */
    protected function generateUri(string $method): string
    {
        return $this->endPoint . '/bot' . $this->botKey . '/' . $method;
    }

    /**
     * @param $data
     * @param $files
     * @param mixed $boundary
     *
     * @return string
     */
    protected function createStreamBody($boundary, $data, $files): string
    {
        $stream = '';
        foreach ($data as $name => $value) {
            $stream .= $this->createDataStream($boundary, $name, $value);
        }

        foreach ($files as $name => $file) {
            $stream .= $this->createFileStream($boundary, $name, $file);
        }

        $stream .= "--$boundary--\r\n";

        return $stream;
    }

    /**
     * @param $boundary
     * @param $name
     * @param \SplFileInfo $file
     *
     * @return string
     */
    protected function createFileStream($boundary, $name, \SplFileInfo $file): string
    {
        $headers = '';
        $headers .= \sprintf(
            "Content-Disposition: form-data; name=\"%s\"; filename=\"%s\"\r\n",
            $name,
            $file->getBasename()
        );
        $headers .= \sprintf("Content-Length: %s\r\n", (string) $file->getSize());
        $headers .= \sprintf("Content-Type: %s\r\n", \mime_content_type($file->getRealPath()));

        $streams = '';
        $streams .= "--$boundary\r\n$headers\r\n";
        $streams .= \file_get_contents($file->getRealPath());
        $streams .= "\r\n";

        return $streams;
    }

    /**
     * @param $boundary
     * @param $name
     * @param $value
     *
     * @return string
     */
    protected function createDataStream($boundary, $name, $value): string
    {
        $headers = '';
        $headers .= \sprintf("Content-Disposition: form-data; name=\"%s\"\r\n", $name);
        $headers .= \sprintf("Content-Length: %s\r\n", (string) \strlen((string) $value));

        $streams = '';
        $streams .= "--$boundary\r\n$headers\r\n";
        $streams .= $value;
        $streams .= "\r\n";

        return $streams;
    }
}
