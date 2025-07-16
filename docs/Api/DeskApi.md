# OpenAPI\Client\DeskApi

All URIs are relative to http://localhost:8080.

Method | HTTP request | Description
------------- | ------------- | -------------
[**listUserDesks()**](DeskApi.md#listUserDesks) | **GET** /api/standard/v1/tenant/{tenantId}/desk | List desks attached to the current user


## `listUserDesks()`

```php
listUserDesks($tenant_id, $page, $size, $sort): \OpenAPI\Client\Model\StandardApiPageImplDeskRepresentation
```

List desks attached to the current user

Sorting properties are restricted to the DeskSortBy enum values

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: spring_oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\DeskApi(
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
    $result = $apiInstance->listUserDesks($tenant_id, $page, $size, $sort);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DeskApi->listUserDesks: ', $e->getMessage(), PHP_EOL;
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

[**\OpenAPI\Client\Model\StandardApiPageImplDeskRepresentation**](../Model/StandardApiPageImplDeskRepresentation.md)

### Authorization

[spring_oauth](../../README.md#spring_oauth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
