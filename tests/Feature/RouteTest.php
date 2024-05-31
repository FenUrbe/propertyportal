<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class RouteTest extends TestCase
{
    public function test_welcome_page(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_user_index_page(): void
    {
        $response = $this->get('/user');

        $response->assertStatus(200);
    }

    public function test_user_register_page(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_user_save_info(): void
    {
        $response = $this->post('/register');

        $response->assertStatus(302);
    }

    /* public function test_verify_email(): void
    {
        $response = $this->get('/verify/6/6dab68e13b204d629575fb81a36b884708975e71');

        $response->assertStatus(200);
    } */

    public function test_user_login_page(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_user_check_info(): void
    {
        $response = $this->post('/login');

        $response->assertStatus(302);
    }

    public function test_user_logout(): void
    {
        $response = $this->post('/logout');

        $response->assertStatus(302);
    }

    public function test_forgot_password_page(): void
    {
        $response = $this->get('/forgot-password');

        $response->assertStatus(200);
    }

    public function test_send_password_link(): void
    {
        $response = $this->post('/forgot-password');

        $response->assertStatus(302);
    }

    public function test_show_reset_form(): void
    {
        $response = $this->get('/reset-password/token123');

        $response->assertStatus(200);
    }

    public function test_reset_password(): void
    {
        $response = $this->post('/reset-password');

        $response->assertStatus(302);
    }

    public function test_google_login_redirect(): void
    {
        $response = $this->get('auth/google');

        $response->assertStatus(302);
    }

    /* public function test_google_callback(): void
    {
        $response = $this->get('auth/google/call-back');

        $response->assertStatus(200);
    } */
}
