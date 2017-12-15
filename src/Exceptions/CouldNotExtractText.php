<?php

namespace jove4015\EpubToText\Exceptions;

use Symfony\Component\Process\Exception\ProcessFailedException;

class CouldNotExtractText extends ProcessFailedException
{
}
