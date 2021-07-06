<?php

namespace Tests\Unit;

use ParseError;
use Wtl\CommandLineValidation\GenerateSignatureTrait;
use PHPUnit\Framework\TestCase;

class GenerateSignatureTraitTest extends TestCase
{
    private array $arrayRules;
    private string $commandName;
    private object $mockSignatureTrait;

    public function setUp() : void
    {
        $this->commandName = 'user:create';
        $this->arrayRules = [
            'name' => ['max:30'],
            'email' => ['required', 'unique:validations', 'email:rfc,dns'],
            'date_of_birth' => ['required', 'date_format:d-m-Y', 'before:-21 years'],
            'place_of_residence' => ['max:40']
        ];
        $this->mockSignatureTrait = $this->getObjectForTrait(GenerateSignatureTrait::class);
    }
    /**
     * @test
     * @covers GenerateSignatureTrait::generateSignature
     */
    public function generateSignatureWithoutShortcutsWithValidSignature(): void
    {
        $generatedSignatureSolution = 'user:create {--name=} {--email=} {--date_of_birth=} {--place_of_residence=}';

        self::assertEquals($this->mockSignatureTrait->generateSignature($this->arrayRules, $this->commandName), $generatedSignatureSolution);
    }

}
