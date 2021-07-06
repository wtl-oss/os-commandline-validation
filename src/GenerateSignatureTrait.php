<?php

namespace Wtl\CommandLineValidation;

trait GenerateSignatureTrait
{
    public function generateSignature(array $rulesArray, string $commandName, string $addAdditonalSignatureAttribute = null): string
    {
        $signatureGenerated = $commandName;
        $modelAttributes = array_keys($rulesArray);

        foreach ($modelAttributes as $attribute) {
            $signatureGenerated .= ' {--' . $attribute . '=}';
        }
        $signatureGenerated .= $addAdditonalSignatureAttribute;

        return $signatureGenerated;
    }
}
