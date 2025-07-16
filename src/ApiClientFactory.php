<?php

namespace App;

use Dotenv\Dotenv;
use OpenAPI\Client\Configuration;
use Symfony\Component\HttpClient\Psr18Client;
use RuntimeException;
use JsonException;

/**
 * Classe utilitaire pour la configuration du client API avec authentification Keycloak.
 */
class ApiClientFactory
{
    private array $env;
    private const HOST = 'https://iparapheur-5-0.partenaire.libriciel.fr';

    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();
        $this->env = $_ENV;
    }

    /**
     * Récupère un token d'accès OAuth2 depuis Keycloak.
     *
     * @return string
     * @throws JsonException|RuntimeException
     */
    public function fetchAccessToken(): string
    {
        $data = http_build_query([
            'username'   => $this->env['KEYCLOAK_USERNAME'],
            'password'   => $this->env['KEYCLOAK_PASSWORD'],
            'client_id'  => $this->env['KEYCLOAK_CLIENT_ID'],
            'grant_type' => 'password',
        ]);

        $context = stream_context_create([
            'http' => [
                'method'  => 'POST',
                'header'  => 'Content-Type: application/x-www-form-urlencoded',
                'content' => $data,
            ]
        ]);

        $response = @file_get_contents($this->env['KEYCLOAK_URL'], false, $context);

        if ($response === false) {
            throw new RuntimeException("Erreur lors de la récupération du token OAuth2.");
        }

        $json = json_decode($response, true, 512, JSON_THROW_ON_ERROR);

        return $json['access_token'] ?? throw new RuntimeException("Token non présent dans la réponse.");
    }

    /**
     * Crée le client HTTP et la configuration OpenAPI prête à l'emploi.
     *
     * @return array [Psr18Client, Configuration]
     * @throws JsonException|RuntimeException
     */
    public function create(): array
    {
        $token = $this->fetchAccessToken();

        $config = Configuration::getDefaultConfiguration()
            ->setAccessToken($token)
            ->setHost(self::HOST);

        $httpClient = new Psr18Client();

        return [$httpClient, $config];
    }
}
