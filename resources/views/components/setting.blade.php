@props(['heading','route'=>'admin'])
<section class="py-8 max-w-4xl mx-auto">
    <h1 class="text-lg font-bold mb-8 pb-2 border-b">
        {{$heading}}
    </h1>

    <div class="flex">
        <aside class="w-48">
            <h4 class="font-semibold mb-4">Links</h4>

            <ul>
                <li>
                    <a class="{{request()->is($route.'/posts')?'text-blue-500':''}}"
                       href="/{{$route}}/posts"
                    >
                        All Posts
                    </a>
                </li>

                <li>
                    <a class="{{request()->is($route.'/posts/create')?'text-blue-500':''}}"
                       href="/{{$route}}/posts/create"
                    >
                        New Post
                    </a>
                </li>
            </ul>
        </aside>

        <main class="flex-1">
            <x-panel>
                {{$slot}}
            </x-panel>
        </main>
    </div>
</section>
