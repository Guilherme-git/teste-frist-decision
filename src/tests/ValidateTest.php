<?php

namespace src\tests;
use PHPUnit\Framework\TestCase;
use src\utils\Validate;

require_once __DIR__."/../utils/Validate.php";

class ValidateTest extends TestCase
{
    public function test_empty_inputs()
    {
        $validate = new Validate();
        $this->assertEquals($validate->emptyInputs("joao","joaosilva@gmail.com","123") , true);
    }

    public function test_validate_name()
    {
        $validate = new Validate();
        $this->assertEquals($validate->validateName("joaosilva@gmail.com") , true);
    }

    public function test_validate_password()
    {
        $validate = new Validate();
        $this->assertEquals($validate->validatePassword("123456") , true);
    }

    public function test_equals_password()
    {
        $validate = new Validate();
        $this->assertEquals($validate->equalsPassword("123456","123456") , true);
    }

    public function test_validate_email()
    {
        $validate = new Validate();
        $this->assertEquals($validate->validateEmail("joaodasilva@gmail.com") , true);
    }


}