<x-layout>
    <x-setting heading="Admin Page" route="admin">
        @if($var!='index')
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-200 ">
                @if($var == 'posts')
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Title
                        </th>

                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Delete
                        </th>
                    </tr>

                @elseif($var=='users')
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Name
                        </th>

                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Username
                        </th>

                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Email
                        </th>

                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Delete
                        </th>
                    </tr>

                @elseif($var=='comments')
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Comment
                        </th>

                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Author
                        </th>

                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Delete
                        </th>
                    </tr>

                @else

                @endif

                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach($items as $item)
                    @if($var == 'posts')
                        <tr>
                            <td class="px-6 py-4">
                                <a class="text-s" href="/posts/{{$item->slug}}">
                                    {{ $item->title}}
                                </a>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">

                                <form action="{{route('admin.posts.destroy',$item->id)}}" method="POST">

                                    @csrf
                                    @method('DELETE')
                                    <button class="text-s text-red-400" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @elseif($var=='users')
                        <tr>
                            <td class="px-6 py-4">
                                {{ $item->name}}
                            </td>

                            <td class="px-6 py-4">
                                <a class="text-s" href="/authors/{{$item->username}}">
                                    {{ $item->username}}
                                </a>
                            </td>

                            <td class="px-6 py-4">
                                {{ $item->email}}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <form action="{{route('admin.users.destroy',$item->id)}}" method="POST">

                                    @csrf
                                    @method('DELETE')
                                    <button class="text-s text-red-400" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>

                    @elseif($var=='comments')
                        <tr>
                            <td class="px-6 py-4">
                                <a class="text-s" href="/posts/{{$item->post->slug}}">
                                    {{ $item->body}}
                                </a>
                            </td>

                            <td class="px-6 py-4">
                                <a class="text-s" href="/authors/{{$item->author->username}}">
                                    {{ $item->author->username}}
                                </a>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <form action="{{route('admin.comments.destroy',$item)}}" method="POST">

                                    @csrf
                                    @method('DELETE')
                                    <button class="text-s text-red-400" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @else

                    @endif
                @endforeach

                </tbody>
            </table>
        @else

        @endif
        <div class="mt-8 flex flex-col">
        </div>
    </x-setting>
</x-layout>
