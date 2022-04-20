<div>
    <div class="">
        <div class="hidden md:flex w-full">
            <div class="w-full md:w-1/7 font-thin text-left md:pl-4">
                <x-menu.hover-dropdown>
                    <x-slot name="header">@lang('Address')</x-slot>
                    <x-slot name="children"></x-slot>
                </x-menu.hover-dropdown>
            </div>
            <div class="w-full md:w-1/7 sort-column sort-asc text-gray-500 font-thin text-left md:pl-4">
                <x-menu.hover-dropdown>
                    <x-slot name="header">@lang('Type')</x-slot>
                    <x-slot name="children">
                        @foreach(\App\Enum\ListingType::toArray() as $k => $v)
                            <x-menu.dropdown-item :label="\Str::title($v)" :sort="$v" direction="asc"/>
                        @endforeach
                    </x-slot>
                </x-menu.hover-dropdown>
            </div>
            <div class="w-full md:w-1/7 sort-column sort-asc text-gray-500 font-thin text-left md:pl-4">
                <x-menu.hover-dropdown>
                    <x-slot name="header">@lang('Latest Activity')</x-slot>
                    <x-slot name="children">
                        @foreach([
                            [
                                'direction' => 'asc',
                                'sort' => 'updated_at',
                                'label' => __('Newest'),
                            ],
                            [
                                'direction' => 'desc',
                                'sort' => 'updated_at',
                                'label' => __('Oldest')
                            ]
                        ] as $sort)
                            <x-menu.dropdown-item :label="$sort['label']" :sort="$sort['sort']"
                                                  :direction="$sort['direction']"/>
                        @endforeach
                    </x-slot>
                </x-menu.hover-dropdown>
            </div>
            <div class="w-full md:w-1/7 sort-column sort-asc text-gray-500 font-thin text-left md:pl-4">
                <x-menu.hover-dropdown>
                    <x-slot name="header">@lang('Date Created')</x-slot>
                    <x-slot name="children">
                        @foreach([
                            [
                                'direction' => 'asc',
                                'sort' => 'created_at',
                                'label' => __('Newest'),
                            ],
                            [
                                'direction' => 'desc',
                                'sort' => 'created_at',
                                'label' => __('Oldest')
                            ]
                        ] as $sort)
                            <x-menu.dropdown-item :label="$sort['label']" :sort="$sort['sort']"
                                                  :direction="$sort['direction']"/>
                        @endforeach
                    </x-slot>
                </x-menu.hover-dropdown>
            </div>
            <div class="w-full md:w-1/7 sort-column sort-asc text-gray-500 font-thin text-left md:pl-4">
                <x-menu.hover-dropdown>
                    <x-slot name="header">@lang('Affiliation')</x-slot>
                    <x-slot name="children">
                        @foreach([
                            [
                                'direction' => 'asc',
                                'sort' => 'created_at',
                                'label' => __('Newest'),
                            ],
                            [
                                'direction' => 'desc',
                                'sort' => 'created_at',
                                'label' => __('Oldest')
                            ]
                        ] as $sort)
                            <x-menu.dropdown-item :label="$sort['label']" :sort="$sort['sort']"
                                                  :direction="$sort['direction']"/>
                        @endforeach
                    </x-slot>
                </x-menu.hover-dropdown>
            </div>
            <div class="w-full md:w-1/7 sort-column sort-asc text-gray-500 font-thin text-left md:pl-4">
                <x-menu.hover-dropdown>
                    <x-slot name="header">@lang('Status')</x-slot>
                    <x-slot name="children">
                        @foreach([
                            [
                                'direction' => 'asc',
                                'sort' => 'created_at',
                                'label' => __('Newest'),
                            ],
                            [
                                'direction' => 'desc',
                                'sort' => 'created_at',
                                'label' => __('Oldest')
                            ]
                        ] as $sort)
                            <x-menu.dropdown-item :label="$sort['label']" :sort="$sort['sort']"
                                                  :direction="$sort['direction']"/>
                        @endforeach
                    </x-slot>
                </x-menu.hover-dropdown>
            </div>
            <div class="w-full md:w-1/7 sort-column sort-asc text-gray-500 font-thin text-left md:pl-4">
                        <span class="sr-only">
                            @lang('Actions')
                        </span>
            </div>
        </div>
        <div class="bg-white box">
            @if($entities->isEmpty())
                <div class="w-full">
                    <p class="text-center py-4">
                        @lang('No listings found.')
                    </p>
                </div>
            @else
                @foreach($entities as $entity)
                    <div
                            @can('view', $entity) data-href="{{ route('listings.show', $entity) }}"
                            @endcan class="block md:flex w-full {{ $loop->index % 2 ? 'bg-gray-100 border-gray-100' : 'bg-white border-white' }} border-gray-100  hover:bg-gray-200 border-l-4  hover:border-blue-300 cursor-pointer">
                        <div class="p-1 px-4 md:p-4 w-full md:w-1/7">
                            <p class="w-full sort-column text-gray-500 font-thin text-left md:hidden">
                                @lang('Address')
                            </p>
                            <!-- Change this to use an actual name once it's available. -->
                            @php($address = $entity->addresses->first())
                            @if($address)
                                {{ implode(' ', array_filter([
                                   $address->street_1 ? $address->street_1 : null,
                                   $address->street_2 ? $address->street_2 : null,
                                   $address->street_3 ? $address->street_3 : null,
                                   $address->city ? $address->city : null,
                                   $address->state ? $address->state : null,
                                   $address->postal_code ? $address->postal_code : null
                                   ])) }}
                            @else
                                @lang('N/A')
                            @endif
                        </div>
                        <div class="p-1 px-4 md:p-4 w-full md:w-1/7">
                            <p class="w-full sort-column text-gray-500 font-thin text-left md:hidden">
                                @lang('Type')
                            </p>
                            @if($entity->type)
                                @lang(ucwords($entity->type))
                            @else
                                @lang('N/A')
                            @endif
                        </div>
                        <div class="p-1 px-4 md:p-4 w-full md:w-1/7">
                            <p class="w-full sort-column text-gray-500 font-thin text-left md:hidden">
                                @lang('Type')
                            </p>
                            @if($entity->updated_at)
                                {{ $entity->updated_at }}
                            @else
                                @lang('N/A')
                            @endif

                        </div>
                        <div class="p-1 px-4 md:p-4 w-full md:w-1/7">
                            <p class="w-full sort-column text-gray-500 font-thin text-left md:hidden">
                                @lang('Date Created')
                            </p>
                            @if($entity->created_at)
                                {{ $entity->created_at }}
                            @else
                                @lang('N/A')
                            @endif
                        </div>
                        <div class="p-1 px-4 md:p-4 w-full md:w-1/7">
                            Affiliation
                            @if(false)
                                {{ $entity->pivot }}
                            @endif
                        </div>
                        <div class="p-1 px-4 md:p-4 w-full md:w-1/7">
                            <!-- start -->
                            <select
                                    @cannot('update', $entity) disabled @endcannot
                                    data-href="{{ route('api.listings.update', $entity) }}"
                                    name="status"
                                    class="select-toggle form-select appearance-none
      block
      w-full
      px-3
      py-1.5
      text-sm
      bg-transparent
      font-normal
      text-gray-700
        bg-clip-padding bg-no-repeat
      border-none
      rounded
      transition
      ease-in-out
      m-0
      focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example">
                                <option value="ACTIVE"{{ $entity->status == 'ACTIVE' ? ' selected' : '' }}>Active</option>
                                <option value="WITHDRAWN"{{ $entity->status == 'WITHDRAWN' ? ' selected' : '' }}>Withdrawn</option>
                                <option value="UNDERCONTRACT"{{ $entity->status == 'UNDERCONTRACT' ? ' selected' : '' }}> Under Contract</option>
                                <option value="CLOSED"{{ $entity->status == 'CLOSED' ? ' selected' : '' }}>Closed</option>
                            </select>
                            <!-- end -->
                        </div>
                        <div class="p-1 px-4 md:p-4 w-full md:w-1/7">
                            <p class="w-full sort-column text-gray-500 font-thin text-left md:hidden">
                                @lang('Actions')
                            </p>
                            {!! \App\Menus\ListingMenu::single($entity, $user) !!}
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
<style>
    .dropdown:hover .dropdown-menu {
        display: block;
    }
</style>