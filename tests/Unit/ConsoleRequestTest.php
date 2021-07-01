<?php


namespace Tests\Unit;

use Exception;
use Illuminate\Contracts\Validation\Validator as ValidationContract;
use Illuminate\Support\Facades\Validator;
use Illuminate\Translation\Translator;
use Illuminate\Validation\ValidationException;
use PhpParser\Error;
use Wtl\CommandLineValidation\ConsoleRequest;
use PHPUnit\Framework\TestCase;
use Illuminate\Validation\Factory;


class ConsoleRequestTest extends TestCase
{
    private $userInput;

    protected function setUp(): void //called before each test
    {
        //$this->rules = ['title' => ['max:30'], 'first_name' => ['max:40']];
        $this->userInput = ['title' => 'ms', 'first_name' => 'jonas'];
    }
    /**
     * @test
     * @covers ConsoleRequest::rules
     * @dataProvider rulesDataProvider
     */
    public function rulesCanBeSet(array $rules):void
    {
        $expected = ['ms' => 'max:30', 'first_name' => 'max:40'];
        $mockConsoleRequest = $this->getMockForAbstractClass(ConsoleRequest::class);
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
     * @covers ConsoleRequest::executeValidation
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
            ConsoleRequest::class,
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
     * @covers ConsoleRequest::executeValidation
     * @throws ValidationException
     */
    public function executeValidationException():void
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
            //->will($this->throwException(new Exception));

        $mockConsoleRequest = $this->getMockForAbstractClass(
            ConsoleRequest::class,
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








}