<?php

return [

  'profile_fields' => [
    'about',
    'date_of_birth',
    'gender',
    'title',
    'website_url',
    'facebook_url',
    'instagram_url',
    'twitter_url',
    'twitch_url',
    'youtube_url',
  ],

  'api' => [
    'auth_token_expires' 	=> 60,
    'key_token_expires'		=> 1,
  ],

  'auth' => [
    'min_password_length' => 5,
  ],

  'user_model' => \App\Models\User::class,
  'show_docs' => env('WAVE_DOCS', true),
  'demo' => env('WAVE_DEMO', false),
  'dev_bar' => env('WAVE_BAR', false),

  'paddle' => [
    'vendor' => env('PADDLE_VENDOR_ID', ''),
    'auth_code' => env('PADDLE_VENDOR_AUTH_CODE', ''),
    'env' => env('PADDLE_ENV', 'sandbox')
  ],

];
