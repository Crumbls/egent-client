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
                                                                @lang('All Clients')
                            </span>
                                    </div>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="w-full md:w-1/4 md:justify-end md:flex md:items-center">
                    <div class="text-center md:text-right">
                        @if($policy->create($user))
                            <a href="{{ route('clients.create') }}" rel="bookmark" class="flex items-center justify-center space-x-2 hover:text-yellow-400">
                                <span>@lang('Create New Client')</span>
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

    @if($entities->isEmpty())
        @lang('You have no offers associated with this listing.')
    @else
        <div class="bg-white text-black shadow mb-4 container mx-auto">
        @foreach($entities as $entity)
            <div
                    data-href="{{ route('clients.show', [$entity]) }}"
                    class="block md:flex w-full {{ $loop->index % 2 ? 'bg-gray-100 border-gray-100' : 'bg-white border-white' }} border-gray-100  hover:bg-gray-200 border-l-4  dis-hover:border-blue-300 cursor-pointer">
                <div class="p-1 px-4 md:p-4 w-full md:w-1/7">
                    <p class="w-full sort-column text-gray-500 font-thin text-left md:hidden">
                        @lang('Name')
                    </p>
                    <span>{{ $entity->name }}</span>
                </div>
                <div class="p-1 px-4 md:p-4 w-full md:w-1/7">
                    <p class="w-full sort-column text-gray-500 font-thin text-left md:hidden">
                        @lang('Name')
                    </p>
                    <span>{{ $entity->email }}</span>
                </div>
                <div class="p-1 px-4 md:p-4 w-full md:w-1/7">
                    <p class="w-full sort-column text-gray-500 font-thin text-left md:hidden">
                        @lang('Notes')
                    </p>
                </div>
                <div class="p-1 px-4 md:p-4 w-full md:w-1/7">
                    <p class="w-full sort-column text-gray-500 font-thin text-left md:hidden">
                        @lang('Type')
                    </p>
                    a
                </div>
                <div class="p-1 px-4 md:p-4 w-full md:w-1/7">
                    <p class="w-full sort-column text-gray-500 font-thin text-left md:hidden">
                        @lang('Date Accepted')
                    </p>
                    aa
                </div>
                <div class="p-1 px-4 md:p-4 w-full md:w-1/7">
                    <p class="w-full sort-column text-gray-500 font-thin text-left md:hidden">
                        @lang('Status')
                    </p>
                    {{ $entity->name }}
                </div>
                <div class="p-1 px-4 md:p-4 w-full md:w-1/7">
                    <p class="w-full sort-column text-gray-500 font-thin text-left md:hidden">
                        @lang('Actions')
                    </p>
                    accct
                </div>
            </div>
        @endforeach
        </div>
        @if(method_exists($entities, 'links'))
        <div class="mb-5 mt-4">
            <div class="flex flex-wrap justify-between">
                <div class="w-full">
                    <!-- Filters, etc -->
                    {!! $entities->links() !!}
                </div>
            </div>
        </div>
        @endif
    @endif
</x-app-layout>