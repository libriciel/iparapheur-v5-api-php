<?php

namespace Libriciel\IparapheurV5\App;

use Dotenv\Dotenv;
use Http\Discovery\Psr18Client;
use Libriciel\IparapheurV5\Client\Configuration;
use RuntimeException;
use JsonException;

/**
 * Classe utilitaire pour la configuration du client API avec authentification Keycloak.
 */
class ApiClientFactory
{
    /** @var array<string, string> */
    private array $env;

    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();

        /** @phpstan-ignore-next-line */
        $this->env = array_map('strval', $_ENV);
    }

    /**
     * @throws JsonException|RuntimeException
     * @return string
     */
    public function fetchAccessToken(): string
    {
        $data = http_build_query([
            'username' => $this->env['KEYCLOAK_USERNAME'],
            'password' => $this->env['KEYCLOAK_PASSWORD'],
            'client_id' => $this->env['KEYCLOAK_CLIENT_ID'],
            'grant_type' => 'password',
        ]);

        $context = stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => 'Content-Type: application/x-www-form-urlencoded',
                'content' => $data,
            ]
        ]);


        $response = @file_get_contents($this->env['KEYCLOAK_URL'], false, $context);
        if ($response === false) {
            throw new RuntimeException("Erreur lors de la récupération du token OAuth2.");
        }

        /** @var array{access_token?: string} $json */
        $json = json_decode($response, true, 512, JSON_THROW_ON_ERROR);
        return $json['access_token'] ?? throw new RuntimeException("Token non présent dans la réponse.");
    }


    /**
     * @throws JsonException
     * @return array{0: Psr18Client, 1: Configuration}
     */
    public function create(): array
    {
        $token = $this->fetchAccessToken();

        $config = Configuration::getDefaultConfiguration()
            ->setAccessToken($token)
            ->setHost($this->env['IPARAPHEUR_URL']);

        $httpClient = new Psr18Client();

        return [$httpClient, $config];
    }
}
