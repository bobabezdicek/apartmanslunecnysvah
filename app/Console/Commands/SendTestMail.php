<?php

namespace App\Console\Commands;

use App\Mail\ContactFormMessage;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Throwable;

class SendTestMail extends Command
{
    protected $signature = 'mail:test {to? : Recipient address. Defaults to MAIL_FROM_ADDRESS.}';

    protected $description = 'Send a test message through the configured mailer.';

    public function handle(): int
    {
        $recipient = $this->argument('to') ?: config('mail.from.address');
        $password = (string) config('mail.mailers.smtp.password');

        $this->components->info('Testing mail delivery...');
        $this->line('Mailer: '.config('mail.default'));
        $this->line('Host: '.config('mail.mailers.smtp.host').':'.config('mail.mailers.smtp.port'));
        $this->line('Username: '.config('mail.mailers.smtp.username'));
        $this->line('From: '.config('mail.from.address'));
        $this->line('To: '.$recipient);

        if (config('mail.default') === 'smtp' && $password === '') {
            $this->components->error('MAIL_PASSWORD is empty. Gmail requires an app password.');

            return self::FAILURE;
        }

        try {
            Mail::to($recipient)->send(new ContactFormMessage([
                'name' => 'Slunečný Svah test',
                'email' => (string) config('mail.from.address'),
                'message' => 'Testovací zpráva z Laravelu. Pokud dorazila, SMTP konfigurace funguje.',
            ]));
        } catch (Throwable $exception) {
            $this->components->error('The test message could not be sent.');
            $this->line($exception->getMessage());

            return self::FAILURE;
        }

        $this->components->info('The test message was sent.');

        return self::SUCCESS;
    }
}
