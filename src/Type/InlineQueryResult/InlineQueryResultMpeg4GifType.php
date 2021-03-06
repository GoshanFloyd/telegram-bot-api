<?php

declare(strict_types=1);

namespace Greenplugin\TelegramBot\Type\InlineQueryResult;

use Greenplugin\TelegramBot\Method\Interfaces\HasParseModeVariableInterface;
use Greenplugin\TelegramBot\Method\Traits\FillFromArrayTrait;
use Greenplugin\TelegramBot\Type\InputMessageContent\InputMessageContentType;

/**
 * Class InlineQueryResultMpeg4GifType.
 *
 * @see https://core.telegram.org/bots/api#inlinequeryresultmpeg4gif
 */
class InlineQueryResultMpeg4GifType extends InlineQueryResultType implements HasParseModeVariableInterface
{
    use FillFromArrayTrait;

    /**
     * A valid URL for the MP4 file. File size must not exceed 1MB.
     *
     * @var string
     */
    public $mpeg4Url;

    /**
     * Optional. Video width.
     *
     * @var int|null
     */
    public $mpeg4Width;

    /**
     * Optional. Video height.
     *
     * @var int|null
     */
    public $mpeg4Height;

    /**
     * Optional. Video duration.
     *
     * @var int|null
     */
    public $mpeg4Duration;

    /**
     * URL of the static thumbnail (jpeg or gif) for the result.
     *
     * @var string
     */
    public $thumbUrl;

    /**
     * Optional. Title for the result.
     *
     * @var string|null
     */
    public $title;

    /**
     * Optional. Caption of the GIF file to be sent, 0-1024 characters.
     *
     * @var string|null
     */
    public $caption;

    /**
     * Optional. Send Markdown or HTML, if you want Telegram apps to show bold, italic,
     * fixed-width text or inline URLs in the media caption.
     *
     * @var string|null
     */
    public $parseMode;

    /**
     * Optional. Content of the message to be sent instead of the GIF animation.
     *
     * @var InputMessageContentType|null
     */
    public $inputMessageContent;

    /**
     * InlineQueryResultMpeg4GifType constructor.
     *
     * @param string     $id
     * @param string     $mpeg4Url
     * @param string     $thumbUrl
     * @param array|null $data
     *
     * @throws \Greenplugin\TelegramBot\Exception\BadArgumentException
     */
    public function __construct(
        string $id,
        string $mpeg4Url,
        string $thumbUrl,
        array $data = null
    ) {
        $this->type = self::TYPE_MPEG4GIF;
        $this->id = $id;
        $this->mpeg4Url = $mpeg4Url;
        $this->thumbUrl = $thumbUrl;
        if ($data) {
            $this->fill($data);
        }
    }
}
