<x-panel>
    @auth
    <form method="POST" action="/posts/{{$post->slug}}/comments">
        @csrf
        <header class="flex items-center">
            <img src="https://i.pravatar.cc/60?u={{auth()->id()}}" alt="" width="40" height="40" class="rounded-full">
            <h2 class="ml-4">Want to participate?</h2>
        </header>

        <div class="mt-6">
            <textarea name="body" id="body" cols="30" rows="5" class="w-full text-sm focus:outline-none focus:ring" placeholder="Quick, thing of something to say!"></textarea>
            <x-form.error name="body" />
        </div>

        <div class="flex justify-end mt-1">
            <x-form.button>POST</x-form.button>
        </div>
    </form>
    @else
    <div class="flex flex-col items-center">
        <h2 class="py-2 px-2">Want to participate?</h2>

        <div class="mt-5 flex space-x-8">
            <a href="/login">
                <x-form.button>Log in</x-form.button>
            </a>

            <a href="/register">
                <x-form.button>Register</x-form.button>
            </a>
        </div>
    </div>
    @endauth
</x-panel>