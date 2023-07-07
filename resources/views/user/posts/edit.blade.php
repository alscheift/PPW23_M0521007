<x-layout>
    <x-setting heading="Publish New Post: {{$post->title}}" route="user">
        <form method="POST" action="/user/posts/{{$post->slug}}" enctype="multipart/form-data">
            @csrf
            @method('patch')

            <x-form.input name="title" :value="old('title',$post->title)"/>
            <x-form.input name="slug" :value="old('title',$post->slug)"/>
            <x-form.textarea name="excerpt">{{old('excerpt',$post->excerpt)}}</x-form.textarea>
            <x-form.textarea name="body">{{old('body',$post->getRawBody())}}</x-form.textarea>
            <div class="flex mt-6">
                <div class="flex-1">
                    <x-form.input name="thumbnail" type="file" :required='0'/>
                </div>
                <img
                    src="{{$post->getImagePath()}}"
                    alt="" class="rounded-xl" width="100">
            </div>

            <x-form.field>
                <x-form.label name="category_id"/>

                <select name="category_id" id="category_id" class="p-2 rounded" required>
                    @foreach ($categories as $category)
                        <option
                            value="{{ $category->id }}" @selected(old('category_id',$post->category_id)==$category->id)
                        >{{ ucwords($category->name) }}</option>
                    @endforeach
                </select>

                <x-form.error name="category_id"/>
            </x-form.field>

            <x-form.button>Update</x-form.button>
        </form>
    </x-setting>
</x-layout>
