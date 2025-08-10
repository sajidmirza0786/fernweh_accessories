<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HomePageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('home_pages')->insert([
            'title' => 'Fernweh Premium Accessories',
            'keywords' => 'Fernweh, Premium Accessories, Laptop Bags, Backpacks, Duffle Bags, Leather Products',
            'description' => 'Fernweh Premium Accessories | Over 20 years of craftsmanship delivering premium leather accessories.',
            'favicon' => 'favicon.ico', // adjust file name if needed
            'logo' => 'logo.png', // adjust file name if needed

            // Contact Information
            'mobile' => '+91-8506959914',
            'alt_mobile' => '+91-8048778770',
            'email' => 'mohdzikrullah9810@gmail.com',
            'alt_email' => null,
            'address' => 'T222 Gali No.3, Sadar Bazar, Nawab Road, Delhi-110006',

            // About Section
            'heading' => 'About Us',
            'short_about_description' => 'Over 20 years delivering premium leather accessories with craftsmanship and innovation.',
            'long_about_description' => 'Royal Enterprises, established in 2000, is a renowned manufacturer, exporter, and supplier of laptop bags, backpacks, duffle bags, and more. We are committed to quality and design excellence, ensuring every product meets industry standards. Our dedicated quality supervisors carefully inspect each stage of production to ensure perfection and customer satisfaction.',

            // Banner Images
            'banner_image_1' => 'banner1.jpg',
            'banner_image_2' => 'banner2.jpg',
            'banner_image_3' => 'banner3.jpg',

            // Other Images
            'other_image_1' => 'about-1-570x350.jpg',
            'other_image_2' => null,

            // Section Visibility
            'show_banners' => true,
            'show_about_section' => true,
            'show_testimonials' => true,

            // Social Links
            'facebook' => 'https://www.facebook.com/share/1F3VcQX9QC/',
            'twitter' => null,
            'instagram' => 'https://www.instagram.com/fernweh_premium_accessories?igsh=NWRwMXl2Z3E1bXIy',
            'linkedin' => null,
            'youtube' => 'https://youtube.com/@fernweh-v7q?si=URR1BL_hJVUfJEt3',

            // Footer
            'footer_text' => '© ' . date('Y') . ' Fernweh Premium Accessories. All Rights Reserved.',

            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
