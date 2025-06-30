# OpenAPI\Client\FolderApi

All URIs are relative to http://localhost:8080.

Method | HTTP request | Description
------------- | ------------- | -------------
[**createFolder()**](FolderApi.md#createFolder) | **POST** /api/standard/v1/tenant/{tenantId}/desk/{deskId}/folder | Create a folder
[**deleteFolder()**](FolderApi.md#deleteFolder) | **DELETE** /api/standard/v1/tenant/{tenantId}/desk/{deskId}/folder/{folderId} | Delete folder
[**downloadFolderPremis()**](FolderApi.md#downloadFolderPremis) | **GET** /api/standard/v1/tenant/{tenantId}/desk/{deskId}/folder/{folderId}/premis | Get a PREMIS-formatted file, containing the folder summary
[**downloadFolderZip()**](FolderApi.md#downloadFolderZip) | **GET** /api/standard/v1/tenant/{tenantId}/desk/{deskId}/folder/{folderId}/zip | Get every file as ZIP, with a PREMIS-formatted summary
[**listFolders()**](FolderApi.md#listFolders) | **GET** /api/standard/v1/tenant/{tenantId}/desk/{deskId}/{state} | List folders in the given state


## `createFolder()`

```php
createFolder($tenant_id, $desk_id, $folder, $documents, $auto_start): \OpenAPI\Client\Model\FolderRepresentation
```

Create a folder

The PREMIS-formatted XML multipart-file is mandatory, and must contain every needed data.   Every other file has to be sent as it is, with an appropriate MediaType.  Here's an example of a PREMIS file. The same structure than the one downloaded in a ZIP:  ```xml <?xml version=\"1.0\" encoding=\"UTF-8\"?> <premis xmlns=\"http://www.loc.gov/premis/v3\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" version=\"3.0\" xsi:schemaLocation=\"http://www.loc.gov/premis/v3 http://www.loc.gov/standards/premis/v3/premis.xsd\">   <!-- Folder -->   <object xsi:type=\"intellectualEntity\">     <significantProperties>       <significantPropertiesType>i_Parapheur_reserved_type</significantPropertiesType>       <significantPropertiesValue>type-id-or-name</significantPropertiesValue>     </significantProperties>     <significantProperties>       <significantPropertiesType>i_Parapheur_reserved_subtype</significantPropertiesType>       <significantPropertiesValue>subtype-id-or-name</significantPropertiesValue>     </significantProperties>     <originalName>Folder name</originalName>   </object>   <!-- Files -->   <object xsi:type=\"file\">     <significantProperties>       <significantPropertiesType>i_Parapheur_reserved_mainDocument</significantPropertiesType>       <significantPropertiesValue>true</significantPropertiesValue>     </significantProperties>     <originalName>my.pdf</originalName>   </object> </premis> ```

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: spring_oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\FolderApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$tenant_id = 'tenant_id_example'; // string | Tenant id
$desk_id = 'desk_id_example'; // string | Desk id
$folder = '/path/to/file.txt'; // \SplFileObject | Folder
$documents = array('/path/to/file.txt'); // \SplFileObject[] | Documents
$auto_start = true; // bool | If true, starts automatically the folder right after the draft creation

try {
    $result = $apiInstance->createFolder($tenant_id, $desk_id, $folder, $documents, $auto_start);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FolderApi->createFolder: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **tenant_id** | **string**| Tenant id |
 **desk_id** | **string**| Desk id |
 **folder** | **\SplFileObject****\SplFileObject**| Folder |
 **documents** | **\SplFileObject[]**| Documents |
 **auto_start** | **bool**| If true, starts automatically the folder right after the draft creation | [optional] [default to true]

### Return type

[**\OpenAPI\Client\Model\FolderRepresentation**](../Model/FolderRepresentation.md)

### Authorization

[spring_oauth](../../README.md#spring_oauth)

### HTTP request headers

- **Content-Type**: `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteFolder()`

```php
deleteFolder($tenant_id, $desk_id, $folder_id)
```

Delete folder

Deletes the given folder. Note that current pending folders cannot be deleted here. Only drafts/rejected/finished ones. To delete a currently pending folder, you need to go through the admin's access point.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: spring_oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\FolderApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$tenant_id = 'tenant_id_example'; // string | Tenant id
$desk_id = 'desk_id_example'; // string | Desk id
$folder_id = 'folder_id_example'; // string | Folder id

try {
    $apiInstance->deleteFolder($tenant_id, $desk_id, $folder_id);
} catch (Exception $e) {
    echo 'Exception when calling FolderApi->deleteFolder: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **tenant_id** | **string**| Tenant id |
 **desk_id** | **string**| Desk id |
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

## `downloadFolderPremis()`

```php
downloadFolderPremis($tenant_id, $desk_id, $folder_id)
```

Get a PREMIS-formatted file, containing the folder summary

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: spring_oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\FolderApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$tenant_id = 'tenant_id_example'; // string | Tenant id
$desk_id = 'desk_id_example'; // string | Desk id
$folder_id = 'folder_id_example'; // string | Folder id

try {
    $apiInstance->downloadFolderPremis($tenant_id, $desk_id, $folder_id);
} catch (Exception $e) {
    echo 'Exception when calling FolderApi->downloadFolderPremis: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **tenant_id** | **string**| Tenant id |
 **desk_id** | **string**| Desk id |
 **folder_id** | **string**| Folder id |

### Return type

void (empty response body)

### Authorization

[spring_oauth](../../README.md#spring_oauth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/xml`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `downloadFolderZip()`

```php
downloadFolderZip($tenant_id, $desk_id, $folder_id)
```

Get every file as ZIP, with a PREMIS-formatted summary

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: spring_oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\FolderApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$tenant_id = 'tenant_id_example'; // string | Tenant id
$desk_id = 'desk_id_example'; // string | Desk id
$folder_id = 'folder_id_example'; // string | Folder id

try {
    $apiInstance->downloadFolderZip($tenant_id, $desk_id, $folder_id);
} catch (Exception $e) {
    echo 'Exception when calling FolderApi->downloadFolderZip: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **tenant_id** | **string**| Tenant id |
 **desk_id** | **string**| Desk id |
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

## `listFolders()`

```php
listFolders($tenant_id, $desk_id, $state, $type_id, $subtype_id, $page, $size, $sort): \OpenAPI\Client\Model\PageFolderRepresentation
```

List folders in the given state

Returns every folders of the given state, on the the given desk.  - DRAFT (yellow pill)     : Non-started folders - PENDING (blue pill)     : Every pending folders on current desk - LATE (red pill)         : Same as PENDING, but only late ones - DELEGATED (purple pill) : Every pending folders that can be acted upon by delegation - FINISHED (green pill)   : Every finished workflow, ready to export - REJECTED (black pill)   : Every rejected workflow, ready to delete - RETRIEVABLE             : Available UNDO to perform

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: spring_oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\FolderApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$tenant_id = 'tenant_id_example'; // string | Tenant id
$desk_id = 'desk_id_example'; // string | Desk id
$state = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\State(); // \OpenAPI\Client\Model\State
$type_id = 'type_id_example'; // string | Type id
$subtype_id = 'subtype_id_example'; // string | Subtype id
$page = 0; // int | Zero-based page index (0..N)
$size = 10; // int | The size of the page to be returned
$sort = array('sort_example'); // string[] | Sorting criteria in the format: property,(asc|desc). Default sort order is ascending. Multiple sort criteria are supported.

try {
    $result = $apiInstance->listFolders($tenant_id, $desk_id, $state, $type_id, $subtype_id, $page, $size, $sort);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FolderApi->listFolders: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **tenant_id** | **string**| Tenant id |
 **desk_id** | **string**| Desk id |
 **state** | [**\OpenAPI\Client\Model\State**](../Model/.md)|  |
 **type_id** | **string**| Type id | [optional]
 **subtype_id** | **string**| Subtype id | [optional]
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
