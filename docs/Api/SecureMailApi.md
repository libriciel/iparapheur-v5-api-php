# OpenAPI\Client\SecureMailApi

All URIs are relative to http://localhost:8080.

Method | HTTP request | Description
------------- | ------------- | -------------
[**requestSecureMail()**](SecureMailApi.md#requestSecureMail) | **PUT** /api/standard/v1/tenant/{tenantId}/desk/{deskId}/folder/{folderId}/task/{taskId}/secure_mail | Secure mail


## `requestSecureMail()`

```php
requestSecureMail($tenant_id, $desk_id, $folder_id, $task_id, $mail_params)
```

Secure mail

Send a secure mail

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: spring_oauth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\SecureMailApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$tenant_id = 'tenant_id_example'; // string | Tenant id
$desk_id = 'desk_id_example'; // string | Desk id
$folder_id = 'folder_id_example'; // string | Folder id
$task_id = 'task_id_example'; // string | Task id
$mail_params = new \OpenAPI\Client\Model\MailParams(); // \OpenAPI\Client\Model\MailParams

try {
    $apiInstance->requestSecureMail($tenant_id, $desk_id, $folder_id, $task_id, $mail_params);
} catch (Exception $e) {
    echo 'Exception when calling SecureMailApi->requestSecureMail: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **tenant_id** | **string**| Tenant id |
 **desk_id** | **string**| Desk id |
 **folder_id** | **string**| Folder id |
 **task_id** | **string**| Task id |
 **mail_params** | [**\OpenAPI\Client\Model\MailParams**](../Model/MailParams.md)|  |

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
