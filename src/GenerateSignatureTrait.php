<?php

namespace Wtl\CommandLineValidation;

use ParseError;

trait GenerateSignatureTrait
{
    /**
     * @throws ParseError
     */
    public function generateSignatureWithShortcuts(array $requestRules, string $commandName): string
    {
        $shortcutArray = ['h', 'q', 'v', 'n', 'x']; //default shortcuts+'x' for the exception throw
        $signatureGenerated = $commandName;
        $modelAttributes = array_keys($requestRules);

        if ((count($modelAttributes) + count($shortcutArray)) > 26) {
            throw new ParseError('Model has too many attributes');
        }

        foreach ($modelAttributes as $attribute) {
            $signatureGenerated .= ' {--';

            if (!in_array($attribute[0], $shortcutArray)) {
                $signatureGenerated .= $attribute[0];
                array_push($shortcutArray, $attribute[0]);
            } else {
                foreach (range('a', 'z') as $v) {
                    if (!in_array($v, $shortcutArray)) {
                        $signatureGenerated .= $v;
                        array_push($shortcutArray, $v);
                        break;
                    }
                }
            }

            $signatureGenerated .= '|' . $attribute . '=}';
        }
        $signatureGenerated .= ' {--x|reportException}';

        return $signatureGenerated;
    }

    public function generateSignatureWithoutShortcuts(array $requestRules, string $commandName): string
    {
        $signatureGenerated = $commandName;
        $modelAttributes = array_keys($requestRules);

        foreach ($modelAttributes as $attribute) {
            $signatureGenerated .= ' {--';
            $signatureGenerated .= $attribute . '=}';
        }
        $signatureGenerated .= ' {--x|reportException}';

        return $signatureGenerated;
    }
}
