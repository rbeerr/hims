@if ($errors->any())
    <div class="alert alert-error">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2 stroke-current shrink-0" fill="none" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <div class="flex flex-col">
            <span class="font-medium">{{ __('Whoops! Something went wrong.') }}</span>
            <ul class="pl-5 mt-1 text-sm list-disc">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
