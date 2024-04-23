<?php 

declare(strict_types=1);
use PHPUnit\Framework\TestCase;

require_once 'src/interfaces/validationRuleInterface.php';
require_once 'src/Validation.php';
require_once 'src/validationRules/ValidateEmail.php';

final class ValidationTest extends TestCase
{
    public function testValidateEmail(): void
    {

        $validationClass = new Validation();
        $validationClass->addRule(new ValidateEmail());

        $this->assertFalse($validationClass->validate('yjytjyyute'));
        $this->assertTrue($validationClass->validate('test@email.com'));
    }
}
