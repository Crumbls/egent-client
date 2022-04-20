<div class="container mx-auto">
    <div class="md:flex mb-2">
        <div class="w-full md:w-3/4 md:flex md:items-center">
            <div class="text-left">
                <h1 class="uppercase text-xl font-extrabold mb-2">@lang('Contracts')</h1>
            </div>
        </div>
        <div class="w-full md:w-1/4 md:justify-end md:flex md:items-center">
            <div class="text-center md:text-right">
                Only visible to Chase

                @can('create', \Egent\Contract\Models\Document::class)
                    <div class="flex">a
                        <a href="https://egent.crumbls.com/listings/create" rel="bookmark" class="hidden mr-4 flex items-center justify-center space-x-2 hover:text-yellow-400">
                            <span>@lang('Send')</span>
                            <div class="bg-yellow-400 rounded shadow text-white w-6 h-6 inline-block rounded-full flex items-center justify-center">
                                <i class="mdi mdi-arrow-right-bold"></i>
                            </div>
                        </a>

                        <a href="{!! route('user-client-documents.create', ['listing' => '-', 'userClient' => $entity]) !!}" rel="bookmark" class="flex items-center justify-center space-x-2 hover:text-yellow-400">
                            <span>@lang('Create New Contract')</span>
                            <div class="bg-yellow-400 rounded shadow text-white w-6 h-6 inline-block rounded-full flex items-center justify-center">
                                <i class="mdi mdi-plus"></i>
                            </div>
                        </a>
                    </div>
                @endcan
            </div>
        </div>
    </div>
    <x-client-documents :user="$user" :entities="$entities" />
</div>