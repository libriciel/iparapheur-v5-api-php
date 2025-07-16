<?php

namespace App;

use Exception;

class ApiExecutor
{
    /**
     * Exécute une opération API avec gestion unifiée des erreurs et affichage.
     *
     * @param callable $operation Une fonction qui retourne le résultat API
     * @param string|null $contextMessage Message affiché avant la sortie JSON
     * @param bool $raw Si true, affiche uniquement le JSON sans préfixe
     * @return void
     */
    public static function run(callable $operation, ?string $contextMessage = null, bool $raw = false): void
    {
        try {
            $result = $operation();

            if (!$raw && $contextMessage) {
                echo $contextMessage . "\n";
            }

            echo json_encode($result, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "\n";
        } catch (Exception $e) {
            fwrite(STDERR, "Erreur : " . $e->getMessage() . "\n");

            if (method_exists($e, 'getResponseBody') && $e->getResponseBody()) {
                fwrite(STDERR, "Corps de la réponse :\n" . $e->getResponseBody() . "\n");
            }

            exit(1);
        }
    }

    public static function runBinary(callable $operation, string $outputPath, string $successMessage = null): void
    {
        try {
            $content = $operation();
            file_put_contents($outputPath, $content);
            if ($successMessage) {
                echo $successMessage . "\n";
            } else {
                echo "Fichier écrit : $outputPath\n";
            }
        } catch (\Exception $e) {
            echo "Erreur : " . $e->getMessage() . "\n";
            if (method_exists($e, 'getResponseBody') && $e->getResponseBody()) {
                echo "Corps de la réponse :\n" . $e->getResponseBody() . "\n";
            }
        }
    }

}
