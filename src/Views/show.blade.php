<x-app-layout>
    <div class="pb-5">
        <div class="container mx-auto">
            <div class="md:flex border-b mb-4 pb-4">
                <div class="w-full md:w-3/4 md:flex md:items-center">
                    <div class="text-left">
                        <h1 class="uppercase text-xl font-extrabold mb-2">
                            @lang('Clients')
                        </h1>
                        <nav aria-label="Breadcrumb" class="flex">
                            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                                <li aria-current="page">
                                    <div class="flex items-center">
                                        <span class="text-sm font-medium text-gray-400 dark:text-gray-500">
                                                                @lang('View This Client')
                            </span>
                                    </div>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="w-full md:w-1/4 md:justify-end md:flex md:items-center">
                    <div class="text-center md:text-right">
                        @if($policy->update($user, $entity))
                            <a href="{{ route('clients.edit', $entity) }}" rel="bookmark" class="flex items-center justify-center space-x-2 hover:text-yellow-400">
                                <span>@lang('Edit Client')</span>
                                <div class="bg-yellow-400 rounded shadow text-white w-10 h-10 inline-block rounded-full flex items-center justify-center">
                                    <i class="mdi mdi-plus"></i>
                                </div>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto">
        <div class="w-full">
            @if(false)
                Client Information
            @endif
            <div class="w-full flex">
                <div class="w-full md:w-1/2 md:pr-2 flex flex-col">
                    <div class="bg-white text-black shadow p-4 mb-4 h-full">

                        <x-client-basic :user="$entity" />
                    </div>

                </div>
                <div class="w-full md:w-1/4 md:px-2 flex flex-col">
                    <div class="bg-white text-black shadow p-4 mb-4 h-full">
                        <x-client-deadline-upcoming :user="$entity" />
                    </div>
                </div>
                <div class="w-full md:w-1/4 md:pl-2 flex flex-col">
                    <div class="bg-white text-black shadow p-4 mb-4 h-full">
                        <x-client-notification :user="$entity" />
                    </div>
                </div>
            </div>


            <div class="container mx-auto">
                <div class="md:flex mb-2">
                    <div class="w-full md:w-3/4 md:flex md:items-center">
                        <div class="text-left">
                            <h1 class="uppercase text-xl font-extrabold mb-2">@lang('Listings')</h1>
                        </div>
                    </div>
                    <div class="w-full md:w-1/4 md:justify-end md:flex md:items-center">
                        <div class="text-center md:text-right">
                            @if(false)
                            @can('create', \Egent\Listing\Models\Listing::class)
                                <a href="{!! route('user-clients.listing', $entity) !!}" rel="bookmark" class="flex items-center justify-center space-x-2 hover:text-yellow-400">
                                    <span>@lang('Add New Listing')</span>
                                    <div class="bg-yellow-400 rounded shadow text-white w-6 h-6 inline-block rounded-full flex items-center justify-center">
                                        <i class="mdi mdi-plus"></i>
                                    </div>
                                </a>
                            @endcan
                                @endif
                        </div>
                    </div>
                </div>
            </div>

            <x-client-listings :user="$entity" />
            <x-client-contracts :user="$entity" />
            <x-client-drafts :user="$entity" />
            <x-client-archived :user="$entity" />
        </div>

</x-app-layout>