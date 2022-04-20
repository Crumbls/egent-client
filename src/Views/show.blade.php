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

    Long story short, this is a client dashboard for either a user, or anyone in the office of the user.

    {{ $entity }}
</x-app-layout>