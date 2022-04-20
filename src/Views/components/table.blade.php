<div>
    <div class="">
        <div class="hidden md:flex w-full">
            <div class="w-full md:w-1/4 font-thin text-left md:pl-4">
                <x-menu.hover-dropdown>
                    <x-slot name="header">@lang('Name')</x-slot>
                    <x-slot name="children">
                        @foreach([
                            [
                                'direction' => 'asc',
                                'sort' => 'user.name_first',
                                'label' => __('A-Z (First Name)'),
                            ],
                            [
                                'direction' => 'desc',
                                'sort' => 'user.name_first',
                                'label' => __('Z-A (First Name)')
                            ],
                            [
                                'direction' => 'desc',
                                'sort' => 'user.name_last',
                                'label' => __('A-Z (Last Name)')
                            ],
                            [
                                'direction' => 'desc',
                                'sort' => 'user.name_last',
                                'label' => __('Z-A (Last Name)')
                            ]
                        ] as $sort)
                            <x-menu.dropdown-item :label="$sort['label']" :sort="$sort['sort']" :direction="$sort['direction']" />
                        @endforeach
                    </x-slot>
                </x-menu.hover-dropdown>
            </div>
            <div class="w-full md:w-1/6 sort-column sort-asc text-gray-500 font-thin text-left md:pl-4">
                <x-menu.hover-dropdown>
                    <x-slot name="header">@lang('Type')</x-slot>
                    <x-slot name="children">
                        @foreach([
                            [
                                'direction' => 'asc',
                                'sort' => 'user.name_first',
                                'label' => __('A-Z (First Name)'),
                            ],
                            [
                                'direction' => 'desc',
                                'sort' => 'user.name_first',
                                'label' => __('Z-A (First Name)')
                            ],
                            [
                                'direction' => 'desc',
                                'sort' => 'user.name_last',
                                'label' => __('A-Z (Last Name)')
                            ],
                            [
                                'direction' => 'desc',
                                'sort' => 'user.name_last',
                                'label' => __('Z-A (Last Name)')
                            ]
                        ] as $sort)
                            <x-menu.dropdown-item :label="$sort['label']" :sort="$sort['sort']" :direction="$sort['direction']" />
                        @endforeach
                    </x-slot>
                </x-menu.hover-dropdown>
            </div>
            <div class="w-full md:w-1/6 sort-column sort-asc text-gray-500 font-thin text-left md:pl-4">
                <x-menu.hover-dropdown>
                    <x-slot name="header">@lang('Latest Activity')</x-slot>
                    <x-slot name="children">
                        @foreach([
                            [
                                'direction' => 'asc',
                                'sort' => 'user.activity_at',
                                'label' => __('Newest'),
                            ],
                            [
                                'direction' => 'desc',
                                'sort' => 'user.activity_at',
                                'label' => __('Oldest')
                            ]
                        ] as $sort)
                            <x-menu.dropdown-item :label="$sort['label']" :sort="$sort['sort']" :direction="$sort['direction']" />
                        @endforeach
                    </x-slot>
                </x-menu.hover-dropdown>
            </div>
            <div class="w-full md:w-1/6 sort-column sort-asc text-gray-500 font-thin text-left md:pl-4">
                <x-menu.hover-dropdown>
                    <x-slot name="header">@lang('Upcoming Deadline')</x-slot>
                    <x-slot name="children">
                        @foreach([
                            [
                                'direction' => 'asc',
                                'sort' => 'user.deadline_at',
                                'label' => __('Newest'),
                            ],
                            [
                                'direction' => 'desc',
                                'sort' => 'user.deadline_at',
                                'label' => __('Oldest')
                            ]
                        ] as $sort)
                            <x-menu.dropdown-item :label="$sort['label']" :sort="$sort['sort']" :direction="$sort['direction']" />
                        @endforeach
                    </x-slot>
                </x-menu.hover-dropdown>
            </div>
            <div class="w-full md:w-1/4 sort-column sort-asc text-gray-500 font-thin text-left md:pl-4">
                        <span class="sr-only">
                            @lang('Actions')
                        </span>
            </div>
        </div>
        <div class="bg-white box">
            @if($entities->isEmpty())
                <div class="w-full">
                    <p class="text-center py-4">
                        @lang('You have no clients.')
                    </p>
                </div>
            @else
                @foreach($entities as $entity)
                    <div
                            @can('view', $entity) data-href="{{ route('clients.show', $entity) }}" @endcan
                    class="block md:flex w-full {{ $loop->index % 2 ? 'bg-gray-100 border-gray-100' : 'bg-white border-white' }} border-gray-100  hover:bg-gray-200 border-l-4  hover:border-blue-300 cursor-pointer">
                        <div class="p-1 px-4 md:p-4 w-full md:w-1/4">
                            <p class="w-full sort-column text-gray-500 font-thin text-left md:hidden">
                                @lang('Name')
                            </p>
                            <!-- Change this to use an actual name once it's available. -->

                            @can('view', $entity)
                                <a href="{{ route('clients.show', $entity) }}">{{ $entity->name }}</a>
                            @else
                                {{ $entity->name }}
                            @endcan
                            @if(true)
                                <div class="grid grid-flow-col auto-cols-auto text-left space-x-3 text-xs">
                                    @if($entity->phoneNumbers->count())
                                        <div class="text-slate-400 dark:bg-slate-800 border-r">
                                            @foreach($entity->phoneNumbers as $number)
                                                <i class="mdi mdi-phone mr-2 text-blue-400"></i> {{ $number->number }}{{ $number->ext ? ' ext. '.$number->ext : '' }}
                                            @endforeach
                                        </div>
                                    @endif

                                    <div class="text-slate-400 dark:bg-slate-800">
                                        <i class="mdi mdi-email mr-2 text-blue-400"></i> <span>{{ $entity->email }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="p-1 px-4 md:p-4 w-full md:w-1/6">
                            <p class="w-full sort-column text-gray-500 font-thin text-left md:hidden">
                                @lang('Type')
                            </p>
                            @if($entity->type)
                                @if($entity->type == 'RESIDENTIAL')
                                    <div class="client-active text-blue-400 f17em w-8 h-8 tooltip type-client">
                                        <span class="w-10 h-10 inline-block flex items-center justify-center text-2xl text-yellow-400">
                                            <i class="mdi mdi-home" data-name="mdi-eye"></i>
                                        </span>
                                        <span class="hidden tooltiptext">Residential</span>
                                    </div>
                                @elseif($entity->type == 'LAND')
                                    <div class="client-active text-blue-400 f17em w-8 h-8 tooltip type-client">
                                        <span class="w-10 h-10 inline-block flex items-center justify-center text-2xl text-red-400">
                                            <i class="mdi mdi-map-marker-star" data-name="mdi-eye"></i>
                                        </span>
                                        <span class="hidden tooltiptext">Residential</span>
                                    </div>
                                @elseif($entity->type == 'COMMERCIAL')
                                    <div class="client-active text-blue-400 f17em w-8 h-8 tooltip type-client">
                                        <span class="w-10 h-10 inline-block flex items-center justify-center text-2xl text-red-400">
                                            <i class="mdi mdi-domain" data-name="mdi-eye"></i>
                                        </span>
                                        <span class="hidden tooltiptext">Residential</span>
                                    </div>
                                @elseif($entity->type == 'MANUFACTURED')
                                    <div class="client-active text-blue-400 f17em w-8 h-8 tooltip type-client">
                                        <span class="w-10 h-10 inline-block flex items-center justify-center text-2xl text-red-400">
                                            <i class="mdi mdi-garage-variant" data-name="mdi-eye"></i>
                                        </span>
                                        <span class="hidden tooltiptext">Residential</span>
                                    </div>
                                @else
                                    @lang(ucwords($entity->type))
                                @endif
                            @else
                                @lang('N/A')
                            @endif
                        </div>
                        <div class="p-1 px-4 md:p-4 w-full md:w-1/6">
                            <p class="w-full sort-column text-gray-500 font-thin text-left md:hidden">
                                @lang('Latest Activity')
                            </p>
                            @if($entity->activity_at)
                                {{ $entity->activity_at }}
                            @else
                                @lang('N/A')
                            @endif

                        </div>
                        <div class="p-1 px-4 md:p-4 w-full md:w-1/6">
                            <p class="w-full sort-column text-gray-500 font-thin text-left md:hidden">
                                @lang('Upcoming Deadline')
                            </p>
                            @if($entity->deadline_at)
                                {{ $entity->deadline_at }}
                            @else
                                @lang('N/A')
                            @endif
                        </div>
                        <div class="p-1 px-4 md:p-4 w-full md:w-1/4">
                            <p class="w-full sort-column text-gray-500 font-thin text-left md:hidden">
                                @lang('Actions')
                            </p>
                            {!! \Egent\Client\Menus\ClientMenu::single($entity, $user) !!}
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="mb-5 mt-4">
        <div class="flex flex-wrap justify-between">
            <div class="w-full">
                <!-- Filters, etc -->
                {!! $entities->links() !!}
            </div>
        </div>
    </div>
</div>