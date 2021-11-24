<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Endpoint\Traits\GetEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\ListEndpointTrait;
use DigitalCz\DigiSign\Resource\EnvelopeRecipient;
use DigitalCz\DigiSign\Resource\EnvelopeRecipientAttachment;
use DigitalCz\DigiSign\Stream\FileResponse;

/**
 * @extends ResourceEndpoint<EnvelopeRecipientAttachment>
 * @method EnvelopeRecipientAttachment get(string $id)
 */
final class EnvelopeRecipientAttachmentsEndpoint extends ResourceEndpoint
{
    /** @use ListEndpointTrait<EnvelopeRecipientAttachment> */
    use ListEndpointTrait;
    use GetEndpointTrait;

    /**
     * @param EnvelopeRecipient|string $recipient
     */
    public function __construct(EnvelopeRecipientsEndpoint $parent, $recipient)
    {
        parent::__construct(
            $parent,
            '/{recipient}/attachments',
            EnvelopeRecipientAttachment::class,
            ['recipient' => $recipient]
        );
    }

    /**
     * @param EnvelopeRecipientAttachment|string $id
     * @param mixed[] $query
     */
    public function download($id, array $query = []): FileResponse
    {
        return $this->stream(self::METHOD_GET, '/{id}/download', ['id' => $id, 'query' => $query]);
    }
}