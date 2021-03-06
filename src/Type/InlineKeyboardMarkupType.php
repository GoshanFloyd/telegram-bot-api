<?php

declare(strict_types=1);

namespace Greenplugin\TelegramBot\Type;

/**
 * Class InlineKeyboardMarkupType
 * Note: This will only work in Telegram versions released after 9 April, 2016. O
 * Older clients will display unsupported message.
 *
 * @see https://core.telegram.org/bots/api#inlinekeyboardmarkup
 * @see https://core.telegram.org/bots#inline-keyboards-and-on-the-fly-updating
 */
class InlineKeyboardMarkupType
{
    /**
     * Array of button rows, each represented by an Array of InlineKeyboardButton objects.
     *
     * @var InlineKeyboardButtonType[][]
     */
    public $inlineKeyboard;

    /**
     * InlineKeyboardMarkupType constructor.
     *
     * @param array $inlineKeyboard
     */
    public function __construct(array $inlineKeyboard = [])
    {
        $this->inlineKeyboard = $inlineKeyboard;
    }
}
