<x-layout>
    <x-setting heading="My Posts" route="user">
        <table class="min-w-full divide-y divide-gray-200">
            @if($posts->count())
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach($posts as $post)
                    <tr>
                        <td class="px-6 py-4">
                            <a class="text-s" href="/posts/{{$post->slug}}">
                                {{ $post->title}}
                            </a>
                        </td>
                        @can('userownpost',$post)
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a class="text-s text-blue-400" href="/user/posts/{{$post->slug}}/edit">
                                    Edit
                                </a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <form action="/user/posts/{{$post->slug}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-s text-red-400" type="submit">Delete</button>
                                </form>
                            </td>
                    </tr>
                    @endcan
                @endforeach
                <!-- Additional rows go here -->
                </tbody>
            @endif
        </table>
        <div class="mt-8 flex flex-col">
            {{$posts->links()}}
        </div>
    </x-setting>
</x-layout>
