<div class="container mx-auto">
    <div class="md:flex mb-2">
        <div class="w-full md:w-3/4 md:flex md:items-center">
            <div class="text-left">
                <h1 class="uppercase text-xl font-extrabold mb-2">@lang('Archived')</h1>
            </div>
        </div>
        <div class="w-full md:w-1/4 md:justify-end md:flex md:items-center">
            <div class="text-center md:text-right">

            </div>
        </div>
    </div>
    <x-client-documents :user="$user" :entities="$entities" />
</div>
