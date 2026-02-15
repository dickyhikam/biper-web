<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // CONTOH: Nanti ini diganti dengan: $services = Service::all();
        // Sekarang kita pakai data dummy dulu biar rapi di Controller
        $services = [
            [
                'name' => 'Biper Complete Spa',
                'price' => 'Rp 150.000',
                'image' => 'https://images.unsplash.com/photo-1574482620826-40685ca5ebd2?w=600&q=80',
                'desc' => 'Paket lengkap Baby Gym + Baby Swim (Hydrotherapy) + Baby Massage. Durasi 60 Menit.',
                'tag' => 'Best Seller',
                'tag_color' => 'green'
            ],
            [
                'name' => 'Pediatric Massage',
                'price' => 'Rp 120.000',
                'image' => 'https://images.unsplash.com/photo-1544161515-4ab6ce6db874?w=600&q=80',
                'desc' => 'Pijat khusus terapi batuk pilek (Tuina), kolik, atau susah makan.',
                'tag' => 'Home Care Ready',
                'tag_color' => 'blue'
            ],
            [
                'name' => 'Lactation Massage',
                'price' => 'Rp 175.000',
                'image' => 'https://images.unsplash.com/photo-1600093463592-8e36ae95ef56?w=600&q=80',
                'desc' => 'Pijat pelancar ASI dan perawatan payudara untuk Ibu menyusui.',
                'tag' => 'For Mom',
                'tag_color' => 'purple'
            ],
        ];

        // Kirim data $services ke view 'home'
        return view('home.index', compact('services'));
    }
}
