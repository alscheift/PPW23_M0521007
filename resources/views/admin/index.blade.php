<x-layout>
    <x-setting heading="Admin Page" route="admin">
        <table class="min-w-full divide-y divide-gray-200">
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
                            <a class="text-s text-blue-400" href="/user/posts/{{$item->slug}}/edit">
                                Edit
                            </a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form action="/user/posts/{{$item->slug}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="text-s text-red-400" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @elseif($var=='users')

                @elseif($var=='comments')
                @else

                @endif
            @endforeach

            </tbody>
        </table>
        <div class="mt-8 flex flex-col">
        </div>
    </x-setting>
</x-layout>
