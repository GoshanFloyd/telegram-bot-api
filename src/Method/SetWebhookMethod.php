<?php

declare(strict_types=1);

namespace Greenplugin\TelegramBot\Method;

use Greenplugin\TelegramBot\Method\Interfaces\HasUpdateTypeVariableInterface;
use Greenplugin\TelegramBot\Method\Traits\FillFromArrayTrait;
use Greenplugin\TelegramBot\Type\InputFileType;

/**
 * Class SetWebhookMethod.
 *
 * @see https://core.telegram.org/bots/api#setwebhook
 * @see https://core.telegram.org/bots/webhooks
 */
class SetWebhookMethod implements HasUpdateTypeVariableInterface
{
    use FillFromArrayTrait;

    /**
     * HTTPS url to send updates to. Use an empty string to remove webhook integration.
     *
     * @var string
     */
    public $url;

    /**
     * Optional. Upload your public key certificate so that the root certificate in use can be checked.
     *
     * @see https://core.telegram.org/bots/self-signed
     *
     * @var InputFileType|null
     */
    public $certificate;

    /**
     * Optional    Maximum allowed number of simultaneous HTTPS connections to the webhook for update delivery, 1-100.
     * Defaults to 40. Use lower values to limit the load on your bot‘s server,
     * and higher values to increase your bot’s throughput.
     *
     * @var int|null
     */
    public $maxConnections;

    /**
     * Optional    List the types of updates you want your bot to receive.
     * For example, specify [“message”, “edited_channel_post”, “callback_query”] to only receive updates of these types.
     * See Update for a complete list of available update types.
     * Specify an empty list to receive all updates regardless of type (default).
     * If not specified, the previous setting will be used.
     *
     * Please note that this parameter doesn't affect updates created before the call to the setWebhook,
     * so unwanted updates may be received for a short period of time.
     *
     * @var string[]|null
     */
    public $allowedUpdates;

    /**
     * SetWebhookMethod constructor.
     *
     * @param string     $url
     * @param array|null $data
     *
     * @throws \Greenplugin\TelegramBot\Exception\BadArgumentException
     */
    public function __construct(string $url, array $data = null)
    {
        $this->$url;
        if ($data) {
            $this->fill($data);
        }
    }
}
