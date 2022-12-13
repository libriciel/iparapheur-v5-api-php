<?php

namespace IparapheurV5Client\Api;

use Http\Client\Exception;
use IparapheurV5Client\Client;
use IparapheurV5Client\Exception\IparapheurV5Exception;
use IparapheurV5Client\Model\TenantListQuery;
use IparapheurV5Client\Model\TenantListResult;
use IparapheurV5Client\ResponseDeserializer;
use IparapheurV5Client\UrlEncoder;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class Tenant
{
    private const TENANT_LIST = '/api/v1/tenant';

    public function __construct(
        private readonly Client $client
    ) {
    }

    /**
     * @throws Exception
     * @throws IparapheurV5Exception
     */
    public function getList(TenantListQuery $tenantQuery = null): TenantListResult
    {
        if ($tenantQuery === null) {
            $tenantQuery = new TenantListQuery();
            $tenantQuery->page = 0;
            $tenantQuery->size = 10;
            $tenantQuery->sort = 'NAME,ASC';
            $tenantQuery->withAdminRights = false;
        }
        $encoders = [new UrlEncoder()];
        $normalizers = [new ObjectNormalizer(null, new CamelCaseToSnakeCaseNameConverter())];

        $serializer = (new Serializer($normalizers, $encoders));

        $queryPart = $serializer->serialize($tenantQuery, 'url');

        $result = $this->client->get(sprintf("%s?%s", self::TENANT_LIST, $queryPart));

        $tenantListResult = (new ResponseDeserializer())->deserialize($result, TenantListResult::class);
        if (! $tenantListResult instanceof TenantListResult) {
            throw new IparapheurV5Exception("Unexpected token response");
        }
        return $tenantListResult;
    }
}
