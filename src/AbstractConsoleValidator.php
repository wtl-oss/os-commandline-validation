<?php

namespace Wtl\CommandLineValidation;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator as ValidationContract;

abstract class AbstractConsoleValidator
{
    protected string $lastErrorMessages = "";

    /**
     * @throws ValidationException
     */
    public function executeValidation(array $commandLineUserInput, bool $throwException = false): bool
    {
        $validator = $this->createValidator($commandLineUserInput);
        try {
            $validator->validated();
            return true;
        } catch (ValidationException $e) {
            $this->lastErrorMessages = ($e->getMessage() . "\n" . $this->getErrorsFormatted($validator));
            if ($throwException) {
                throw $e;
            }
            return false;
        }
    }

    public function createValidator(array $optionsUserInput): ValidationContract
    {
        return Validator::make($optionsUserInput, $this->rules(), $this->messages(), $this->customAttributes());
    }

    public function getLastErrorMessages(): string
    {
        return $this->lastErrorMessages;
    }


    public function getErrorsFormatted(ValidationContract $validator): string
    {
        $errorMessage = "The command failed.\n\n";
        foreach ($validator->errors()->all() as $message) {
            $errorMessage = $errorMessage . $message . "\n";
        }
        return substr($errorMessage, 0, -1);
    }

    public abstract function rules(): array;

    public function customAttributes(): array
    {
        return [

        ];
    }

    public function messages(): array
    {
        return [

        ];
    }

}
