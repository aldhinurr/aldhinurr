<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class AnggaranTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function testCanAccessAnggaran()
    {
        $user = User::role('superadmin')->get()->random();
        $this->actingAs($user);
        $this->get('/anggaran')
            ->assertStatus(200);
    }

    public function testCannotAccessAnggaran()
    {
        $user = User::role('admin')->get()->random();
        $this->actingAs($user);
        $this->get('/anggaran')
            ->assertStatus(403);
    }

    public function testNotLoginAccessAnggaran()
    {
        $this->get('/anggaran')
            ->assertRedirect('/login-page')
            ->assertStatus(302);
    }

    public function testCanCreateAnggaran()
    {
        $user = User::role('superadmin')->get()->random();
        $this->actingAs($user);
        $this->get('/anggaran/create')
            ->assertStatus(200);
    }

    public function testCannotCreateAnggaran()
    {
        $user = User::role('admin')->get()->random();
        $this->actingAs($user);
        $this->get('/anggaran/create')
            ->assertStatus(403);
    }

    public function testNotLoginCreateAnggaran()
    {
        $this->get('/anggaran/create')
            ->assertRedirect('/login-page')
            ->assertStatus(302);
    }
}
