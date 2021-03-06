<?php

declare(strict_types=1);

namespace Greenplugin\TelegramBot\Method;

use Greenplugin\TelegramBot\Method\Traits\EmojisVariableTrait;
use Greenplugin\TelegramBot\Method\Traits\FillFromArrayTrait;
use Greenplugin\TelegramBot\Type\InputFileType;
use Greenplugin\TelegramBot\Type\MaskPositionType;

/**
 * Class AddStickerToSetMethod.
 *
 * @see https://core.telegram.org/bots/api#addstickertoset
 */
class AddStickerToSetMethod
{
    use FillFromArrayTrait;
    use EmojisVariableTrait;
    /**
     * User identifier of sticker set owner.
     *
     * @var int
     */
    public $userId;

    /**
     * Sticker set name.
     *
     * @var string
     */
    public $name;

    /**
     * Png image with the sticker, must be up to 512 kilobytes in size,
     * dimensions must not exceed 512px, and either width or height must be exactly 512px.
     * Pass a file_id as a String to send a file that already exists on the Telegram servers,
     * pass an HTTP URL as a String for Telegram to get a file from the Internet,
     * or upload a new one using multipart/form-data.
     *
     * @var InputFileType|string
     */
    public $pngSticker;

    /**
     * Optional. A JSON-serialized object for position where the mask should be placed on faces.
     *
     * @var MaskPositionType|null
     */
    public $maskPosition;

    /**
     * AddStickerToSetMethod constructor.
     *
     * @param int                  $userId
     * @param string               $name
     * @param InputFileType|string $pngSticker
     * @param string               $emojis
     * @param array|null           $data
     *
     * @throws \Greenplugin\TelegramBot\Exception\BadArgumentException
     */
    public function __construct(int $userId, string $name, $pngSticker, string $emojis, array $data = null)
    {
        $this->userId = $userId;
        $this->name = $name;
        $this->pngSticker = $pngSticker;
        $this->emojis = $emojis;
        if ($data) {
            $this->fill($data);
        }
    }
}
