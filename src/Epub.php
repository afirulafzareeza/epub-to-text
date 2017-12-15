<?php

namespace jove4015\EpubToText;

use jove4015\EpubToText\Exceptions\CouldNotExtractText;
use jove4015\EpubToText\Exceptions\EpubNotFound;
use Symfony\Component\Process\Process;

class Epub
{
    protected $Epub;

    protected $binPath;

    public function __construct(string $binPath = null)
    {
        $this->binPath = $binPath ?? '/usr/bin/epub2txt';
    }

    public function setEpub(string $Epub) : Epub
    {
        if (!file_exists($Epub)) {
            throw new EpubNotFound("could not find Epub {$Epub}");
        }

        $this->Epub = $Epub;

        return $this;
    }

    public function text() : string
    {
        $process = new Process("{$this->binPath} -r -n " . escapeshellarg($this->Epub));
        $process->run();

        if (!$process->isSuccessful()) {
            throw new CouldNotExtractText($process);
        }

        return trim($process->getOutput(), " \t\n\r\0\x0B\x0C");
    }

    public static function getText(string $Epub, string $binPath = null) : string
    {
        return (new static($binPath))
            ->setEpub($Epub)
            ->text();
    }
}
