<div class="md:flex mb-2">
    <div class="w-full md:w-3/4 md:flex md:items-center">
        <div class="text-left">
            <h1 class="uppercase text-xl font-extrabold mb-2">{{ $user->name }}</h1>
        </div>
    </div>
    <div class="w-full md:w-1/4 md:justify-end md:flex md:items-center">
        <div class="text-center md:text-right">
            <a href="{{ route('clients.edit', $user) }}" rel="bookmark" class="flex items-center justify-center space-x-2 text-gray-400 text-md hover:text-yellow-400">
                <span>@lang('Edit')</span>
            </a>
        </div>
    </div>
</div>

<div class="mb-4 pb-4">
    <div class="text-left">
        <p class="uppercase text-lg font-extrabold">@lang('Transaction History'):</p>
    </div>
    <div class="md:flex">
        <div class="w-full flex-initial md:pr-4 flex-0 md:flex md:items-center">
            <a href="#" class="block w-full text-center px-4 py-2 bg-green-400
                            border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500
                            focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                {{ number_format($user->transactionActive, 0) }} @lang('Active')
            </a>
        </div>
        <div class="w-full flex-initial md:pr-4 flex-0 md:flex md:items-center">
            <a href="#" class="block w-full text-center px-4 py-2 bg-yellow-400
                            border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500
                            focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                {{ number_format($user->transactionWithdrawn, 0) }} @lang('Withdrawn')
            </a>
        </div>
        <div class="w-full flex-auto md:pr-4 flex-0 md:flex md:items-center">
            <a href="#" class="block w-full text-center px-4 py-2 bg-blue-400
                            border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500
                            focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                {{ number_format($user->transactionUnderContract, 0) }} @lang('Under Contract')
            </a>
        </div>
        <div class="w-full flex-initial flex-0 md:flex md:items-center">
            <a href="#" class="block w-full text-center px-4 py-2 bg-red-400
                            border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500
                            focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                {{ number_format($user->transactionClosed, 0) }} @lang('Closed')
            </a>
        </div>
    </div>
</div>

<div class="mb-4 pb-4">
    <div class="text-left">
        <p class="uppercase text-lg font-extrabold">@lang('Contact Information'):</p>
    </div>
    <div class="md:flex">
        <div class="w-full md:w-1/3 md:pr-4 flex-0 md:flex md:items-center">
            <div>
            @if($user->addresses->isEmpty())
                <p>@lang('N/A')</p>
            @else
                @foreach($user->addresses as $address)
                    <p class="text-gray-500 text-sm lowercase">
                        @if($address->street_1){{ $address->street_1 }}<br />@endif
                        @if($address->street_2){{ $address->street_2 }}<br />@endif
                        @if($address->street_3){{ $address->street_3 }}<br />@endif
                        {{ $address->city }}, {{ $address->state }} {{ $address->postal_code }}
                    </p>
                    <br />
                @endforeach
            @endif
            </div>
        </div>
        <div class="w-full md:w-1/3 md:pr-4 flex-0 md:flex md:items-center">
            @if ($user->phoneNumbers->isEmpty())
                <p>@lang('N/A')</p>
            @else
                @foreach($user->phoneNumbers as $phoneNumber)
                    <div class="flex phone space-x-2">
                        <span>{{ $phoneNumber->phone_number }}</span>
                        @if($phoneNumber->extension)
                            <span>@lang('ext')</span>
                            <span>{{ $phoneNumber->extension }}</span>
                        @endif
                    </div>
                @endforeach
            @endif
        </div>
        <div class="w-full md:w-1/3 flex-0 md:flex md:items-center">
            {{ $user->email }}
        </div>
    </div>
</div>

<div class="md:flex mb-4 pb-4 client-status">
    <!-- Reusable element -->
    <div class="md:flex">
        <div class="w-1/2 flex flex-col">
            <div class="flex h-full h-100 justify-left items-center uppercase text-lg font-extrabold">
                @lang('Client Profile'):
            </div>
        </div>
        <div class="w-1/2 flex flex-col">
            <div class="flex w-auto mx-auto toggle-container">
                <div class="flex-1 text-right flex items-center justify-end">
                    <label for="status-off" class="cursor-pointer">@lang('Inactive')</label>
                </div>
                <div class="flex-0">
                    <div class="px-10 py-10">
                        <div class="relative">
                            <input type="radio" id="status-off" name="status" value="0" class="hidden sr-only" checked />
                            <input type="radio" id="status-on" name="status" value="1" class="hidden sr-only" />
                            <!-- line -->
                            <div class="w-20 h-2 bg-black rounded-full shadow-inner"></div>
                            <!-- dot -->
                            <div class="dot absolute w-10 h-10 bg-white rounded-full -left-3 -top-4 transition border-3 border-white border-4"></div>
                        </div>
                    </div>
                </div>
                <div class="flex-1 text-right flex items-center justify-start">
                    <label for="status-on" class="cursor-pointer">@lang('Active')</label>
                </div>
            </div>
        </div>
    </div>
    <!-- End Reusable element -->
</div>