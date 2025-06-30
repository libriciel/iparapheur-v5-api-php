# OpenAPI\Client\TypologyApi

All URIs are relative to http://localhost:8080.

Method | HTTP request | Description
------------- | ------------- | -------------
[**listCreationAllowedSubtypes()**](TypologyApi.md#listCreationAllowedSubtypes) | **GET** /api/standard/v1/tenant/{tenantId}/desk/{deskId}/types/{typeId}/subtypes/creation-allowed | List creation-allowed subtypes from a given type, for the given desk
[**listCreationAllowedTypes()**](TypologyApi.md#listCreationAllowedTypes) | **GET** /api/standard/v1/tenant/{tenantId}/desk/{deskId}/types/creation-allowed | List types parent to a creation-allowed subtype on the given desk
[**listSubtypes()**](TypologyApi.md#listSubtypes) | **GET** /api/standard/v1/tenant/{tenantId}/types/{typeId}/subtypes | List all subtypes of a specific type on the current tenant
[**listTypes()**](TypologyApi.md#listTypes) | **GET** /api/standard/v1/tenant/{tenantId}/types | List all types on the current tenant


## `listCreationAllowedSubtypes()`

```php
listCreationAllowedSubtypes($tenant_id, $desk_id, $type_id, $page, $size, $sort): \OpenAPI\Client\Model\PageSubtypeRepresentation
```

List creation-allowed subtypes from a given type, for the given desk

Sorting properties are restricted to the Subtype enum values

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: spring_oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\TypologyApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$tenant_id = 'tenant_id_example'; // string | Tenant id
$desk_id = 'desk_id_example'; // string | Desk id
$type_id = 'type_id_example'; // string | Type id
$page = 0; // int | Zero-based page index (0..N)
$size = 10; // int | The size of the page to be returned
$sort = array('sort_example'); // string[] | Sorting criteria in the format: property,(asc|desc). Default sort order is ascending. Multiple sort criteria are supported.

try {
    $result = $apiInstance->listCreationAllowedSubtypes($tenant_id, $desk_id, $type_id, $page, $size, $sort);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TypologyApi->listCreationAllowedSubtypes: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **tenant_id** | **string**| Tenant id |
 **desk_id** | **string**| Desk id |
 **type_id** | **string**| Type id |
 **page** | **int**| Zero-based page index (0..N) | [optional] [default to 0]
 **size** | **int**| The size of the page to be returned | [optional] [default to 10]
 **sort** | [**string[]**](../Model/string.md)| Sorting criteria in the format: property,(asc|desc). Default sort order is ascending. Multiple sort criteria are supported. | [optional]

### Return type

[**\OpenAPI\Client\Model\PageSubtypeRepresentation**](../Model/PageSubtypeRepresentation.md)

### Authorization

[spring_oauth](../../README.md#spring_oauth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listCreationAllowedTypes()`

```php
listCreationAllowedTypes($tenant_id, $desk_id, $page, $size, $sort): \OpenAPI\Client\Model\PageTypeRepresentation
```

List types parent to a creation-allowed subtype on the given desk

Sorting properties are restricted to the Type enum values

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: spring_oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\TypologyApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$tenant_id = 'tenant_id_example'; // string | Tenant id
$desk_id = 'desk_id_example'; // string | Desk id
$page = 0; // int | Zero-based page index (0..N)
$size = 10; // int | The size of the page to be returned
$sort = array('sort_example'); // string[] | Sorting criteria in the format: property,(asc|desc). Default sort order is ascending. Multiple sort criteria are supported.

try {
    $result = $apiInstance->listCreationAllowedTypes($tenant_id, $desk_id, $page, $size, $sort);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TypologyApi->listCreationAllowedTypes: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **tenant_id** | **string**| Tenant id |
 **desk_id** | **string**| Desk id |
 **page** | **int**| Zero-based page index (0..N) | [optional] [default to 0]
 **size** | **int**| The size of the page to be returned | [optional] [default to 10]
 **sort** | [**string[]**](../Model/string.md)| Sorting criteria in the format: property,(asc|desc). Default sort order is ascending. Multiple sort criteria are supported. | [optional]

### Return type

[**\OpenAPI\Client\Model\PageTypeRepresentation**](../Model/PageTypeRepresentation.md)

### Authorization

[spring_oauth](../../README.md#spring_oauth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listSubtypes()`

```php
listSubtypes($tenant_id, $type_id, $page, $size, $sort): \OpenAPI\Client\Model\PageSubtypeRepresentation
```

List all subtypes of a specific type on the current tenant

Sorting properties are restricted to the Subtype enum values

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: spring_oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\TypologyApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$tenant_id = 'tenant_id_example'; // string | Tenant id
$type_id = 'type_id_example'; // string | Type id
$page = 0; // int | Zero-based page index (0..N)
$size = 10; // int | The size of the page to be returned
$sort = array('sort_example'); // string[] | Sorting criteria in the format: property,(asc|desc). Default sort order is ascending. Multiple sort criteria are supported.

try {
    $result = $apiInstance->listSubtypes($tenant_id, $type_id, $page, $size, $sort);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TypologyApi->listSubtypes: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **tenant_id** | **string**| Tenant id |
 **type_id** | **string**| Type id |
 **page** | **int**| Zero-based page index (0..N) | [optional] [default to 0]
 **size** | **int**| The size of the page to be returned | [optional] [default to 10]
 **sort** | [**string[]**](../Model/string.md)| Sorting criteria in the format: property,(asc|desc). Default sort order is ascending. Multiple sort criteria are supported. | [optional]

### Return type

[**\OpenAPI\Client\Model\PageSubtypeRepresentation**](../Model/PageSubtypeRepresentation.md)

### Authorization

[spring_oauth](../../README.md#spring_oauth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listTypes()`

```php
listTypes($tenant_id, $page, $size, $sort): \OpenAPI\Client\Model\PageTypeRepresentation
```

List all types on the current tenant

Sorting properties are restricted to the Type enum values

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: spring_oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\TypologyApi(
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
    $result = $apiInstance->listTypes($tenant_id, $page, $size, $sort);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TypologyApi->listTypes: ', $e->getMessage(), PHP_EOL;
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

[**\OpenAPI\Client\Model\PageTypeRepresentation**](../Model/PageTypeRepresentation.md)

### Authorization

[spring_oauth](../../README.md#spring_oauth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
