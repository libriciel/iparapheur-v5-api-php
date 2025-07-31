# OpenAPIClient-php

iparapheur v5.x main core application.

The main link between every sub-services, integrating business code logic.


For more information, please visit [https://libriciel.fr](https://libriciel.fr).

## Installation & Usage

### Requirements

PHP 7.2 and later.

### Composer

To install the bindings via [Composer](https://getcomposer.org/), add the following to `composer.json`:

```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/GIT_USER_ID/GIT_REPO_ID.git"
    }
  ],
  "require": {
    "GIT_USER_ID/GIT_REPO_ID": "*@dev"
  }
}
```

Then run `composer install`

Your project is free to choose the http client of your choice
Please require packages that will provide http client functionality:
https://packagist.org/providers/psr/http-client-implementation
https://packagist.org/providers/php-http/async-client-implementation
https://packagist.org/providers/psr/http-factory-implementation

As an example:

```
composer require guzzlehttp/guzzle php-http/guzzle7-adapter http-interop/http-factory-guzzle
```

### Manual Installation

Download the files and include `autoload.php`:

```php
<?php
require_once('/path/to/OpenAPIClient-php/vendor/autoload.php');
```

## Getting Started

Please follow the [installation procedure](#installation--usage) and then run the following:

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



// Configure OAuth2 access token for authorization: spring_oauth
$config = Libriciel\IparapheurV5\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Libriciel\IparapheurV5\Client\Api\AdminTrashBinApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$tenant_id = 'tenant_id_example'; // string | Tenant id
$folder_id = 'folder_id_example'; // string | Folder id

try {
    $apiInstance->deleteTrashBinFolder($tenant_id, $folder_id);
} catch (Exception $e) {
    echo 'Exception when calling AdminTrashBinApi->deleteTrashBinFolder: ', $e->getMessage(), PHP_EOL;
}

```

## API Endpoints

All URIs are relative to *http://localhost:8080*

Class | Method | HTTP request | Description
------------ | ------------- | ------------- | -------------
*AdminTrashBinApi* | [**deleteTrashBinFolder**](docs/Api/AdminTrashBinApi.md#deletetrashbinfolder) | **DELETE** /api/standard/v1/admin/tenant/{tenantId}/trash-bin/{folderId} | Permanently delete a folder
*AdminTrashBinApi* | [**downloadTrashBinFolderZip**](docs/Api/AdminTrashBinApi.md#downloadtrashbinfolderzip) | **GET** /api/standard/v1/admin/tenant/{tenantId}/trash-bin/{folderId}/zip | Download a folder as ZIP
*AdminTrashBinApi* | [**listTrashBinFolders**](docs/Api/AdminTrashBinApi.md#listtrashbinfolders) | **GET** /api/standard/v1/admin/tenant/{tenantId}/trash-bin | List folders in the trash-bin
*DeskApi* | [**listUserDesks**](docs/Api/DeskApi.md#listuserdesks) | **GET** /api/standard/v1/tenant/{tenantId}/desk | List desks attached to the current user
*FolderApi* | [**createFolder**](docs/Api/FolderApi.md#createfolder) | **POST** /api/standard/v1/tenant/{tenantId}/desk/{deskId}/folder | Create a folder
*FolderApi* | [**deleteFolder**](docs/Api/FolderApi.md#deletefolder) | **DELETE** /api/standard/v1/tenant/{tenantId}/desk/{deskId}/folder/{folderId} | Delete folder
*FolderApi* | [**downloadFolderPremis**](docs/Api/FolderApi.md#downloadfolderpremis) | **GET** /api/standard/v1/tenant/{tenantId}/desk/{deskId}/folder/{folderId}/premis | Get a PREMIS-formatted file, containing the folder summary
*FolderApi* | [**downloadFolderZip**](docs/Api/FolderApi.md#downloadfolderzip) | **GET** /api/standard/v1/tenant/{tenantId}/desk/{deskId}/folder/{folderId}/zip | Get every file as ZIP, with a PREMIS-formatted summary
*FolderApi* | [**listFolders**](docs/Api/FolderApi.md#listfolders) | **GET** /api/standard/v1/tenant/{tenantId}/desk/{deskId}/{state} | List folders in the given state
*SecureMailApi* | [**requestSecureMail**](docs/Api/SecureMailApi.md#requestsecuremail) | **PUT** /api/standard/v1/tenant/{tenantId}/desk/{deskId}/folder/{folderId}/task/{taskId}/secure_mail | Secure mail
*TenantApi* | [**listTenants**](docs/Api/TenantApi.md#listtenants) | **GET** /api/standard/v1/tenant | List tenants attached with the current user
*TypologyApi* | [**listCreationAllowedSubtypes**](docs/Api/TypologyApi.md#listcreationallowedsubtypes) | **GET** /api/standard/v1/tenant/{tenantId}/desk/{deskId}/types/{typeId}/subtypes/creation-allowed | List creation-allowed subtypes from a given type, for the given desk
*TypologyApi* | [**listCreationAllowedTypes**](docs/Api/TypologyApi.md#listcreationallowedtypes) | **GET** /api/standard/v1/tenant/{tenantId}/desk/{deskId}/types/creation-allowed | List types parent to a creation-allowed subtype on the given desk
*TypologyApi* | [**listSubtypes**](docs/Api/TypologyApi.md#listsubtypes) | **GET** /api/standard/v1/tenant/{tenantId}/types/{typeId}/subtypes | List all subtypes of a specific type on the current tenant
*TypologyApi* | [**listTypes**](docs/Api/TypologyApi.md#listtypes) | **GET** /api/standard/v1/tenant/{tenantId}/types | List all types on the current tenant
*WorkflowApi* | [**bypass**](docs/Api/WorkflowApi.md#bypass) | **PUT** /api/standard/v1/tenant/{tenantId}/desk/{deskId}/folder/{folderId}/task/{taskId}/bypass | Bypass
*WorkflowApi* | [**seal**](docs/Api/WorkflowApi.md#seal) | **PUT** /api/standard/v1/tenant/{tenantId}/desk/{deskId}/folder/{folderId}/task/{taskId}/seal | Seal
*WorkflowApi* | [**secondOpinion**](docs/Api/WorkflowApi.md#secondopinion) | **PUT** /api/standard/v1/tenant/{tenantId}/desk/{deskId}/folder/{folderId}/task/{taskId}/second_opinion | Second opinion
*WorkflowApi* | [**sendToTrashBin**](docs/Api/WorkflowApi.md#sendtotrashbin) | **PUT** /api/standard/v1/tenant/{tenantId}/desk/{deskId}/folder/{folderId}/task/{taskId}/send_to_trash_bin | Send to trash-bin
*WorkflowApi* | [**start**](docs/Api/WorkflowApi.md#start) | **PUT** /api/standard/v1/tenant/{tenantId}/desk/{deskId}/folder/{folderId}/task/{taskId}/start | Start
*WorkflowApi* | [**undo**](docs/Api/WorkflowApi.md#undo) | **PUT** /api/standard/v1/tenant/{tenantId}/desk/{deskId}/folder/{folderId}/task/{taskId}/undo | Undo
*WorkflowApi* | [**visa**](docs/Api/WorkflowApi.md#visa) | **PUT** /api/standard/v1/tenant/{tenantId}/desk/{deskId}/folder/{folderId}/task/{taskId}/visa | Visa

## Models

- [Action](docs/Model/Action.md)
- [DeskRepresentation](docs/Model/DeskRepresentation.md)
- [DeskSortBy](docs/Model/DeskSortBy.md)
- [ErrorResponse](docs/Model/ErrorResponse.md)
- [FolderRepresentation](docs/Model/FolderRepresentation.md)
- [FolderSortBy](docs/Model/FolderSortBy.md)
- [MailParams](docs/Model/MailParams.md)
- [PageFolderRepresentation](docs/Model/PageFolderRepresentation.md)
- [PageableObject](docs/Model/PageableObject.md)
- [SealTaskParams](docs/Model/SealTaskParams.md)
- [SimpleTaskParams](docs/Model/SimpleTaskParams.md)
- [SortObject](docs/Model/SortObject.md)
- [StandardApiPageImplDeskRepresentation](docs/Model/StandardApiPageImplDeskRepresentation.md)
- [StandardApiPageImplFolderRepresentation](docs/Model/StandardApiPageImplFolderRepresentation.md)
- [StandardApiPageImplSubtypeRepresentation](docs/Model/StandardApiPageImplSubtypeRepresentation.md)
- [StandardApiPageImplTenantRepresentation](docs/Model/StandardApiPageImplTenantRepresentation.md)
- [StandardApiPageImplTypeRepresentation](docs/Model/StandardApiPageImplTypeRepresentation.md)
- [StandardApiPageable](docs/Model/StandardApiPageable.md)
- [StandardApiSort](docs/Model/StandardApiSort.md)
- [State](docs/Model/State.md)
- [SubtypeRepresentation](docs/Model/SubtypeRepresentation.md)
- [SubtypeSortBy](docs/Model/SubtypeSortBy.md)
- [TenantRepresentation](docs/Model/TenantRepresentation.md)
- [TenantSortBy](docs/Model/TenantSortBy.md)
- [TypeRepresentation](docs/Model/TypeRepresentation.md)
- [TypeSortBy](docs/Model/TypeSortBy.md)

## Authorization

### spring_oauth

- **Type**: `OAuth`
- **Flow**: `accessCode`
- **Authorization URL**: `./auth/realms/api/protocol/openid-connect/auth`
- **Scopes**: N/A

## Tests

To run the tests, use:

```bash
composer install
vendor/bin/phpunit
```

## Author

iparapheur@libriciel.coop

## About this package

This PHP package is automatically generated by the [OpenAPI Generator](https://openapi-generator.tech) project:

- API version: `DEVELOP`
    - Generator version: `7.14.0`
- Build package: `org.openapitools.codegen.languages.PhpClientCodegen`
