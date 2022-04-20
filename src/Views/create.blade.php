<x-app-layout>

        <div class="container mx-auto mb-5">
            <div class="md:flex border-b mb-4 pb-4">
                <div class="w-full md:w-3/4 md:flex md:items-center">
                    <div class="text-left"><h1 class="uppercase text-xl font-extrabold mb-2">
                            @lang('Create a Client')
                        </h1>
                        <nav aria-label="Breadcrumb" class="flex">
                            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                                <li>
                                    <div class="flex items-center">
                                        <a href="{{ route('clients.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2 dark:text-gray-400 dark:hover:text-white">
                                            @lang('All Clients')
                                        </a>
                                    </div>
                                </li>
                                <li aria-current="page">
                                    <div class="flex items-center">
                                        <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                                             class="w-6 h-6 text-gray-400">
                                            <path fill-rule="evenodd"
                                                  d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                  clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="ml-1 md:ml-2 text-sm font-medium text-gray-400 dark:text-gray-500">
                                                                @lang('Create Client')
                                        </span>
                                    </div>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="w-full md:w-1/4 md:justify-end md:flex md:items-center">
                    <div class="text-center md:text-right"></div>
                </div>
            </div>
        </div>

    <div class="container mx-auto">

        <x-form
                method="POST"
                action="{{ route('clients.store') }}"
                class="mt-4"
        >

            <div class="flex">
                <div class="w-full md:w-1/2 md:pr-2">
                    <x-box>
                        <div class="md:flex md:space-x-4 md:mb-2">
                            <div class="w-full md:w-1/3">
                                <x-form-input name="name_first" :placeholder="__('First Name')"
                                              :label="__('First Name')"
                                              required="true"/>
                            </div>
                            <div class="w-full md:w-1/3">
                                <x-form-input name="name_middle" :placeholder="__('Middle Name')"
                                              :label="__('Middle Name')"
                                />
                            </div>
                            <div class="w-full md:w-1/3">
                                <x-form-input name="name_last" :placeholder="__('Last Name')" :label="__('Last Name')"
                                              required="true"/>
                            </div>
                        </div>
                        <div class="md:flex md:space-x-4 md:mb-2">
                            <div class="w-full md:w-1/3">
                                <x-form-input name="company_name" :placeholder="__('Company Name')"
                                              :label="__('Company Name')"/>
                            </div>
                            <div class="w-full md:w-1/3">
                                <x-form-input type="email" name="email" :placeholder="__('Email')" :label="__('Email')"
                                              required="true"/>
                            </div>
                            <div class="w-full md:w-1/3">
                                <x-form-input type="email" name="email_alternate" :placeholder="__('Alternate Email')"
                                              :label="__('Alternate Email')"/>
                            </div>
                        </div>
                        <div class="md:flex md:space-x-4 md:mb-2">
                            <div class="w-full md:w-1/2 md:pr-2">
                                <div class="md:flex">
                                    <div class="w-full md:w-3/4 md:pr-2">
                                        <x-form-input name="phone" :placeholder="__('Phone')" :label="__('Phone')"
                                        />
                                    </div>
                                    <div class="w-full md:w-1/4 md:pl-2">
                                        <x-form-input name="phone_ext" :placeholder="__('Ext')" :label="__('Ext')"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="w-full md:w-1/2 md:pl-2">
                                <div class="md:flex">
                                    <div class="w-full md:w-3/4 md:pr-2">
                                        <x-form-input name="phone_alt" :placeholder="__('Phone')" :label="__('Phone')"
                                        />
                                    </div>
                                    <div class="w-full md:w-1/4 md:pl-2">
                                        <x-form-input name="phone_alt_ext" :placeholder="__('Ext')" :label="__('Ext')"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </x-box>
                </div>
                <div class="w-full md:w-1/2 md:pl-2">
                    <x-box>
                        <div class="md:flex md:space-x-4 md:mb-2">
                            <div class="w-full">
                                <x-form-input name="address[address]" :placeholder="__('Address')"
                                              :label="__('Address')"
                                />
                            </div>
                        </div>
                        <div class="md:flex md:space-x-4 md:mb-2">
                            <div class="w-full md:w-3/4">
                                <x-form-input name="address[city]" :placeholder="__('City')" :label="__('City')"
                                />
                            </div>
                            <div class="w-full md:w-1/4">
                                <div class=" mt-4 ">
                                    <label class="label font-medium text-gray-700 mb-1 block" for="address[state]">
                                        @lang('State')
                                    </label>
                                    @php($value = old('address[state]'))
                                    <select name="address[state]" class="choice block w-ful">
                                        @foreach(\App\Http\Requests\AddressStoreRequest::getStates() as $abbr => $name)
                                            <option value="{{ $abbr }}"{{ $value == $abbr ? ' selected' : ''  }}>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="w-full md:w-1/4A">
                                <x-form-input name="address[postal_code]" :placeholder="__('Zip Code')"
                                              :label="__('Zip Code')"/>
                            </div>
                        </div>

                        <div class="md:flex md:space-x-4 md:mb-2">
                            <div class="w-full">
                                <x-form-select :label="__('Country')" name="address[country_code]"
                                               :options="$countries"/>
                            </div>
                        </div>
                    </x-box>
                </div>
            </div>

            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md
font-bold text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none
focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 bg-blue-300 shadow">
                @lang('Create')
            </button>

        </x-form>
    </div>
</x-app-layout>