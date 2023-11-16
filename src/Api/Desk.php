<?php

namespace IparapheurV5Client\Api;

use IparapheurV5Client\GenericObjectApi;
use IparapheurV5Client\Exception\IparapheurV5Exception;
use Psr\Http\Message\ResponseInterface;
use IparapheurV5Client\Model\PageDeskRepresentation;
use IparapheurV5Client\Model\ListUserDesksQuery;

class Desk extends GenericObjectApi
{
    public function listUserDesks(
        string $tenantId,
        ListUserDesksQuery $listUserDesksQuery = null
    ): PageDeskRepresentation {
        $path = sprintf(
            "/api/standard/v1/tenant/%s/desk",
            $tenantId
        );
        return $this->get($path, PageDeskRepresentation::class, $listUserDesksQuery);
    }
}
