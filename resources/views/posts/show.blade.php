<x-layout content="content">
    <section class="px-6 py-8">
        <main class="max-w-6xl mx-auto mt-10 lg:mt-20 space-y-6">
            <article class="max-w-4xl mx-auto lg:grid lg:grid-cols-12 gap-x-10">
                <div class="col-span-4 lg:text-center lg:pt-14 mb-10">
                    <img
                        src="{{$post->getImagePath()}}"
                        alt="" class="rounded-xl">

                    <p class="mt-4 block text-gray-400 text-xs">
                        Published
                        <time>{{$post->created_at->diffForHumans()}}</time>
                    </p>

                    <div class="flex items-center lg:justify-center text-sm mt-4">
                        @isset($post->author)
                            <img src="https://i.pravatar.cc/60?u={{$post->author->id}}" alt="User Avatar"
                                 class="rounded-xl">
                        @endisset
                        <div class="ml-3 text-left">
                            <h5 class="font-bold">
                                @isset($post->author)
                                    <a href="/authors/{{$post->author->username}}">{{$post->author->name}}</a>
                                @else
                                    <p class="font-bold text-red-500">User does not exist</p>
                                @endisset
                            </h5>
                        </div>
                    </div>
                    <div class="flex justify-between  mt-4">
                        @canany(['admin','userownpost'],$post)
                            <div class="px-6 py-4 whitespace-nowrap ">
                                <a href="/user/posts/{{$post->slug}}/edit">
                                    <button
                                        class="
                                        @cannot('userownpost', $post)
                                            text-gray-400 hover:text-white hover:bg-gray-500 cursor-not-allowed
                                        @else
                                            text-blue-400 hover:text-white hover:bg-blue-400
                                        @endcannot
                                             text-s py-1 px-4 rounded-xl  transition ease-in-out duration-150"
                                    >
                                        Edit Post
                                    </button>
                                </a>
                            </div>
                            <div class="px-6 py-4 whitespace-nowrap">
                                <form action="/user/posts/{{$post->slug}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-block text-red-500 hover:text-white hover:bg-red-400 text-white text-s py-1 px-4 rounded-xl hover:bg-red-600 transition ease-in-out duration-150">
                                        Delete Post
                                    </button>
                                </form>
                            </div>
                        @endcan

                    </div>
                </div>

                <div class="col-span-8">
                    <div class="hidden lg:flex justify-between mb-6">
                        <a href="/"
                           class="transition-colors duration-300 relative inline-flex items-center text-lg hover:text-blue-500">
                            <svg width="22" height="22" viewBox="0 0 22 22" class="mr-2">
                                <g fill="none" fill-rule="evenodd">
                                    <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
                                    </path>
                                    <path class="fill-current"
                                          d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z">
                                    </path>
                                </g>
                            </svg>

                            Back to Posts
                        </a>

                        <div class="space-x-2">
                            <x-category-button :category="$post->category"/>
                        </div>
                    </div>

                    <h1 class="font-bold text-3xl lg:text-4xl mb-10">
                        {{$post->title}}
                    </h1>

                    <div class="space-y-4 lg:text-lg leading-loose">
                        <p>
                            {!! $post->body !!}
                        </p>
                    </div>
                </div>

                <section class="col-span-8 col-start-5 mt-10 space-y-6">


                    @include('posts._add-comment-form')

                    @foreach($post->comments->sortByDesc('created_at') as $comment)
                        <x-post-comment :comment="$comment"/>
                    @endforeach
                </section>
            </article>
        </main>
    </section>
</x-layout>
