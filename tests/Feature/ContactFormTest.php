<?php

namespace Tests\Feature;

use App\Mail\ContactFormMessage;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    public function test_contact_form_sends_email_to_configured_recipient(): void
    {
        Mail::fake();

        $response = $this->post(route('contact.store'), [
            'name' => 'Bohumil Bezdicek',
            'email' => 'bohumil@example.test',
            'message' => 'Dobrý den, mám zájem o rezervaci apartmánu.',
            'website' => '',
        ]);

        $response
            ->assertRedirect()
            ->assertSessionHasNoErrors()
            ->assertSessionHas('contact_status');

        Mail::assertSent(ContactFormMessage::class, function (ContactFormMessage $mail) {
            return $mail->hasTo('slunecny.svah@gmail.com')
                && $mail->messageData['name'] === 'Bohumil Bezdicek'
                && $mail->messageData['email'] === 'bohumil@example.test';
        });
    }

    public function test_contact_form_requires_valid_input(): void
    {
        Mail::fake();

        $response = $this->from('/#kontakty')->post(route('contact.store'), [
            'name' => '',
            'email' => 'neni-email',
            'message' => 'kratke',
            'website' => '',
        ]);

        $response
            ->assertRedirect('/#kontakty')
            ->assertSessionHasErrors(['name', 'email', 'message']);

        Mail::assertNothingSent();
    }

    public function test_contact_form_rejects_honeypot_field(): void
    {
        Mail::fake();

        $response = $this->from('/#kontakty')->post(route('contact.store'), [
            'name' => 'Spam Bot',
            'email' => 'spam@example.test',
            'message' => 'Tahle zpráva by neměla projít přes honeypot.',
            'website' => 'https://spam.example',
        ]);

        $response
            ->assertRedirect('/#kontakty')
            ->assertSessionHasErrors(['website']);

        Mail::assertNothingSent();
    }

    public function test_contact_form_can_be_submitted_as_json_without_redirect(): void
    {
        Mail::fake();

        $response = $this->postJson(route('contact.store'), [
            'name' => 'Bohumil Bezdicek',
            'email' => 'bohumil@example.test',
            'message' => 'Dobrý den, posílám zprávu bez refreshnutí stránky.',
            'website' => '',
        ]);

        $response
            ->assertOk()
            ->assertJsonPath('message', 'Děkujeme, zpráva byla odeslána. Ozveme se Vám co nejdříve.');

        Mail::assertSent(ContactFormMessage::class, function (ContactFormMessage $mail) {
            return $mail->hasTo('slunecny.svah@gmail.com');
        });
    }

    public function test_english_contact_form_returns_english_json_response(): void
    {
        Mail::fake();

        $response = $this->postJson(route('localized.contact.store', ['locale' => 'en']), [
            'name' => 'John Smith',
            'email' => 'john@example.test',
            'message' => 'Hello, I would like to ask about apartment availability.',
            'website' => '',
        ]);

        $response
            ->assertOk()
            ->assertJsonPath('message', 'Thank you, your message has been sent. We will get back to you as soon as possible.');

        Mail::assertSent(ContactFormMessage::class, function (ContactFormMessage $mail) {
            return $mail->hasTo('slunecny.svah@gmail.com');
        });
    }

    public function test_contact_form_returns_json_validation_errors(): void
    {
        Mail::fake();

        $response = $this
            ->withHeaders([
                'Accept' => 'application/json',
                'X-Requested-With' => 'XMLHttpRequest',
            ])
            ->post(route('contact.store'), [
                'name' => '',
                'email' => 'neni-email',
                'message' => 'kratke',
                'website' => '',
            ]);

        $response
            ->assertUnprocessable()
            ->assertJsonStructure([
                'message',
                'errors' => [
                    'name',
                    'email',
                    'message',
                ],
            ]);

        Mail::assertNothingSent();
    }
}
