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
    public function generateSignatureWithValidSignature(): void
    {
        $generatedSignatureSolution = 'user:create {--name=} {--email=} {--date_of_birth=} {--place_of_residence=}';

        self::assertEquals(
            $generatedSignatureSolution,
            $this->mockSignatureTrait->generateSignature($this->arrayRules, $this->commandName)
        );
    }

    /**
     * @test
     * @covers GenerateSignatureTrait::generateSignature
     */
    public function generateSignatureWithValidSignatureAndWithAdditionalBooleanSwitch(): void
    {
        $generatedSignatureSolution = 'user:create {--name=} {--email=} {--date_of_birth=} {--place_of_residence=}{--x|reportException}';

        self::assertEquals(
            $generatedSignatureSolution,
            $this->mockSignatureTrait->generateSignature($this->arrayRules, $this->commandName, '{--x|reportException}')
        );
    }
}
