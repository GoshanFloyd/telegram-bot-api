<?php

declare(strict_types=1);

namespace Greenplugin\TelegramBot;

interface ApiClientInterface
{
    public function setBotKey(string $botKey);

    public function setEndpoint(string $endPoint);

    public function send(string $method, array $data, array $files = []);
}
