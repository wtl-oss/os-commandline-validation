<?php


namespace Tests\Unit;

use Illuminate\Contracts\Validation\Validator as ValidationContract;
use Illuminate\Validation\ValidationException;
use Wtl\CommandLineValidation\AbstractConsoleValidator;
use PHPUnit\Framework\TestCase;


class ConsoleRequestTest extends TestCase
{
    private array $userInput;

    protected function setUp(): void //called before each test
    {
        $this->userInput = ['title' => 'ms', 'first_name' => 'jonas'];
    }
    /**
     * @test
     * @covers AbstractConsoleValidator::rules
     * @dataProvider rulesDataProvider
     */
    public function rulesCanBeSet(array $rules):void
    {
        $expected = ['ms' => 'max:30', 'first_name' => 'max:40'];
        $mockConsoleRequest = $this->getMockForAbstractClass(AbstractConsoleValidator::class);
        $mockConsoleRequest->expects($this->any())
            ->method('rules')
            ->willReturn($rules);
        self::assertEquals($expected, $mockConsoleRequest->rules());
    }

    public static function rulesDataProvider(): array
    {
        return [
            [['ms' => 'max:30', 'first_name' => 'max:40']] //1 array zelle= array $rules
        ];
    }

    /**
     * @test
     * @covers AbstractConsoleValidator::executeValidation
     * @throws ValidationException
     */
    public function executeValidationCorrect():void
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

        $mockConsoleRequest = $this->getMockForAbstractClass(
            AbstractConsoleValidator::class,
            [],
            '',
            true,
            true,
            true,
            ['createValidator'],
            false
        );

        $mockConsoleRequest->expects($this->any())
            ->method('createValidator')
            ->willReturn($validatorMock);

        $this->AssertTrue(
            $mockConsoleRequest->executeValidation(false, $this->userInput)
        );
    }

    /**
     * @test
     * @covers AbstractConsoleValidator::executeValidation
     * @throws ValidationException
     */
    public function executeValidationFalseWithException():void
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

        $mockConsoleRequest = $this->getMockForAbstractClass(
            AbstractConsoleValidator::class,
            [],
            '',
            true,
            true,
            true,
            ['getErrorsFormatted', 'createValidator'],
            false
        );

        $mockConsoleRequest->expects($this->any())
            ->method('createValidator')
            ->willReturn($validatorMock);

        $mockConsoleRequest->expects($this->any())
            ->method('getErrorsFormatted')
            ->with($validatorMock)
            ->willReturn('error message');

        $this->assertFalse(
            $mockConsoleRequest->executeValidation(false, $this->userInput)
        );
    }
    /**
     * @test
     * @covers AbstractConsoleValidator::executeValidation
     * @throws ValidationException
     */
    public function executeValidationWithThrowExceptionEnabled():void
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



        $mockConsoleRequest = $this->getMockForAbstractClass(
            AbstractConsoleValidator::class,
            [],
            '',
            true,
            true,
            true,
            ['getErrorsFormatted', 'createValidator'],
            false
        );

        $mockConsoleRequest->expects($this->any())
            ->method('createValidator')
            ->willReturn($validatorMock);

        $mockConsoleRequest->expects($this->any())
            ->method('getErrorsFormatted')
            ->with($validatorMock)
            ->willReturn('error message');

        $this->expectException(ValidationException::class);
        $mockConsoleRequest->executeValidation(true, $this->userInput);
    }

    /**
     * @test
     * @covers AbstractConsoleValidator::customAttributes
     */
    public function customAttributesReturnsEmptyString():void
    {
        $mockConsoleRequest = $this->getMockForAbstractClass(
            AbstractConsoleValidator::class
        );

        $this->assertEmpty(
            $mockConsoleRequest->customAttributes()
        );
    }

    /**
     * @test
     * @covers AbstractConsoleValidator::messages
     */
    public function messagesReturnsEmptyString():void
    {
        $mockConsoleRequest = $this->getMockForAbstractClass(
            AbstractConsoleValidator::class
        );

        $this->assertEmpty(
            $mockConsoleRequest->messages()
        );
    }




}