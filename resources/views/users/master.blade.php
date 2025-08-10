<!DOCTYPE html>
<html lang="en">
   <head>
      @include('users.partials.header')
      @yield('seo')
   </head>
   <body>
      @include('users.partials.top')
      @include('users.partials.navbar')
      @yield('content')
      @include('users.partials.footer')