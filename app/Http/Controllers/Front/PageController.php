<?php

declare(strict_types=1);

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

final class PageController extends Controller
{
    public function service(): View
    {
        return view('front.pages.service');
    }

    public function delivery(): View
    {
        return view('front.pages.delivery');
    }

    public function warranty(): View
    {
        return view('front.pages.warranty');
    }

    public function about(): View
    {
        return view('front.pages.about');
    }

    public function faq(): View
    {
        return view('front.pages.faq');
    }

    public function terms(): View
    {
        return view('front.pages.terms');
    }

    public function privacyPolicy(): View
    {
        return view('front.pages.privacy-policy');
    }
}
