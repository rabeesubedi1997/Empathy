<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Patient;

class PatientSeeder extends Seeder
{
    public function run(): void
    {
        $patients = [
            ['name' => 'Elena Vasquez',    'age' => 34, 'sex' => 'Female',     'address' => '142 Marigold Lane, Buenos Aires, Argentina',    'email' => 'elena.vasquez@email.com',  'diagnosis' => 'Generalized Anxiety Disorder',        'empathy_score' => 87, 'mood_state' => 'Calm'],
            ['name' => 'Marcus Chen',      'age' => 28, 'sex' => 'Male',       'address' => '77 Harbor View Dr, San Francisco, CA 94105',   'email' => 'marcus.chen@email.com',    'diagnosis' => 'Major Depressive Disorder',           'empathy_score' => 42, 'mood_state' => 'Melancholic'],
            ['name' => 'Sofia Okafor',     'age' => 45, 'sex' => 'Female',     'address' => '23 Acacia Street, Lagos, Nigeria',              'email' => 'sofia.okafor@email.com',   'diagnosis' => 'Post-Traumatic Stress Disorder',      'empathy_score' => 31, 'mood_state' => 'Anxious'],
            ['name' => 'James Whitfield',  'age' => 52, 'sex' => 'Male',       'address' => '891 Elm Grove, London, UK EC1A 1BB',            'email' => 'j.whitfield@email.com',    'diagnosis' => 'Bipolar Disorder',                    'empathy_score' => 63, 'mood_state' => 'Neutral'],
            ['name' => 'Amara Patel',      'age' => 22, 'sex' => 'Non-binary', 'address' => '15 Lotus Gardens, Mumbai, India 400001',        'email' => 'amara.patel@email.com',    'diagnosis' => 'Social Anxiety Disorder',             'empathy_score' => 78, 'mood_state' => 'Joyful'],
            ['name' => 'David Kowalski',   'age' => 39, 'sex' => 'Male',       'address' => '56 Maple Street, Warsaw, Poland',               'email' => 'dkowalski@email.com',      'diagnosis' => 'Obsessive-Compulsive Disorder',       'empathy_score' => 55, 'mood_state' => 'Distressed'],
            ['name' => 'Yuki Tanaka',      'age' => 31, 'sex' => 'Female',     'address' => '3-14 Shinjuku, Tokyo, Japan 160-0022',          'email' => 'yuki.tanaka@email.com',    'diagnosis' => 'Autism Spectrum Disorder',            'empathy_score' => 91, 'mood_state' => 'Calm'],
            ['name' => 'Carlos Mendez',    'age' => 47, 'sex' => 'Male',       'address' => '78 Calle Real, Mexico City, Mexico',            'email' => 'carlos.m@email.com',       'diagnosis' => 'Borderline Personality Disorder',     'empathy_score' => 38, 'mood_state' => 'Anxious'],
            ['name' => 'Fatima Al-Hassan', 'age' => 26, 'sex' => 'Female',     'address' => '22 Palm Road, Riyadh, Saudi Arabia',            'email' => 'fatima.ah@email.com',      'diagnosis' => 'Generalized Anxiety Disorder',        'empathy_score' => 72, 'mood_state' => 'Calm'],
            ['name' => 'Noah Fischer',     'age' => 58, 'sex' => 'Male',       'address' => '9 Bergstrasse, Berlin, Germany 10115',          'email' => 'n.fischer@email.com',      'diagnosis' => 'Major Depressive Disorder',           'empathy_score' => 25, 'mood_state' => 'Melancholic'],
            ['name' => 'Priya Sharma',     'age' => 33, 'sex' => 'Female',     'address' => '104 Connaught Place, New Delhi, India 110001',  'email' => 'priya.s@email.com',        'diagnosis' => 'Post-Traumatic Stress Disorder',      'empathy_score' => 80, 'mood_state' => 'Joyful'],
            ['name' => 'Antoine Dubois',   'age' => 41, 'sex' => 'Male',       'address' => '12 Rue de la Paix, Paris, France 75002',        'email' => 'a.dubois@email.com',       'diagnosis' => 'Social Anxiety Disorder',             'empathy_score' => 59, 'mood_state' => 'Neutral'],
            ['name' => 'Lena Petrov',      'age' => 29, 'sex' => 'Female',     'address' => '34 Nevsky Prospect, St. Petersburg, Russia',    'email' => 'lena.petrov@email.com',    'diagnosis' => 'Bipolar Disorder',                    'empathy_score' => 66, 'mood_state' => 'Anxious'],
            ['name' => 'Kwame Asante',     'age' => 36, 'sex' => 'Male',       'address' => '8 Independence Ave, Accra, Ghana',              'email' => 'kwame.a@email.com',        'diagnosis' => 'Autism Spectrum Disorder',            'empathy_score' => 93, 'mood_state' => 'Joyful'],
            ['name' => 'Isabella Romano',  'age' => 44, 'sex' => 'Female',     'address' => '67 Via Veneto, Rome, Italy 00187',              'email' => 'i.romano@email.com',       'diagnosis' => 'Obsessive-Compulsive Disorder',       'empathy_score' => 48, 'mood_state' => 'Distressed'],
            ['name' => 'Raj Nair',         'age' => 55, 'sex' => 'Male',       'address' => '200 MG Road, Bangalore, India 560001',          'email' => 'raj.nair@email.com',       'diagnosis' => 'Generalized Anxiety Disorder',        'empathy_score' => 74, 'mood_state' => 'Calm'],
            ['name' => 'Mei Lin',          'age' => 27, 'sex' => 'Female',     'address' => '5 Zhongshan Road, Shanghai, China 200001',      'email' => 'mei.lin@email.com',        'diagnosis' => 'Social Anxiety Disorder',             'empathy_score' => 83, 'mood_state' => 'Joyful'],
            ['name' => 'Omar Farouk',      'age' => 62, 'sex' => 'Male',       'address' => '45 Nile Corniche, Cairo, Egypt',                'email' => 'omar.f@email.com',         'diagnosis' => 'Major Depressive Disorder',           'empathy_score' => 19, 'mood_state' => 'Melancholic'],
        ];

        foreach ($patients as $data) {
            $trend = [];
            $base  = $data['empathy_score'];
            for ($i = 0; $i < 12; $i++) {
                $base    += rand(-8, 10);
                $base     = max(10, min(100, $base));
                $trend[]  = $base;
            }
            Patient::create(array_merge($data, ['empathy_trend' => json_encode($trend), 'notes' => null]));
        }
    }
}