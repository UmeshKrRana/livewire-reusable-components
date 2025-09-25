{{-- Common flash message --}}

<div x-data="{ show: false, message: '', type: '' }"
    x-on:toast.window="
        show = true;
        message = $event.detail.message;
        type = $event.detail.type;
        setTimeout(() => show = false, 3000)
        "
    x-show="show" :class="type === 'success' ? 'bg-green-500' : 'bg-red-500'"
    class="fixed top-5 right-5 px-4 py-2 rounded text-white">

    <span x-text="message"></span>
</div>
