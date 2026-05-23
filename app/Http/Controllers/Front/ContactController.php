<?php
declare(strict_types=1);

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lead\StoreContactLeadRequest;
use App\Services\Lead\ContactLeadService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class ContactController extends Controller
{
    public function index(): View
    {
        return view('front.contact.index');
    }

    public function store(
        StoreContactLeadRequest $request,
        ContactLeadService      $leadService,
    ): RedirectResponse
    {
        $leadService->create($request->validated());

        return redirect()
            ->route('contact.index')
            ->with('success', 'Thank you! Your message has been sent successfully.');
    }
}
