<?php

declare(strict_types=1);

namespace Greenplugin\TelegramBot\Type\InlineQueryResult;

use Greenplugin\TelegramBot\Method\Interfaces\HasParseModeVariableInterface;
use Greenplugin\TelegramBot\Method\Traits\FillFromArrayTrait;
use Greenplugin\TelegramBot\Type\InputMessageContent\InputMessageContentType;

/**
 * Class InlineQueryResultDocumentType.
 *
 * Represents a link to a file. By default, this file will be sent by the user with an optional caption.
 * Alternatively, you can use input_message_content to send a message with the specified content instead of the file.
 * Currently, only .PDF and .ZIP files can be sent using this method.
 *
 * @see https://core.telegram.org/bots/api#inlinequeryresultdocument
 */
class InlineQueryResultDocumentType extends InlineQueryResultType implements HasParseModeVariableInterface
{
    use FillFromArrayTrait;
    const MIME_TYPE_PDF = 'application/pdf';
    const MIME_TYPE_ZIP = 'application/zip';

    /**
     * Title for the result;.
     *
     * @var string
     */
    public $title;

    /**
     * A valid URL for the file.
     *
     * @var string
     */
    public $documentUrl;

    /**
     * Mime type of the content of the file, either “application/pdf” or “application/zip”.
     *
     * @var string
     *
     * @see InlineQueryResultDocumentType::MIME_TYPE_PDF, InlineQueryResultDocumentType::MIME_TYPE_ZIP
     */
    public $mimeType;

    /**
     * Optional. Caption of the document to be sent, 0-1024 characters.
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
     * Optional. Short description of the result.
     *
     * @var string|null
     */
    public $description;

    /**
     * Optional. Content of the message to be sent instead of the file.
     *
     * @var InputMessageContentType|null
     */
    public $inputMessageContent;

    /**
     * Optional. URL of the thumbnail (jpeg only) for the file.
     *
     * @var string|null
     */
    public $thumbUrl;

    /**
     * Optional. Thumbnail width.
     *
     * @var int|null
     */
    public $thumbWidth;

    /**
     * Optional. Thumbnail height.
     *
     * @var int|null
     */
    public $thumbHeight;

    /**
     * InlineQueryResultDocumentType constructor.
     *
     * @param string     $id
     * @param string     $title
     * @param string     $documentUrl
     * @param string     $mimeType
     * @param array|null $data
     *
     * @throws \Greenplugin\TelegramBot\Exception\BadArgumentException
     */
    public function __construct(string $id, string $title, string $documentUrl, string $mimeType, array $data = null)
    {
        $this->type = self::TYPE_DOCUMENT;
        $this->id = $id;
        $this->title = $title;
        $this->documentUrl = $documentUrl;
        $this->$mimeType = $mimeType;
        if ($data) {
            $this->fill($data);
        }
    }
}
