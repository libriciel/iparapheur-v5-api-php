<?php

namespace IparapheurV5Client\Api;

use IparapheurV5Client\Client;
use IparapheurV5Client\Exception\IparapheurV5Exception;
use IparapheurV5Client\Model\PageFolderRepresentation;
use IparapheurV5Client\ResponseDeserializer;
use IparapheurV5Client\TrashBinFoldersListQuery;
use IparapheurV5Client\UrlEncoder;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class TrashBinFolders
{
    public function __construct(
        private readonly Client $client
    ) {
    }

    public function getList(
        string $tenantId,
        TrashBinFoldersListQuery $listTrashBinFoldersQuery = null
    ): PageFolderRepresentation {
        if ($listTrashBinFoldersQuery === null) {
            $listTrashBinFoldersQuery = new TrashBinFoldersListQuery();
            $listTrashBinFoldersQuery->page = 0;
            $listTrashBinFoldersQuery->sort = 'FOLDER_NAME,ASC';
            $listTrashBinFoldersQuery->size = 10;
        }
        $encoders = [new UrlEncoder()];
        $normalizers = [new ObjectNormalizer(nameConverter: new CamelCaseToSnakeCaseNameConverter())];

        $serializer = (new Serializer($normalizers, $encoders));

        $queryPart = $serializer->serialize($listTrashBinFoldersQuery, 'url');
        $result = $this->client->get(sprintf("/api/v1/tenant/%s/archive?%s", $tenantId, $queryPart));
        $trashBinFoldersListResult = (new ResponseDeserializer())
            ->deserialize($result, PageFolderRepresentation::class);
        if (! $trashBinFoldersListResult instanceof PageFolderRepresentation) {
            throw new IparapheurV5Exception("Unexpected token response");
        }
        return $trashBinFoldersListResult;
    }
}
