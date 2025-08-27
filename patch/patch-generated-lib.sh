#!/bin/bash
set -e

echo "Patchs post-génération OpenAPI..."

echo "➤ Mise à jour du .gitignore"
grep -qxF '.idea' .gitignore || echo '.idea' >> .gitignore
grep -qxF '.env' .gitignore || echo '.env' >> .gitignore
grep -qxF 'downloads' .gitignore || echo 'downloads' >> .gitignore

echo "➤ Mise à jour de .php-cs-fixer.dist.php"
sed -i '/->exclude('\''tests'\'')/a\
    ->exclude('\''var'\'')\
    ->exclude('\''lib'\'')\
    ->exclude('\''exemples'\'')' .php-cs-fixer.dist.php

if [ -d "test" ]; then
    echo "➤ Suppression du dossier test/"
    rm -rf test
fi

echo "➤ Nettoyage de phpunit.xml.dist"
sed -i '/<directory>\.\/test\/Api<\/directory>/d' phpunit.xml.dist
sed -i '/<directory>\.\/test\/Model<\/directory>/d' phpunit.xml.dist

SUBTYPE_FILE="lib/Model/SubtypeRepresentation.php"
if [ -f "$SUBTYPE_FILE" ]; then
    echo "➤ Correction regex dans $SUBTYPE_FILE"
    sed -i 's/if ((!preg_match(.*ObjectSerializer::toString($name)))) {/if (!preg_match(\"\/^[^\\r\\n]*$\/\", \$name)) {/' "$SUBTYPE_FILE"
fi

TENANT_FILE="lib/Model/TenantRepresentation.php"
if [ -f "$TENANT_FILE" ]; then
    echo "➤ Correction regex dans $TENANT_FILE"
    sed -i 's/if ((!preg_match(.*ObjectSerializer::toString($name)))) {/if (!preg_match(\"\/^[^\\r\\n]*$\/\", \$name)) {/' "$TENANT_FILE"
fi

DESK_FILE="lib/Model/DeskRepresentation.php"
if [ -f "$DESK_FILE" ]; then
    echo "➤ Correction regex dans $DESK_FILE"
    sed -i 's/if ((!preg_match(.*ObjectSerializer::toString($name)))) {/if (!preg_match(\"\/^[^\\r\\n]*$\/\", \$name)) {/' "$DESK_FILE"
fi

TYPE_FILE="lib/Model/TypeRepresentation.php"
if [ -f "$TYPE_FILE" ]; then
    echo "➤ Correction regex dans $TYPE_FILE"
    sed -i 's/if ((!preg_match(.*ObjectSerializer::toString($name)))) {/if (!preg_match(\"\/^[^\\r\\n]*$\/\", \$name)) {/' "$TYPE_FILE"
fi

FOLDER_API_FILE="lib/Api/FolderApi.php"
PATCH_FUNCTION_NAME="createFolderRequest"

if [ -f "$FOLDER_API_FILE" ]; then
    echo "➤ Remplacement de la méthode $PATCH_FUNCTION_NAME dans $FOLDER_API_FILE"

    PATCH_METHOD=$(cat <<'EOF'

    public function createFolderRequest($tenant_id, $desk_id, $folder, $documents, $auto_start = true)
    {
        // verify the required parameter 'tenant_id' is set
        if ($tenant_id === null || (is_array($tenant_id) && count($tenant_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $tenant_id when calling createFolder'
            );
        }
        // verify the required parameter 'desk_id' is set
        if ($desk_id === null || (is_array($desk_id) && count($desk_id) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $desk_id when calling createFolder'
            );
        }
        // verify the required parameter 'folder' is set
        if ($folder === null || (is_array($folder) && count($folder) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $folder when calling createFolder'
            );
        }
        // verify the required parameter 'documents' is set
        if ($documents === null || (is_array($documents) && count($documents) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $documents when calling createFolder'
            );
        }

        $resourcePath = '/api/standard/v1/tenant/{tenantId}/desk/{deskId}/folder';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = null;
        $multipart = false;

        // query params
        if ($auto_start !== null) {
            if('form' === 'form' && is_array($auto_start)) {
                foreach($auto_start as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['autoStart'] = $auto_start;
            }
        }

        // path params
        if ($tenant_id !== null) {
            $resourcePath = str_replace(
                '{' . 'tenantId' . '}',
                ObjectSerializer::toPathValue($tenant_id),
                $resourcePath
            );
        }
        if ($desk_id !== null) {
            $resourcePath = str_replace(
                '{' . 'deskId' . '}',
                ObjectSerializer::toPathValue($desk_id),
                $resourcePath
            );
        }

        $folderRealPath = $folder->getRealPath();
        if ($folderRealPath === false) {
            throw new \RuntimeException('Folder file path invalid.');
        }
        $formParams[] = [
            'name'     => 'folder',
            'contents' => fopen($folderRealPath, 'r'),
            'filename' => basename($folderRealPath),
        ];

        foreach ($documents as $document) {
            $documentRealPath = $document->getRealPath();
            if ($documentRealPath === false) {
                throw new \RuntimeException('Document file path invalid.');
            }
            $formParams[] = [
                'name'     => 'documents',
                'contents' => fopen($documentRealPath, 'r'),
                'filename' => basename($documentRealPath),
            ];
        }

        $multipart = true;

        $headers = $this->headerSelector->selectHeaders(
            ['application/json'],
            'multipart/form-data',
            $multipart
        );

        $httpBody = new MultipartStream($formParams);
        $headers['Content-Type'] = 'multipart/form-data; boundary=' . $httpBody->getBoundary();

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();

        $uri = $this->createUri($operationHost, $resourcePath, $queryParams);

        return $this->createRequest('POST', $uri, $headers, $httpBody);
    }
EOF
)

PATCH_METHOD_ESCAPED=$(echo "$PATCH_METHOD" | sed 's/\\/\\\\/g')

    awk -v target="$PATCH_FUNCTION_NAME" -v patch="$PATCH_METHOD_ESCAPED" '
        BEGIN { skip = 0; brace = 0 }
        {
            if (!skip && $0 ~ "public function " target "\\(") {
                skip = 1;
                brace = gsub("{", "{", $0) - gsub("}", "}", $0);
                next;
            }
            else if (skip) {
                brace += gsub("{", "{", $0) - gsub("}", "}", $0);
                if (brace <= 0) {
                    skip = 0;
                    print patch;
                }
                next;
            }
            print;
        }
    ' "$FOLDER_API_FILE" > "$FOLDER_API_FILE.tmp" && mv "$FOLDER_API_FILE.tmp" "$FOLDER_API_FILE"
fi

PATCH_FUNCTION_NAME="downloadFolderPremis"

PATCH_METHOD=$(cat <<'EOF'
    public function downloadFolderPremis($tenant_id, $desk_id, $folder_id)
    {
        return $this->downloadFolderPremisWithHttpInfo($tenant_id, $desk_id, $folder_id)[0];
    }
EOF
)

if [ -f "$FOLDER_API_FILE" ]; then
    echo "➤ Remplacement de la méthode $PATCH_FUNCTION_NAME dans $FOLDER_API_FILE"

    awk -v target="$PATCH_FUNCTION_NAME" -v patch="$PATCH_METHOD" '
        BEGIN { skip = 0; brace = 0 }
        {
            if (skip) {
                brace += gsub("{", "{", $0) - gsub("}", "}", $0)
                if (brace <= 0) {
                    skip = 0
                    print patch
                }
                next
            }
            if ($0 ~ "public function " target "\\(") {
                brace = gsub("{", "{", $0) - gsub("}", "}", $0)
                skip = 1
                next
            }
            print
        }
    ' "$FOLDER_API_FILE" > "$FOLDER_API_FILE.tmp" && mv "$FOLDER_API_FILE.tmp" "$FOLDER_API_FILE"
fi

echo "➤ Correction du @return dans le docblock de $PATCH_FUNCTION_NAME"
sed -i "/\/\*\*/,/public function $PATCH_FUNCTION_NAME/ s/@return void/@return string/" "$FOLDER_API_FILE"


PATCH_FUNCTION_NAME="downloadFolderPremisWithHttpInfo"

PATCH_METHOD=$(cat <<'EOF'
    public function downloadFolderPremisWithHttpInfo($tenant_id, $desk_id, $folder_id)
    {
        $request = $this->downloadFolderPremisRequest($tenant_id, $desk_id, $folder_id);

        try {
            try {
                $response = $this->httpClient->sendRequest($request);
            } catch (HttpException $e) {
                $response = $e->getResponse();
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $response->getStatusCode(),
                        (string) $request->getUri()
                    ),
                    $request,
                    $response,
                    $e
                );
            } catch (ClientExceptionInterface $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $request,
                    null,
                    $e
                );
            }

            $statusCode = $response->getStatusCode();
            $body = $response->getBody();
            if ($body->isSeekable()) {
                $body->rewind();
            }
            $content = $body->getContents();

            return [$content, $statusCode, $response->getHeaders()];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Libriciel\IparapheurV5\Client\Model\ErrorResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Libriciel\IparapheurV5\Client\Model\ErrorResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Libriciel\IparapheurV5\Client\Model\ErrorResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }


            throw $e;
        }
    }
EOF
)

PATCH_METHOD_ESCAPED=$(echo "$PATCH_METHOD" | sed 's/\\/\\\\/g')

if [ -f "$FOLDER_API_FILE" ]; then
    echo "➤ Remplacement de la méthode $PATCH_FUNCTION_NAME dans $FOLDER_API_FILE"

    awk -v target="$PATCH_FUNCTION_NAME" -v patch="$PATCH_METHOD_ESCAPED" '
        BEGIN { skip = 0; brace = 0 }
        {
            if (!skip && $0 ~ "public function " target "\\(") {
                skip = 1;
                brace = gsub("{", "{", $0) - gsub("}", "}", $0);
                next;
            } else if (skip) {
                brace += gsub("{", "{", $0) - gsub("}", "}", $0);
                if (brace <= 0) {
                    skip = 0;
                    print patch;
                }
                next;
            }
            print;
        }
    ' "$FOLDER_API_FILE" > "$FOLDER_API_FILE.tmp" && mv "$FOLDER_API_FILE.tmp" "$FOLDER_API_FILE"
fi

PATCH_FUNCTION_NAME="downloadFolderZip"

PATCH_METHOD=$(cat <<'EOF'
    public function downloadFolderZip($tenant_id, $desk_id, $folder_id)
    {
        return $this->downloadFolderZipWithHttpInfo($tenant_id, $desk_id, $folder_id)[0];
    }
EOF
)

if [ -f "$FOLDER_API_FILE" ]; then
    echo "➤ Remplacement de la méthode $PATCH_FUNCTION_NAME dans $FOLDER_API_FILE"

    awk -v target="$PATCH_FUNCTION_NAME" -v patch="$PATCH_METHOD" '
        BEGIN { skip = 0; brace = 0 }
        {
            if (skip) {
                brace += gsub("{", "{", $0) - gsub("}", "}", $0)
                if (brace <= 0) {
                    skip = 0
                    print patch
                }
                next
            }
            if ($0 ~ "public function " target "\\(") {
                brace = gsub("{", "{", $0) - gsub("}", "}", $0)
                skip = 1
                next
            }
            print
        }
    ' "$FOLDER_API_FILE" > "$FOLDER_API_FILE.tmp" && mv "$FOLDER_API_FILE.tmp" "$FOLDER_API_FILE"
fi

echo "➤ Correction du @return dans le docblock de $PATCH_FUNCTION_NAME"
sed -i "/\/\*\*/,/public function $PATCH_FUNCTION_NAME/ s/@return void/@return string/" "$FOLDER_API_FILE"

PATCH_FUNCTION_NAME="downloadFolderZipWithHttpInfo"

PATCH_METHOD=$(cat <<'EOF'
    public function downloadFolderZipWithHttpInfo($tenant_id, $desk_id, $folder_id)
    {
        $request = $this->downloadFolderZipRequest($tenant_id, $desk_id, $folder_id);

        try {
            try {
                $response = $this->httpClient->sendRequest($request);
            } catch (HttpException $e) {
                $response = $e->getResponse();
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $response->getStatusCode(),
                        (string) $request->getUri()
                    ),
                    $request,
                    $response,
                    $e
                );
            } catch (ClientExceptionInterface $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $request,
                    null,
                    $e
                );
            }

            $statusCode = $response->getStatusCode();
            $body = $response->getBody();
            if ($body->isSeekable()) {
                $body->rewind();
            }
            $content = $body->getContents();

            return [$content, $statusCode, $response->getHeaders()];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Libriciel\IparapheurV5\Client\Model\ErrorResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Libriciel\IparapheurV5\Client\Model\ErrorResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Libriciel\IparapheurV5\Client\Model\ErrorResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }


            throw $e;
        }
    }
EOF
)

PATCH_METHOD_ESCAPED=$(echo "$PATCH_METHOD" | sed 's/\\/\\\\/g')

if [ -f "$FOLDER_API_FILE" ]; then
    echo "➤ Remplacement de la méthode $PATCH_FUNCTION_NAME dans $FOLDER_API_FILE"

    awk -v target="$PATCH_FUNCTION_NAME" -v patch="$PATCH_METHOD_ESCAPED" '
        BEGIN { skip = 0; brace = 0 }
        {
            if (!skip && $0 ~ "public function " target "\\(") {
                skip = 1;
                brace = gsub("{", "{", $0) - gsub("}", "}", $0);
                next;
            } else if (skip) {
                brace += gsub("{", "{", $0) - gsub("}", "}", $0);
                if (brace <= 0) {
                    skip = 0;
                    print patch;
                }
                next;
            }
            print;
        }
    ' "$FOLDER_API_FILE" > "$FOLDER_API_FILE.tmp" && mv "$FOLDER_API_FILE.tmp" "$FOLDER_API_FILE"
fi

ADMIN_API_FILE="lib/Api/AdminTrashBinApi.php"
PATCH_FUNCTION_NAME="downloadTrashBinFolderZip"

PATCH_METHOD=$(cat <<'EOF'
    public function downloadTrashBinFolderZip($tenant_id, $folder_id)
    {
        return $this->downloadTrashBinFolderZipWithHttpInfo($tenant_id, $folder_id)[0];
    }
EOF
)

if [ -f "$ADMIN_API_FILE" ]; then
    echo "➤ Remplacement de la méthode $PATCH_FUNCTION_NAME dans $ADMIN_API_FILE"

    awk -v target="$PATCH_FUNCTION_NAME" -v patch="$PATCH_METHOD" '
        BEGIN { skip = 0; brace = 0 }
        {
            if (!skip && $0 ~ "public function " target "\\(") {
                skip = 1;
                brace = gsub("{", "{", $0) - gsub("}", "}", $0);
                next;
            } else if (skip) {
                brace += gsub("{", "{", $0) - gsub("}", "}", $0);
                if (brace <= 0) {
                    skip = 0;
                    print patch;
                }
                next;
            }
            print;
        }
    ' "$ADMIN_API_FILE" > "$ADMIN_API_FILE.tmp" && mv "$ADMIN_API_FILE.tmp" "$ADMIN_API_FILE"
fi

echo "➤ Correction du @return dans le docblock de $PATCH_FUNCTION_NAME"
sed -i "/\/\*\*/,/public function $PATCH_FUNCTION_NAME/ s/@return void/@return string/" "$ADMIN_API_FILE"

PATCH_FUNCTION_NAME="downloadTrashBinFolderZipWithHttpInfo"

PATCH_METHOD=$(cat <<'EOF'
    public function downloadTrashBinFolderZipWithHttpInfo($tenant_id, $folder_id)
    {
        $request = $this->downloadTrashBinFolderZipRequest($tenant_id, $folder_id);

        try {
            try {
                $response = $this->httpClient->sendRequest($request);
            } catch (HttpException $e) {
                $response = $e->getResponse();
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $response->getStatusCode(),
                        (string) $request->getUri()
                    ),
                    $request,
                    $response,
                    $e
                );
            } catch (ClientExceptionInterface $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $request,
                    null,
                    $e
                );
            }

            $statusCode = $response->getStatusCode();
            $body = $response->getBody();
            if ($body->isSeekable()) {
                $body->rewind();
            }
            $content = $body->getContents();

            return [$content, $statusCode, $response->getHeaders()];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Libriciel\IparapheurV5\Client\Model\ErrorResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Libriciel\IparapheurV5\Client\Model\ErrorResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Libriciel\IparapheurV5\Client\Model\ErrorResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }

            throw $e;
        }
    }
EOF
)

PATCH_METHOD_ESCAPED=$(echo "$PATCH_METHOD" | sed 's/\\/\\\\/g')

if [ -f "$ADMIN_API_FILE" ]; then
    echo "➤ Remplacement de la méthode $PATCH_FUNCTION_NAME dans $ADMIN_API_FILE"

    awk -v target="$PATCH_FUNCTION_NAME" -v patch="$PATCH_METHOD_ESCAPED" '
        BEGIN { skip = 0; brace = 0 }
        {
            if (!skip && $0 ~ "public function " target "\\(") {
                skip = 1;
                brace = gsub("{", "{", $0) - gsub("}", "}", $0);
                next;
            } else if (skip) {
                brace += gsub("{", "{", $0) - gsub("}", "}", $0);
                if (brace <= 0) {
                    skip = 0;
                    print patch;
                }
                next;
            }
            print;
        }
    ' "$ADMIN_API_FILE" > "$ADMIN_API_FILE.tmp" && mv "$ADMIN_API_FILE.tmp" "$ADMIN_API_FILE"
fi

COMPOSER_FILE="composer.json"

echo "➤ Patch du composer.json"

jq '."name" = "libriciel/iparapheur-v5-api-php"' "$COMPOSER_FILE" > composer.tmp && mv composer.tmp "$COMPOSER_FILE"

jq '.config += { "allow-plugins": { "php-http/discovery": true } }' "$COMPOSER_FILE" > composer.tmp && mv composer.tmp "$COMPOSER_FILE"

jq '.require["vlucas/phpdotenv"] = "^5.6"' "$COMPOSER_FILE" > composer.tmp && mv composer.tmp "$COMPOSER_FILE"

jq '.["require-dev"] += {
  "phpstan/phpstan": "^2.1",
  "phpstan/phpstan-deprecation-rules": "^2.0",
  "phpstan/phpstan-phpunit": "^2.0",
  "squizlabs/php_codesniffer": "^3.13"
}' "$COMPOSER_FILE" > composer.tmp && mv composer.tmp "$COMPOSER_FILE"

jq '.autoload."psr-4" = {
  "Libriciel\\IparapheurV5\\Client\\": "lib/",
  "Libriciel\\IparapheurV5\\App\\": "src/"
}' "$COMPOSER_FILE" > composer.tmp && mv composer.tmp "$COMPOSER_FILE"

echo "Patchs appliqués avec succès."

