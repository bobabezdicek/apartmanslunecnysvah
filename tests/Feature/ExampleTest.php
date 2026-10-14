<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response
            ->assertStatus(200)
            ->assertSee(route('cookies'));
    }

    public function test_localized_homepages_return_expected_languages(): void
    {
        $this->get('/cs')
            ->assertStatus(200)
            ->assertSee('Rezervovat pobyt')
            ->assertSee('/cs/cookies');

        $this->get('/en')
            ->assertStatus(200)
            ->assertSee('Book your stay')
            ->assertSee('/en/cookies');
    }

    public function test_admin_subdomain_returns_admin_page(): void
    {
        config(['app.admin_domain' => 'admin.nakladal.test']);

        $this->get('http://admin.nakladal.test/')
            ->assertStatus(200)
            ->assertSee('Admin část je připravená.')
            ->assertSee('admin.nakladal.test');
    }

    public function test_admin_subdomain_returns_dashboard_page(): void
    {
        config(['app.admin_domain' => 'admin.nakladal.test']);

        $this->get('http://admin.nakladal.test/dashboard')
            ->assertStatus(200)
            ->assertSee('Dashboard')
            ->assertSee('/dashboard');
    }

    public function test_admin_subdomain_returns_content_management_pages(): void
    {
        config(['app.admin_domain' => 'admin.nakladal.test']);

        $this->get('http://admin.nakladal.test/texts')
            ->assertStatus(200)
            ->assertSee('Texty a překlady')
            ->assertSee('hero.title')
            ->assertSee('Modern mountain apartment');

        $this->get('http://admin.nakladal.test/media')
            ->assertStatus(200)
            ->assertSee('Obrázky a pořadí')
            ->assertSee('Hero fotka')
            ->assertSee('storage/lovable/01-exterior-summer-hero.jpg');
    }

    public function test_legal_pages_return_successful_responses(): void
    {
        $this->get(route('cookies'))
            ->assertStatus(200)
            ->assertSee('Web Mountain Apartment Slunečný Svah používá soubory cookies');

        $this->get(route('localized.cookies', ['locale' => 'en']))
            ->assertStatus(200)
            ->assertSee('Effective from: 28 June 2026');
    }
}
