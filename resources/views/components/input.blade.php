@props(['type','name', 'placeholder', 'id'])

<div class="flex flex-col text-left mb-5">
    <label class="mb-3" for={{$id}}>{{ucwords($name)}}</label>
    <input class="border {{$errors->get($name)? 'border-red-400': 'border-gray-200'}}  px-4 py-2 rounded-xl"
           type='{{$type}}' name='{{$name}}' placeholder='{{ucwords($placeholder)}}' id='{{$id}}' value="{{old($name)}}">
    {{$slot}}
{{--    @dd($errors->get($name)? "hi": "bye")--}}
</div>
