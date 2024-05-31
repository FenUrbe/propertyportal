<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CheckPageTest extends DuskTestCase
{
    public function testRegisterPage(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    /* ->resize(1024, 800) */ 
                    /* ->resize(800, 1200)  */
                    ->resize(320, 600)
                    ->waitForLocation('/register', 10)
                    ->assertSee('Register')
                    ->type('name', 'Penn Urbe')
                    ->type('email', 'penn1.urbe@gmail.com')
                    ->type('password', 'l0s9@ndc*4sY')
                    ->type('password_confirmation', 'l0s9@ndc*4sY')
                    ->select('user_type', '3')
                    ->screenshot('register320')
                    ->press('Register')
                    ->waitForLocation('/user', 20)
                    ->assertPathIs('/user')
                    ->assertSee('User');
                });
    }

    public function testLoginPage(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    /* ->resize(1024, 800)  */
                    /* ->resize(800, 1200)  */
                    ->resize(320, 600)
                    ->waitForLocation('/login', 10)
                    ->assertSee('Log-in')
                    ->type('email', 'penn.bedandgo@gmail.com')
                    ->type('password', '12345678')
                    ->screenshot('login320')
                    ->press('Log-in')
                    ->waitForLocation('/user', 20)
                    ->assertPathIs('/user')
                    ->assertSee('User');
        });
    }

    public function testHomePage(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/user')
                    /* ->resize(1024, 800)  */
                    /* ->resize(800, 1200)  */
                    ->resize(320, 600)
                    ->assertSee('User')
                    ->screenshot('user320');
        });
    }
}
