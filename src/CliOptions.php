<?php

namespace App;

class CliOptions
{
    private array $options;

    public function __construct(array $longOpts, array $required = [])
    {
        $this->options = getopt('', $longOpts);

        foreach ($required as $key) {
            if (empty($this->options[$key])) {
                $this->usage($longOpts, $required);
                exit(1);
            }
        }
    }

    public function get(string $key): ?string
    {
        return $this->options[$key] ?? null;
    }

    private function usage(array $longOpts, array $required): void
    {
        $requiredStr = implode(', ', array_map(fn($r) => "--$r=...", $required));
        fwrite(STDERR, "Usage: php script.php $requiredStr [autres options...]\n");
        fwrite(STDERR, "Options disponibles :\n");
        foreach ($longOpts as $opt) {
            fwrite(STDERR, "  --$opt\n");
        }
    }
}
