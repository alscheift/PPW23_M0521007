<x-layout>
    <x-setting heading="Publish New Post" route="user">
        <form method="POST" action="/user/posts" enctype="multipart/form-data">
            @csrf
            <x-form.input name="title"/>
            <x-form.input name="slug"/>
            <x-form.textarea name="excerpt"/>
            <x-form.textarea name="body"/>
            <x-form.input name="thumbnail" type="file" :required="false" labelname="Thumbnail (optional)"/>

            <x-form.field>
                <x-form.label name="category_id"/>

                <select name="category_id" id="category_id" class="p-2 rounded" required>
                    @foreach ($categories as $category)
                        <option
                            value="{{ $category->id }}" @selected(old('category_id')==$category->id)>{{ ucwords($category->name) }}</option>
                    @endforeach
                </select>

                <x-form.error name="category_id"/>
            </x-form.field>

            <x-form.button>Publish</x-form.button>
        </form>
    </x-setting>
</x-layout>
