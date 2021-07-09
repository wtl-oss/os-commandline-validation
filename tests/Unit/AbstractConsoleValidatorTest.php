<?php


namespace Tests\Unit;

use Illuminate\Contracts\Validation\Validator as ValidationContract;
use Illuminate\Validation\ValidationException;
use Wtl\CommandLineValidation\AbstractConsoleValidator;
use PHPUnit\Framework\TestCase;


class AbstractConsoleValidatorTest extends TestCase
{
    private array $userCommandLineInput;

    protected function setUp(): void //called before each test
    {
        $this->userCommandLineInput = ['title' => 'ms', 'first_name' => 'jonas'];
    }

    /**
     * @test
     * @covers AbstractConsoleValidator::rules
     * @dataProvider rulesDataProvider
     */
    public function rulesCanBeSet(array $rules): void
    {
        $expected = ['ms' => 'max:30', 'first_name' => 'max:40'];
        $mockAbstractConsoleValidator = $this->getMockForAbstractClass(AbstractConsoleValidator::class);
        $mockAbstractConsoleValidator->expects($this->any())
            ->method('rules')
            ->willReturn($rules);
        self::assertEquals($expected, $mockAbstractConsoleValidator->rules());
    }

    public static function rulesDataProvider(): array
    {
        return [
            [['ms' => 'max:30', 'first_name' => 'max:40']]
        ];
    }

    /**
     * @test
     * @covers AbstractConsoleValidator::executeValidation
     * @throws ValidationException
     */
    public function executeValidationValidResultWithSwitchedOffException(): void
    {
        $validatorMock = $this->getMockForAbstractClass(
            ValidationContract::class,
            [],
            '',
            false,
            false,
            true,
            ['validated'],
            false
        );

        $validatorMock->expects($this->any())
            ->method('validated')
            ->willReturn(['title' => 'ms', 'first_name' => 'jonas']);

        $mockAbstractConsoleValidator = $this->getMockForAbstractClass(
            AbstractConsoleValidator::class,
            [],
            '',
            true,
            true,
            true,
            ['createValidator'],
            false
        );

        $mockAbstractConsoleValidator->expects($this->any())
            ->method('createValidator')
            ->willReturn($validatorMock);

        $this->AssertTrue(
            $mockAbstractConsoleValidator->executeValidation($this->userCommandLineInput, false)
        );
    }

    /**
     * @test
     * @covers AbstractConsoleValidator::executeValidation
     * @throws ValidationException
     */
    public function executeValidationValidResultWithEnabledException(): void
    {
        $validatorMock = $this->getMockForAbstractClass(
            ValidationContract::class,
            [],
            '',
            false,
            false,
            true,
            ['validated'],
            false
        );


        $validatorMock->expects($this->any())
            ->method('validated')
            ->willThrowException(new ValidationException($validatorMock));

        $mockAbstractConsoleValidator = $this->getMockForAbstractClass(
            AbstractConsoleValidator::class,
            [],
            '',
            true,
            true,
            true,
            ['getErrorsFormatted', 'createValidator'],
            false
        );

        $mockAbstractConsoleValidator->expects($this->any())
            ->method('createValidator')
            ->willReturn($validatorMock);

        $mockAbstractConsoleValidator->expects($this->any())
            ->method('getErrorsFormatted')
            ->with($validatorMock)
            ->willReturn('error message');

        $this->assertFalse(
            $mockAbstractConsoleValidator->executeValidation($this->userCommandLineInput, false)
        );
    }

    /**
     * @test
     * @covers AbstractConsoleValidator::executeValidation
     * @throws ValidationException
     */
    public function executeValidationNoValidResultWithEnabledExceptionThrowException(): void
    {
        $mockLaravelValidator = $this->getMockForAbstractClass(
            ValidationContract::class,
            [],
            '',
            false,
            false,
            true,
            ['validated'],
            false
        );

        $mockLaravelValidator->expects($this->any())
            ->method('validated')
            ->willThrowException(new ValidationException($mockLaravelValidator));

        $mockAbstractConsoleValidator = $this->getMockForAbstractClass(
            AbstractConsoleValidator::class,
            [],
            '',
            true,
            true,
            true,
            ['getErrorsFormatted', 'createValidator'],
            false
        );

        $mockAbstractConsoleValidator->expects($this->any())
            ->method('createValidator')
            ->willReturn($mockLaravelValidator);

        $mockAbstractConsoleValidator->expects($this->any())
            ->method('getErrorsFormatted')
            ->with($mockLaravelValidator)
            ->willReturn('error message');

        $this->expectException(ValidationException::class);
        $mockAbstractConsoleValidator->executeValidation($this->userCommandLineInput, true);
    }

    /**
     * @test
     * @covers AbstractConsoleValidator::customAttributes
     */
    public function customAttributesReturnsEmptyString(): void
    {
        $mockAbstractConsoleValidator = $this->getMockForAbstractClass(
            AbstractConsoleValidator::class
        );

        $this->assertEmpty(
            $mockAbstractConsoleValidator->customAttributes()
        );
    }

    /**
     * @test
     * @covers AbstractConsoleValidator::messages
     */
    public function messagesReturnsEmptyString(): void
    {
        $mockAbstractConsoleValidator = $this->getMockForAbstractClass(
            AbstractConsoleValidator::class
        );

        $this->assertEmpty(
            $mockAbstractConsoleValidator->messages()
        );
    }

    /**
     * @test
     * @covers AbstractConsoleValidator::getLastErrorMessages
     */
    public function getLastErrorMessagesReturnsString(): void
    {
        $lastErrorMessage =
            "The given data was invalid.
            \nThe command failed.
            \n
            \nThe email has already been taken.";

        $mockAbstractConsoleValidator = $this->getMockForAbstractClass(
            AbstractConsoleValidator::class,
            [],
            '',
            true,
            true,
            true,
            [],
            false
        );

        $this->assertEquals("", $mockAbstractConsoleValidator->getLastErrorMessages());
    }


}