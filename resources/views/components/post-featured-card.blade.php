<article
    class="transition-colors duration-300 hover:bg-gray-100 border border-black border-opacity-0 hover:border-opacity-5 rounded-xl">
    <div class="py-6 px-5 lg:flex">
        <div class="flex-1 lg:mr-8">
            <img
                src="{{$post->getImagePath()}}"
                alt="Blog Post illustration" class="rounded-xl">
        </div>
        {{--TODO--}}
        <div class="flex-1 flex flex-col justify-between">
            <header class="mt-8 lg:mt-0">
                <div class="space-x-2">
                    <x-category-button :category="$post->category"/>
                </div>

                <div class="mt-4">
                    <h1 class="text-3xl">
                        <a href="/posts/{{$post->slug}}">{{$post->title}}</a>
                    </h1>

                    <span class="mt-2 block text-gray-400 text-xs">
                                        Published <time>{{$post->created_at->diffForHumans()}}</time>
                                    </span>
                </div>
            </header>

            <div class="text-sm mt-2 space-y-4">
                <p>
                    {!! $post->excerpt !!}
                </p>
            </div>

            <footer class="flex justify-between items-center mt-8">
                <x-card.authorprofile :post="$post"/>
                <x-card.readmore :post="$post"/>
            </footer>
        </div>
    </div>
</article>
