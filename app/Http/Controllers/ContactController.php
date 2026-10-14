<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Mail\ContactFormMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(ContactFormRequest $request) : RedirectResponse|JsonResponse
    {
        $messageData = $request->safe()->only(['name', 'email', 'message']);
        $status = __('site.contact.success');

        Mail::to('slunecny.svah@gmail.com')->send(new ContactFormMessage($messageData));

        if ($request->expectsJson()) {
            return response()->json([
                'message' => $status,
            ]);
        }

        return back()
            ->withFragment('kontakty')
            ->with('contact_status', $status);
    }
}
