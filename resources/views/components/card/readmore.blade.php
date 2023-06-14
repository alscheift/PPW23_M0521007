@props(['post'])
<div class="lg:block">
    <a href="/posts/{{$post->slug}}"
       class="transition-colors duration-300 text-xs font-semibold bg-gray-200 hover:bg-gray-300 rounded-full py-2 px-8"
    >Read More</a>
</div>
