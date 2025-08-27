<?php

namespace Libriciel\IparapheurV5\App;

class CliOptions
{
    /** @var array<string, string|false> */
    private array $options;

    /**
     * @param list<string> $longOpts
     * @param list<string> $required
     */
    public function __construct(array $longOpts, array $required = [])
    {
        /** @var array<string, string|false> $parsed */
        $parsed = getopt('', $longOpts);
        $this->options = $parsed;

        foreach ($required as $key) {
            if (empty($this->options[$key])) {
                $this->usage($longOpts, $required);
                exit(1);
            }
        }
    }

    public function get(string $key): ?string
    {
        $value = $this->options[$key] ?? null;

        if (is_string($value)) {
            return $value;
        }

        return null;
    }

    /**
     * @param list<string> $longOpts
     * @param list<string> $required
     */
    private function usage(array $longOpts, array $required): void
    {
        $requiredStr = implode(', ', array_map(
            fn (string $r): string => "--$r=...",
            $required
        ));

        fwrite(STDERR, "Usage: php script.php $requiredStr [autres options...]\n");
        fwrite(STDERR, "Options disponibles :\n");

        foreach ($longOpts as $opt) {
            fwrite(STDERR, "  --$opt\n");
        }
    }
}
