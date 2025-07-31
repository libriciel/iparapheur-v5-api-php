# Libriciel\IparapheurV5\Client\WorkflowApi

All URIs are relative to http://localhost:8080.

Method | HTTP request | Description
------------- | ------------- | -------------
[**bypass()**](WorkflowApi.md#bypass) | **PUT** /api/standard/v1/tenant/{tenantId}/desk/{deskId}/folder/{folderId}/task/{taskId}/bypass | Bypass
[**seal()**](WorkflowApi.md#seal) | **PUT** /api/standard/v1/tenant/{tenantId}/desk/{deskId}/folder/{folderId}/task/{taskId}/seal | Seal
[**secondOpinion()**](WorkflowApi.md#secondOpinion) | **PUT** /api/standard/v1/tenant/{tenantId}/desk/{deskId}/folder/{folderId}/task/{taskId}/second_opinion | Second opinion
[**sendToTrashBin()**](WorkflowApi.md#sendToTrashBin) | **PUT** /api/standard/v1/tenant/{tenantId}/desk/{deskId}/folder/{folderId}/task/{taskId}/send_to_trash_bin | Send to trash-bin
[**start()**](WorkflowApi.md#start) | **PUT** /api/standard/v1/tenant/{tenantId}/desk/{deskId}/folder/{folderId}/task/{taskId}/start | Start
[**undo()**](WorkflowApi.md#undo) | **PUT** /api/standard/v1/tenant/{tenantId}/desk/{deskId}/folder/{folderId}/task/{taskId}/undo | Undo
[**visa()**](WorkflowApi.md#visa) | **PUT** /api/standard/v1/tenant/{tenantId}/desk/{deskId}/folder/{folderId}/task/{taskId}/visa | Visa


## `bypass()`

```php
bypass($tenant_id, $desk_id, $folder_id, $task_id)
```

Bypass

Force an external task stuck in a waiting state.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: spring_oauth
$config = Libriciel\IparapheurV5\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Libriciel\IparapheurV5\Client\Api\WorkflowApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$tenant_id = 'tenant_id_example'; // string | Tenant id
$desk_id = 'desk_id_example'; // string | Desk id
$folder_id = 'folder_id_example'; // string | Folder id
$task_id = 'task_id_example'; // string | Task id

try {
    $apiInstance->bypass($tenant_id, $desk_id, $folder_id, $task_id);
} catch (Exception $e) {
    echo 'Exception when calling WorkflowApi->bypass: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **tenant_id** | **string**| Tenant id |
 **desk_id** | **string**| Desk id |
 **folder_id** | **string**| Folder id |
 **task_id** | **string**| Task id |

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

## `seal()`

```php
seal($tenant_id, $desk_id, $folder_id, $task_id, $seal_task_params)
```

Seal

Perform a Seal on a Task.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: spring_oauth
$config = Libriciel\IparapheurV5\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Libriciel\IparapheurV5\Client\Api\WorkflowApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$tenant_id = 'tenant_id_example'; // string | Tenant id
$desk_id = 'desk_id_example'; // string | Desk id
$folder_id = 'folder_id_example'; // string | Folder id
$task_id = 'task_id_example'; // string | Task id
$seal_task_params = new \Libriciel\IparapheurV5\Client\Model\SealTaskParams(); // \Libriciel\IparapheurV5\Client\Model\SealTaskParams

try {
    $apiInstance->seal($tenant_id, $desk_id, $folder_id, $task_id, $seal_task_params);
} catch (Exception $e) {
    echo 'Exception when calling WorkflowApi->seal: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **tenant_id** | **string**| Tenant id |
 **desk_id** | **string**| Desk id |
 **folder_id** | **string**| Folder id |
 **task_id** | **string**| Task id |
 **seal_task_params** | [**\Libriciel\IparapheurV5\Client\Model\SealTaskParams**](../Model/SealTaskParams.md)|  |

### Return type

void (empty response body)

### Authorization

[spring_oauth](../../README.md#spring_oauth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `secondOpinion()`

```php
secondOpinion($tenant_id, $desk_id, $folder_id, $task_id, $simple_task_params)
```

Second opinion

Perform a straightforward Second opinion on a Task

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: spring_oauth
$config = Libriciel\IparapheurV5\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Libriciel\IparapheurV5\Client\Api\WorkflowApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$tenant_id = 'tenant_id_example'; // string | Tenant id
$desk_id = 'desk_id_example'; // string | Desk id
$folder_id = 'folder_id_example'; // string | Folder id
$task_id = 'task_id_example'; // string | Task id
$simple_task_params = new \Libriciel\IparapheurV5\Client\Model\SimpleTaskParams(); // \Libriciel\IparapheurV5\Client\Model\SimpleTaskParams

try {
    $apiInstance->secondOpinion($tenant_id, $desk_id, $folder_id, $task_id, $simple_task_params);
} catch (Exception $e) {
    echo 'Exception when calling WorkflowApi->secondOpinion: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **tenant_id** | **string**| Tenant id |
 **desk_id** | **string**| Desk id |
 **folder_id** | **string**| Folder id |
 **task_id** | **string**| Task id |
 **simple_task_params** | [**\Libriciel\IparapheurV5\Client\Model\SimpleTaskParams**](../Model/SimpleTaskParams.md)|  |

### Return type

void (empty response body)

### Authorization

[spring_oauth](../../README.md#spring_oauth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `sendToTrashBin()`

```php
sendToTrashBin($tenant_id, $desk_id, $folder_id, $task_id)
```

Send to trash-bin

Only applicable to ended folders, this will remove the folder content into the trash-bin, where it will soon be auto-erased.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: spring_oauth
$config = Libriciel\IparapheurV5\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Libriciel\IparapheurV5\Client\Api\WorkflowApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$tenant_id = 'tenant_id_example'; // string | Tenant id
$desk_id = 'desk_id_example'; // string | Desk id
$folder_id = 'folder_id_example'; // string | Folder id
$task_id = 'task_id_example'; // string

try {
    $apiInstance->sendToTrashBin($tenant_id, $desk_id, $folder_id, $task_id);
} catch (Exception $e) {
    echo 'Exception when calling WorkflowApi->sendToTrashBin: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **tenant_id** | **string**| Tenant id |
 **desk_id** | **string**| Desk id |
 **folder_id** | **string**| Folder id |
 **task_id** | **string**|  |

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

## `start()`

```php
start($tenant_id, $desk_id, $folder_id, $task_id, $simple_task_params)
```

Start

Start the given Folder

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: spring_oauth
$config = Libriciel\IparapheurV5\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Libriciel\IparapheurV5\Client\Api\WorkflowApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$tenant_id = 'tenant_id_example'; // string | Tenant id
$desk_id = 'desk_id_example'; // string | Desk id
$folder_id = 'folder_id_example'; // string | Folder id
$task_id = 'task_id_example'; // string
$simple_task_params = new \Libriciel\IparapheurV5\Client\Model\SimpleTaskParams(); // \Libriciel\IparapheurV5\Client\Model\SimpleTaskParams

try {
    $apiInstance->start($tenant_id, $desk_id, $folder_id, $task_id, $simple_task_params);
} catch (Exception $e) {
    echo 'Exception when calling WorkflowApi->start: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **tenant_id** | **string**| Tenant id |
 **desk_id** | **string**| Desk id |
 **folder_id** | **string**| Folder id |
 **task_id** | **string**|  |
 **simple_task_params** | [**\Libriciel\IparapheurV5\Client\Model\SimpleTaskParams**](../Model/SimpleTaskParams.md)|  |

### Return type

void (empty response body)

### Authorization

[spring_oauth](../../README.md#spring_oauth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `undo()`

```php
undo($tenant_id, $desk_id, $folder_id, $task_id)
```

Undo

Rollback the action to the previous state.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: spring_oauth
$config = Libriciel\IparapheurV5\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Libriciel\IparapheurV5\Client\Api\WorkflowApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$tenant_id = 'tenant_id_example'; // string | Tenant id
$desk_id = 'desk_id_example'; // string | Desk id
$folder_id = 'folder_id_example'; // string | Folder id
$task_id = 'task_id_example'; // string | Task id

try {
    $apiInstance->undo($tenant_id, $desk_id, $folder_id, $task_id);
} catch (Exception $e) {
    echo 'Exception when calling WorkflowApi->undo: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **tenant_id** | **string**| Tenant id |
 **desk_id** | **string**| Desk id |
 **folder_id** | **string**| Folder id |
 **task_id** | **string**| Task id |

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

## `visa()`

```php
visa($tenant_id, $desk_id, $folder_id, $task_id, $simple_task_params)
```

Visa

Perform a straightforward Visa on a Task

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: spring_oauth
$config = Libriciel\IparapheurV5\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Libriciel\IparapheurV5\Client\Api\WorkflowApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$tenant_id = 'tenant_id_example'; // string | Tenant id
$desk_id = 'desk_id_example'; // string | Desk id
$folder_id = 'folder_id_example'; // string | Folder id
$task_id = 'task_id_example'; // string | Task id
$simple_task_params = new \Libriciel\IparapheurV5\Client\Model\SimpleTaskParams(); // \Libriciel\IparapheurV5\Client\Model\SimpleTaskParams

try {
    $apiInstance->visa($tenant_id, $desk_id, $folder_id, $task_id, $simple_task_params);
} catch (Exception $e) {
    echo 'Exception when calling WorkflowApi->visa: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **tenant_id** | **string**| Tenant id |
 **desk_id** | **string**| Desk id |
 **folder_id** | **string**| Folder id |
 **task_id** | **string**| Task id |
 **simple_task_params** | [**\Libriciel\IparapheurV5\Client\Model\SimpleTaskParams**](../Model/SimpleTaskParams.md)|  |

### Return type

void (empty response body)

### Authorization

[spring_oauth](../../README.md#spring_oauth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
