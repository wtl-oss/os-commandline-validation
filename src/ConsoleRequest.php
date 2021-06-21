<?php

namespace Wtl\CommandLineValidation;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

abstract class ConsoleRequest
{
    protected $validator;
    protected $lastErrorMessages = "";

    /**
     * @throws ValidationException
     */
    public function executeValidation(bool $reportException, array $optionUserInput): bool
    {
        try {
            $this->createValidator($optionUserInput);
            $this->validator->validated();
            return true;
        } catch (ValidationException $e) {
            $this->lastErrorMessages = ($e->getMessage() . "\n" . $this->getErrorsFormatted());
            if ($reportException) throw $e;
            return false;
        }
    }

    public function createValidator(array $optionsUserInput)
    {
        $this->validator = Validator::make($optionsUserInput, $this->rules(), $this->messages(), $this->customAttributes());
    }

    public function getLastErrorMessages(): string
    {
        return $this->lastErrorMessages;
    }


    public function getErrorsFormatted(): string
    {
        $errorMessage = "The command failed.\n\n";
        foreach ($this->validator->errors()->all() as $message) {
            $errorMessage = $errorMessage . $message . "\n";
        }
        return substr($errorMessage, 0, -1);
    }

    abstract public function rules(): array;


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
