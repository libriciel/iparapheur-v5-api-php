# OpenAPI\Client\AdminTrashBinApi

All URIs are relative to http://localhost:8080.

Method | HTTP request | Description
------------- | ------------- | -------------
[**deleteTrashBinFolder()**](AdminTrashBinApi.md#deleteTrashBinFolder) | **DELETE** /api/standard/v1/admin/tenant/{tenantId}/trash-bin/{folderId} | Permanently delete a folder
[**downloadTrashBinFolderZip()**](AdminTrashBinApi.md#downloadTrashBinFolderZip) | **GET** /api/standard/v1/admin/tenant/{tenantId}/trash-bin/{folderId}/zip | Download a folder as ZIP
[**listTrashBinFolders()**](AdminTrashBinApi.md#listTrashBinFolders) | **GET** /api/standard/v1/admin/tenant/{tenantId}/trash-bin | List folders in the trash-bin


## `deleteTrashBinFolder()`

```php
deleteTrashBinFolder($tenant_id, $folder_id)
```

Permanently delete a folder

The trash-bin is deleting automatically its data after a few days.   Using it is as a transit is not recommended, as **any delay in a folder process will result in a permanent loss of data**.  This endpoint requires an admin role.   Using it is as a transit is not recommended, as **sharing an admin login information to a third-party software is a security risk.**

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: spring_oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AdminTrashBinApi(
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

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **tenant_id** | **string**| Tenant id |
 **folder_id** | **string**| Folder id |

### Return type

void (empty response body)

### Authorization

[spring_oauth](../../README.md#spring_oauth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `downloadTrashBinFolderZip()`

```php
downloadTrashBinFolderZip($tenant_id, $folder_id)
```

Download a folder as ZIP

Get every file, annexes and main document in a ZIP, with a PREMIS-formatted summary  The trash-bin is deleting automatically its data after a few days.   Using it is as a transit is not recommended, as **any delay in a folder process will result in a permanent loss of data**.  This endpoint requires an admin role.   Using it is as a transit is not recommended, as **sharing an admin login information to a third-party software is a security risk.**

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: spring_oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AdminTrashBinApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$tenant_id = 'tenant_id_example'; // string | Tenant id
$folder_id = 'folder_id_example'; // string | Folder id

try {
    $apiInstance->downloadTrashBinFolderZip($tenant_id, $folder_id);
} catch (Exception $e) {
    echo 'Exception when calling AdminTrashBinApi->downloadTrashBinFolderZip: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **tenant_id** | **string**| Tenant id |
 **folder_id** | **string**| Folder id |

### Return type

void (empty response body)

### Authorization

[spring_oauth](../../README.md#spring_oauth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/octet-stream`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listTrashBinFolders()`

```php
listTrashBinFolders($tenant_id, $page, $size, $sort): \OpenAPI\Client\Model\PageFolderRepresentation
```

List folders in the trash-bin

Sorting properties are restricted to the FolderSortBy enum values  The trash-bin is deleting automatically its data after a few days.   Using it is as a transit is not recommended, as **any delay in a folder process will result in a permanent loss of data**.  This endpoint requires an admin role.   Using it is as a transit is not recommended, as **sharing an admin login information to a third-party software is a security risk.**

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: spring_oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\AdminTrashBinApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$tenant_id = 'tenant_id_example'; // string | Tenant id
$page = 0; // int | Zero-based page index (0..N)
$size = 10; // int | The size of the page to be returned
$sort = array('sort_example'); // string[] | Sorting criteria in the format: property,(asc|desc). Default sort order is ascending. Multiple sort criteria are supported.

try {
    $result = $apiInstance->listTrashBinFolders($tenant_id, $page, $size, $sort);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AdminTrashBinApi->listTrashBinFolders: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **tenant_id** | **string**| Tenant id |
 **page** | **int**| Zero-based page index (0..N) | [optional] [default to 0]
 **size** | **int**| The size of the page to be returned | [optional] [default to 10]
 **sort** | [**string[]**](../Model/string.md)| Sorting criteria in the format: property,(asc|desc). Default sort order is ascending. Multiple sort criteria are supported. | [optional]

### Return type

[**\OpenAPI\Client\Model\PageFolderRepresentation**](../Model/PageFolderRepresentation.md)

### Authorization

[spring_oauth](../../README.md#spring_oauth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
