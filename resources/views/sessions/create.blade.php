<x-layout content="content">
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10">
            <h1 class="text-center font-bold text-xl">Login !</h1>

            <form method="POST" action="/login" class="mt-10">
                @csrf

                <x-form.input labelname="Email or Username" name="email" type="input"
                              autocomplete="username"></x-form.input>
                <x-form.input name="password" type="password" autocomplete="new-password"></x-form.input>

                <x-form.button>Login</x-form.button>
            </form>
        </main>
    </section>
</x-layout>
