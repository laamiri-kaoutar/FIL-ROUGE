<!-- resources/views/welcome.blade.php -->
@extends('layouts.app')

@section('title', 'Welcome to FreelanceHub')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
@endsection

@section('content')
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Hero Section -->
<section class="relative min-h-[85vh] overflow-hidden">
   <!-- Background Gradient & Shapes -->
   <div class="absolute inset-0 bg-gradient-to-br from-purple-100 to-pink-50">
       <!-- Animated Background Shapes -->
       <div class="absolute top-20 right-0 w-72 h-72 bg-gradient-to-br from-purple-500/20 to-pink-500/20 rounded-full blur-3xl animate-pulse"></div>
       <div class="absolute bottom-10 left-0 w-96 h-96 bg-gradient-to-tr from-purple-500/10 to-pink-500/10 rounded-full blur-3xl animate-pulse delay-700"></div>
   </div>

   <!-- Hero Content -->
   <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-16">
       <div class="grid lg:grid-cols-2 gap-12 items-center">
           <!-- Left Column - Text Content -->
           <div class="text-center lg:text-left">
               <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold">
                   <span class="block text-gray-900">Find the Best</span>
                   <span class="block mt-2 text-transparent bg-clip-text bg-gradient-to-r from-[#8A4FFF] to-[#FF4F8A]">
                       Freelance Talent
                   </span>
               </h1>
               <p class="mt-6 text-lg md:text-xl text-gray-600">
                   Connect with top freelancers to bring your projects to life. Design, development, writing, and more.
               </p>

               <!-- Hero Search Component (with specific classes) -->
               <div class="mt-8 max-w-2xl mx-auto lg:mx-0">
                   <div class="relative">
                       <div class="hero-search-gradient absolute -inset-0.5 rounded-lg blur opacity-30"></div>
                       <div class="relative bg-white rounded-lg shadow-sm">
                           <div class="flex items-center px-4 py-3">
                               <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                               </svg>
                               <input type="text" 
                                      placeholder="What service are you looking for?" 
                                      class="hero-search-input flex-1 ml-3 outline-none bg-transparent text-gray-900 placeholder-gray-500"/>
                               <button class="ml-4 px-6 py-2 bg-gradient-to-r from-[#8A4FFF] to-[#FF4F8A] text-white rounded-md font-medium hover:shadow-lg transition-shadow">
                                   Search
                               </button>
                           </div>
                       </div>
                   </div>

                   <!-- Popular Categories Pills -->
                   <div class="mt-4 flex flex-wrap gap-2 justify-center lg:justify-start">
                       <button class="px-4 py-1.5 rounded-full text-sm font-medium text-gray-700 bg-white shadow-sm hover:shadow transition-shadow">
                           Design & Creative
                       </button>
                       <button class="px-4 py-1.5 rounded-full text-sm font-medium text-gray-700 bg-white shadow-sm hover:shadow transition-shadow">
                           Development
                       </button>
                       <button class="px-4 py-1.5 rounded-full text-sm font-medium text-gray-700 bg-white shadow-sm hover:shadow transition-shadow">
                           Marketing
                       </button>
                       <button class="px-4 py-1.5 rounded-full text-sm font-medium text-gray-700 bg-white shadow-sm hover:shadow transition-shadow">
                           Writing
                       </button>
                   </div>
               </div>

               <!-- Trust Indicators -->
               <div class="mt-12 flex flex-wrap gap-8 justify-center lg:justify-start text-center lg:text-left">
                   <div>
                       <p class="text-2xl font-bold text-gray-900">10k+</p>
                       <p class="text-gray-600">Freelancers</p>
                   </div>
                   <div>
                       <p class="text-2xl font-bold text-gray-900">95%</p>
                       <p class="text-gray-600">Satisfaction</p>
                   </div>
                   <div>
                       <p class="text-2xl font-bold text-gray-900">24/7</p>
                       <p class="text-gray-600">Support</p>
                   </div>
               </div>
           </div>

           <!-- Right Column - Illustration -->
           <div class="hidden lg:block relative">
               <div class="relative h-[500px] w-full rounded-2xl overflow-hidden shadow-xl">
                   <!-- Placeholder image using a free stock photo URL -->
                   <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80" 
                        alt="Freelancers collaborating" 
                        class="w-full h-full object-cover"/>
                   <!-- Gradient overlay -->
                   <div class="absolute inset-0 bg-gradient-to-br from-purple-500/10 to-pink-500/10"></div>
               </div>
           </div>
       </div>
   </div>
</section>

<section class="py-16 bg-gray-50">
   <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
       <h2 class="text-4xl font-extrabold text-center text-gray-900 mb-4">Why Choose FreelanceHub</h2>
       <p class="mt-4 max-w-2xl text-xl text-gray-600 lg:mx-auto text-center">Discover the benefits of using our platform for your freelancing needs.</p>

       <div class="mt-12 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
           <div class="pt-6">
               <div class="flow-root bg-white rounded-lg px-6 pb-8 shadow-md">
                   <div class="-mt-6">
                       <div>
                           <span class="inline-flex items-center justify-center p-3 primary-gradient bg-opacity-75 rounded-full shadow-lg">
                               <svg class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                               </svg>
                           </span>
                       </div>
                       <h3 class="mt-8 text-lg font-medium text-gray-900 tracking-tight">Global Talent Pool</h3>
                       <p class="mt-5 text-base text-gray-500">Access a wide range of skilled professionals from around the world.</p>
                   </div>
               </div>
           </div>

           <div class="pt-6">
               <div class="flow-root bg-white rounded-lg px-6 pb-8 shadow-md">
                   <div class="-mt-6">
                       <div>
                           <span class="inline-flex items-center justify-center p-3 primary-gradient bg-opacity-75 rounded-full shadow-lg">
                               <svg class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                               </svg>
                           </span>
                       </div>
                       <h3 class="mt-8 text-lg font-medium text-gray-900 tracking-tight">Seamless Communication</h3>
                       <p class="mt-5 text-base text-gray-500">Collaborate effortlessly with built-in messaging and project management tools.</p>
                   </div>
               </div>
           </div>

           <div class="pt-6">
               <div class="flow-root bg-white rounded-lg px-6 pb-8 shadow-md">
                   <div class="-mt-6">
                       <div>
                           <span class="inline-flex items-center justify-center p-3 primary-gradient bg-opacity-75 rounded-full shadow-lg">
                               <svg class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                               </svg>
                           </span>
                       </div>
                       <h3 class="mt-8 text-lg font-medium text-gray-900 tracking-tight">Fast & Efficient</h3>
                       <p class="mt-5 text-base text-gray-500">Find the right freelancer quickly and get your project started in no time.</p>
                   </div>
               </div>
           </div>

           <div class="pt-6">
               <div class="flow-root bg-white rounded-lg px-6 pb-8 shadow-md">
                   <div class="-mt-6">
                       <div>
                           <span class="inline-flex items-center justify-center p-3 primary-gradient bg-opacity-75 rounded-full shadow-lg">
                               <svg class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                               </svg>
                           </span>
                       </div>
                       <h3 class="mt-8 text-lg font-medium text-gray-900 tracking-tight">Secure Payments</h3>
                       <p class="mt-5 text-base text-gray-500">Enjoy peace of mind with our secure payment system and escrow protection.</p>
                   </div>
               </div>
           </div>
       </div>
   </div>
</section>
<section class="py-16 bg-gradient-to-r from-purple-100 to-pink-100">
   <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
       <div class="text-center">
           <h2 class="text-4xl font-extrabold text-gray-900 mb-4">Popular Categories</h2>
           <p class="mt-4 max-w-2xl text-xl text-gray-600 lg:mx-auto">Explore a wide range of freelance services across various categories.</p>
       </div>

       <div class="mt-12 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
           <a href="#" class="group relative rounded-lg overflow-hidden shadow-md transition-all duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-lg">
               <div class="aspect-w-4 aspect-h-3">
                   <img class="object-cover" src="https://images.pexels.com/photos/3987020/pexels-photo-3987020.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="Design & Creative">
               </div>
               <div class="px-4 py-4 bg-white">
                   <h3 class="text-lg font-semibold text-gray-900">Design & Creative</h3>
                   <p class="mt-2 text-base text-gray-600">Bring your creative projects to life with our talented designers life with our talented designers.</p>
               </div>
           </a>

           <a href="#" class="group relative rounded-lg overflow-hidden shadow-md transition-all duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-lg">
               <div class="aspect-w-4 aspect-h-3">
                   <img class="object-cover" src="https://images.pexels.com/photos/4065876/pexels-photo-4065876.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="Development & IT">
               </div>
               <div class="px-4 py-4 bg-white">
                   <h3 class="text-lg font-semibold text-gray-900">Development & IT</h3>
                   <p class="mt-2 text-base text-gray-600">Build, code, and innovate with our expert developers and IT professionals.</p>
               </div>
           </a>

           <a href="#" class="group relative rounded-lg overflow-hidden shadow-md transition-all duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-lg">
               <div class="aspect-w-4 aspect-h-3">
                   <img class="object-cover" src="https://images.pexels.com/photos/3987020/pexels-photo-3987020.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="Marketing">
               </div>
               <div class="px-4 py-4 bg-white">
                   <h3 class="text-lg font-semibold text-gray-900">Marketing</h3>
                   <p class="mt-2 text-base text-gray-600">Reach your target audience and grow your business with our marketing experts.</p>
               </div>
           </a>

           <a href="#" class="group relative rounded-lg overflow-hidden shadow-md transition-all duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-lg">
               <div class="aspect-w-4 aspect-h-3">
                   <img class="object-cover" src="https://images.pexels.com/photos/4065876/pexels-photo-4065876.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="Writing & Translation">
               </div>
               <div class="px-4 py-4 bg-white">
                   <h3 class="text-lg font-semibold text-gray-900">Writing & Translation</h3>
                   <p class="mt-2 text-base text-gray-600">Communicate your message effectively with our skilled writers and translators.</p>
               </div>
           </a>
       </div>

       <div class="mt-8 text-center">
           <a href="#" class="inline-block px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700">
               Explore All Categories
           </a>
       </div>
   </div>
</section>

<section class="py-16">
   <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
       <div class="text-center">
           <h2 class="text-4xl font-extrabold text-gray-900 mb-4">How It Works</h2>
           <p class="mt-4 max-w-2xl text-xl text-gray-600 lg:mx-auto">Discover how easy it is to find the perfect freelancer for your project.</p>
       </div>

       <div class="mt-12 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
           <div class="flex flex-col items-center">
               <div class="w-20 h-20 flex items-center justify-center bg-gradient-to-r from-purple-600 to-pink-600 rounded-full">
                   <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                   </svg>
               </div>
               <h3 class="mt-6 text-xl font-semibold text-gray-900">1. Search for Services</h3>
               <p class="mt-2 text-base text-gray-600 text-center">Browse through our extensive catalog of services or use the search bar to find exactly what you need.</p>
           </div>

           <div class="flex flex-col items-center">
               <div class="w-20 h-20 flex items-center justify-center bg-gradient-to-r from-purple-600 to-pink-600 rounded-full">
                   <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path>
                   </svg>
               </div>
               <h3 class="mt-6 text-xl font-semibold text-gray-900">2. Contact Freelancers</h3>
               <p class="mt-2 text-base text-gray-600 text-center">Reach out to freelancers directly through our built-in messaging system to discuss your project requirements.</p>
           </div>

           <div class="flex flex-col items-center">
               <div class="w-20 h-20 flex items-center justify-center bg-gradient-to-r from-purple-600 to-pink-600 rounded-full">
                   <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                   </svg>
               </div>
               <h3 class="mt-6 text-xl font-semibold text-gray-900">3. Get Your Work Done</h3>
               <p class="mt-2 text-base text-gray-600 text-center">Collaborate with your chosen freelancer, review their work, and release payments securely through our platform.</p>
           </div>
       </div>
   </div>
</section>

<!-- Testimonials Section -->
<section class="py-12 bg-white">
   <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
       <div class="text-center">
           <h2 class="text-3xl font-extrabold text-gray-900">Testimonials</h2>
           <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">What our clients and freelancers are saying about FreelanceHub.</p>
       </div>

       <div class="mt-10 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
           <!-- Testimonial 1 -->
           <div class="bg-gray-50 rounded-lg p-6">
               <p class="text-gray-800 text-lg mb-4">"FreelanceHub has been a game-changer for our business. The quality of work has been exceptional."</p>
               <div class="flex items-center">
                   <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Client" class="w-10 h-10 rounded-full mr-4">
                   <div>
                       <p class="font-semibold text-gray-900">John Doe</p>
                       <p class="text-gray-600 text-sm">ABC Company</p>
                   </div>
               </div>
           </div>

           <!-- Testimonial 2 -->
           <div class="bg-gray-50 rounded-lg p-6">
               <p class="text-gray-800 text-lg mb-4">"As a freelancer, FreelanceHub has provided me with a steady stream of interesting projects."</p>
               <div class="flex items-center">
                   <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Freelancer" class="w-10 h-10 rounded-full mr-4">
                   <div>
                       <p class="font-semibold text-gray-900">Jane Smith</p>
                       <p class="text-gray-600 text-sm">Freelance Designer</p>
                   </div>
               </div>
           </div>

           <!-- Testimonial 3 -->
           <div class="bg-gray-50 rounded-lg p-6">
               <p class="text-gray-800 text-lg mb-4">"I've been using FreelanceHub for several months now, and I couldn't be happier."</p>
               <div class="flex items-center">
                   <img src="https://randomuser.me/api/portraits/men/76.jpg" alt="Freelancer" class="w-10 h-10 rounded-full mr-4">
                   <div>
                       <p class="font-semibold text-gray-900">Mark Johnson</p>
                       <p class="text-gray-600 text-sm">Freelance Developer</p>
                   </div>
               </div>
           </div>
       </div>
   </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-gradient-to-r from-purple-600 to-pink-600">
   <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
       <div class="text-center">
           <h2 class="text-4xl font-extrabold text-white mb-4">Join FreelanceHub Today</h2>
           <p class="mt-4 max-w-2xl text-xl text-purple-100 lg:mx-auto">Ready to take your freelancing career or project to the next level? Sign up now and unlock a world of opportunities.</p>
           <div class="mt-8 flex justify-center">
               <a href="{{ route('register') }}" class="inline-block px-8 py-4 border border-transparent text-base font-medium rounded-full text-purple-600 bg-white hover:bg-purple-50">Get Started</a>
           </div>
       </div>
   </div>
</section>



</main>
@endsection