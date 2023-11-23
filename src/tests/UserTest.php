<?php

namespace src\tests;

use PHPUnit\Framework\TestCase;
use src\User;

require_once __DIR__."/../User.php";

class UserTest extends TestCase
{
    public function test_verify_empty()
    {
        $user = new User();
        $user->setName("Joao");
        $user->setEmail("joaosilva@gmail.com");
        $user->setPassword("123123");
        $this->assertEquals($user->verifyEmpty() , true);
    }

    public function test_save()
    {
        $user = new User();
        $user->setName("Joao");
        $user->setEmail("joaosilva@gmail.com");
        $user->setPassword("123123");
        $this->assertEquals($user->save(),1);
    }

    public function test_get_all()
    {
        $user = new User();
        $this->assertIsArray($user->getAll());
    }

    public function test_delete()
    {
        $user = new User();
        $user->setId(19);
        $this->assertEquals($user->delete(),1);
    }

    public function test_edit()
    {
        $user = new User();
        $user->setId(28);
        $user->setName("Joao");
        $user->setEmail("joao@gmail.com");
        $user->setPassword("123123eee");
        $this->assertEquals($user->edit(),1);
    }
}