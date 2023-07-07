<!doctype html>

<title>Laravel From Scratch Blog</title>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
<script src="//unpkg.com/alpinejs" defer></script>

<body style="font-family: Open Sans, sans-serif">
<section class="px-6 py-8">
    <nav class="md:flex md:justify-between md:items-center">
        <div>
            <a href="/">
                <h1 class="text-xl font-bold text-black-900">
                    <span class="text-blue-400">PPW</span> - Laravel
                </h1>
            </a>
        </div>

        <div class="mt-8 md:mt-0 flex items-center">
            @auth
                <x-dropdown>
                    <x-slot name="trigger">
                        <div
                            class="flex   text-white ml-3 text-xs font-bold bg-blue-500 uppercase hover:bg-blue-600 px-6 py-2 rounded-2xl transition ease-in-out duration-150">
                            <span class="pt-1">Welcome, {{ auth()->user()->name }}!</span>
                            <div class="align-center">
                                <x-svg-arrow
                                    class="mx-1 fill-blue-500 mt-0.5 transform -rotate-90 pointer-events-none bg-white-200"/>
                            </div>
                        </div>
                    </x-slot>
                    @can('admin')
                        <x-dropdown-item
                            href="/admin"
                            :active="request()->is('/admin')"
                        >Admin Page
                        </x-dropdown-item>
                    @endcan

                    <x-dropdown-item
                        href="/user/posts"
                        :active="request()->is('/user/posts')"
                    >My Posts
                    </x-dropdown-item>

                    <x-dropdown-item
                        href="/user/posts/create"
                        :active="request()->is('/user/posts/create')"
                    >New Post
                    </x-dropdown-item>

                    <x-dropdown-item
                        href="#"
                        x-data="{}"
                        @click.prevent="document.querySelector('#logout-form').submit()"
                    >Logout
                    </x-dropdown-item>

                    <form class="text-xs font-semibold text-blue-500 ml-6 hidden"
                          id="logout-form"
                          method="POST"
                          action="/logout"
                    >@csrf
                    </form>

                </x-dropdown>

            @else
                <div class="space-x-3">
                    <a href="/register"
                       class="text-white ml-3 text-xs font-bold bg-gray-500 uppercase hover:bg-gray-600 px-6 py-2 rounded-2xl transition ease-in-out duration-150">Register</a>
                    <a href="/login"
                       class="text-white ml-3 text-xs font-bold bg-blue-500 uppercase hover:bg-blue-600 px-6 py-2 rounded-2xl transition ease-in-out duration-150">Log
                        In</a>
                </div>
            @endauth
        </div>
    </nav>

    {{ $slot }}

</section>

<x-flash/>
</body>
