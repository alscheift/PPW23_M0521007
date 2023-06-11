@props(['name','labelname'=>null,'type'=>'text', 'required'=>true, 'value'=>old($name)])

<x-form.field>
    <x-form.label name="{{$labelname??$name}}"/>
    <input class="border border-gray-200 p-2 w-full rounded"
           type="{{$type}}"
           name="{{$name}}"
           id="{{$name}}"
           value="{{ $value }}"
        {{$required ? 'required':''}}

        {{ $attributes}}
    >

    <x-form.error :name="$name"/>
</x-form.field>
