<?php

declare(strict_types=1);

namespace Greenplugin\TelegramBot\Method;

use Greenplugin\TelegramBot\Method\Traits\ChatIdVariableTrait;

/**
 * Class DeleteChatStickerSetMethod.
 *
 * @see https://core.telegram.org/bots/api#deletechatstickerset
 */
class DeleteChatStickerSetMethod
{
    use ChatIdVariableTrait;

    /**
     * @param int|string $chatId
     */
    public function __construct($chatId)
    {
        $this->chatId = $chatId;
    }
}
