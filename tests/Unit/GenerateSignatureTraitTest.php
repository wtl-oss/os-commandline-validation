<?php

namespace Tests\Unit;

use ParseError;
use Wtl\CommandLineValidation\GenerateSignatureTrait;
use PHPUnit\Framework\TestCase;

class GenerateSignatureTraitTest extends TestCase
{
    private $arrayRules;
    private $commandName;
    private $generateSignatureTrait;

    public function setUp() : void
    {
        $this->commandName = 'user:create';
        $this->arrayRules = [
            'name' => ['max:30'],
            'email' => ['required', 'unique:validations', 'email:rfc,dns'],
            'date_of_birth' => ['required', 'date_format:d-m-Y', 'before:-21 years'],
            'place_of_residence' => ['max:40']
        ];
        $this->generateSignatureTrait = $this->getObjectForTrait(GenerateSignatureTrait::class);
    }
    /**
     * @test
     * @covers GenerateSignatureTrait::generateSignatureWithoutShortcuts
     */
    public function generateSignatureWithoutShortcutsGeneratesWithValidSignature(): void
    {
        $solution = 'user:create {--name=} {--email=} {--date_of_birth=} {--place_of_residence=} {--x|reportException}';

        self::assertEquals($this->generateSignatureTrait->generateSignatureWithoutShortcuts($this->arrayRules, $this->commandName), $solution);
    }
    /**
     * @test
     * @covers GenerateSignatureTrait::generateSignatureWithShortcuts
     */
    public function generateSignatureWithShortcutsGeneratesValidSignature(): void
    {
        $solution = 'user:create {--a|name=} {--e|email=} {--d|date_of_birth=} {--p|place_of_residence=} {--x|reportException}';

        self::assertEquals($this->generateSignatureTrait->generateSignatureWithShortcuts($this->arrayRules, $this->commandName), $solution);
    }
    /**
     * @test
     * @covers GenerateSignatureTrait::generateSignatureWithShortcuts
     */
    public function generateSignatureWithShortcutsGeneratesTooManyRulesNotEnoughShortcuts(): void
    {
        $arrayRulesTooMany = [
            'name' => ['max:30'],
            'email' => ['required', 'unique:validations', 'email:rfc,dns'],
            'date_of_birth' => ['required', 'date_format:d-m-Y', 'before:-21 years'],
            'place_of_residence' => ['max:40'],
            'b' => 'c',
            'c' => 'c',
            'd' => 'c',
            'e' => 'c',
            'f' => 'c',
            'g' => 'c',
            'h' => 'c',
            'i' => 'c',
            'j' => 'c',
            'k' => 'c',
            'l' => 'c',
            'm' => 'c',
            'n' => 'c',
            'o' => 'c',
            'p' => 'c',
            'q' => 'c',
            'r' => 'c',
            's' => 'c',
        ];
        $this->expectException(ParseError::class);
        $this->generateSignatureTrait->generateSignatureWithShortcuts($arrayRulesTooMany, $this->commandName);

    }



}
