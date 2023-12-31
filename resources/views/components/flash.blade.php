@if(session()->has('success'))
    <div x-data="{ show: true }"
         x-init="setTimeout(() => show = false, 4000)"
         x-show="show"
    >
        <p class="fixed right-0 bg-blue-500 text-white py-2 px-4 rounded-xl bottom-3 right-3 text-sm">{{session('success')}}</p>
    </div>
@elseif(session()->has('error'))
    <div x-data="{ show: true }"
         x-init="setTimeout(() => show = false, 4000)"
         x-show="show"
    >
        <p class="fixed right-0 bg-red-500 text-white py-2 px-4 rounded-xl bottom-3 right-3 text-sm">{{session('error')}}</p>
    </div>
@endif
