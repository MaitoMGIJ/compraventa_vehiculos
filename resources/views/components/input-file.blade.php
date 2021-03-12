<div class="overflow-hidden relative w-64 mt-4 mb-4">
    <button wire:submit.prevent="check" class="bg-blue hover:bg-blue-dark text-black font-bold py-2 px-4 w-full inline-flex items-center">
        <svg fill="#000" height="18" viewBox="0 0 24 24" width="18" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 0h24v24H0z" fill="none"/>
            <path d="M9 16h6v-6h4l-7-7-7 7h4zm-4 2h14v2H5z"/>
        </svg>
        <span class="ml-2">{{ __('tags.upload_photo') }}</span>
    </button>
    <input class="cursor-pointer absolute block opacity-0 pin-r pin-t" type="file" name="photo" @change="fileName">
</div>
