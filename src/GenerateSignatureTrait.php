<?php

namespace Wtl\CommandLineValidation;

trait GenerateSignatureTrait
{
    public function generateSignature(array $rulesArray, string $commandName, string $addAdditonalSignatureAttributes = null): string
    {
        $signatureGenerated = $commandName;
        $modelAttributes = array_keys($rulesArray);

        foreach ($modelAttributes as $attribute) {
            $signatureGenerated .= ' {--' . $attribute . '=}';
        }
        $signatureGenerated .= $addAdditonalSignatureAttributes;

        return $signatureGenerated;
    }
}
