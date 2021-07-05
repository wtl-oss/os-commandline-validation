<?php

namespace Wtl\CommandLineValidation;

trait GenerateSignatureTrait
{
    public function generateSignature(array $rulesArray, string $commandName): string
    {
        $signatureGenerated = $commandName;
        $modelAttributes = array_keys($rulesArray);

        foreach ($modelAttributes as $attribute) {
            $signatureGenerated .= ' {--';
            $signatureGenerated .= $attribute . '=}';
        }
        $signatureGenerated .= ' {--x|reportException}';

        return $signatureGenerated;
    }
}
