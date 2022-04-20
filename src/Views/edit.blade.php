<x-app-layout>

    <x-form
            method="POST"
            action="{{ route('clients.update', $entity) }}"
            class="mt-4"
    >
        @method('PATCH')

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
                                                                @lang('Edit This Client')
                            </span>
                                    </div>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="w-full md:w-1/4 md:justify-end md:flex md:items-center">
                    <div class="text-center md:text-right">
                            <button type="submit" class="flex items-center justify-center space-x-2 hover:text-yellow-400">
                                <span>@lang('Save')</span>
                                <div class="bg-yellow-400 rounded shadow text-white w-10 h-10 inline-block rounded-full flex items-center justify-center">
                                    <i class="mdi mdi-plus"></i>
                                </div>
                            </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container mx-auto">

            <div class="flex">
                <div class="w-full md:w-1/2 md:pr-2">
                    <x-box>
                        <div class="md:flex md:space-x-4 md:mb-2">
                            <div class="w-full md:w-1/3">
                                <x-form-input name="name_first" :placeholder="__('First Name')"
                                              :label="__('First Name')"
                                              :value="old('name_first', $entity->name_first)"
                                              required="true"/>
                            </div>
                            <div class="w-full md:w-1/3">
                                <x-form-input name="name_middle" :placeholder="__('Middle Name')"
                                              :value="old('name_middle', $entity->name_middle)"
                                              :label="__('Middle Name')"
                                />
                            </div>
                            <div class="w-full md:w-1/3">
                                <x-form-input name="name_last" :placeholder="__('Last Name')" :label="__('Last Name')"
                                              :value="old('name_last', $entity->name_last)"
                                              required="true"/>
                            </div>
                        </div>
                        <div class="md:flex md:space-x-4 md:mb-2">
                            <div class="w-full md:w-1/3">
                                <x-form-input name="company_name" :placeholder="__('Company Name')"
                                              :value="old('company_name', $entity->company_name)"
                                              :label="__('Company Name')"/>
                            </div>
                            <div class="w-full md:w-1/3">
                                <x-form-input type="email" name="email" :placeholder="__('Email')" :label="__('Email')"
                                              :value="old('email', $entity->email)"
                                              required="true"/>
                            </div>
                            <div class="w-full md:w-1/3">
                                <x-form-input type="email" name="email_alternate" :placeholder="__('Alternate Email')"
                                              :value="old('email_alternate', $entity->email_alternate)"
                                              :label="__('Alternate Email')"/>
                            </div>
                        </div>
                        <div class="md:flex md:space-x-4 md:mb-2">
                            <div class="w-full md:w-1/2 md:pr-2">
                                <div class="md:flex">
                                    <div class="w-full md:w-3/4 md:pr-2">
                                        <x-form-input name="phone"
                                                      :value="old('phone', $entity->phone)"
                                                      :placeholder="__('Phone')" :label="__('Phone')"
                                        />
                                    </div>
                                    <div class="w-full md:w-1/4 md:pl-2">
                                        <x-form-input name="phone_ext"
                                                      :value="old('phone_ext', $entity->phone_ext)"
                                                      :placeholder="__('Ext')" :label="__('Ext')"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="w-full md:w-1/2 md:pl-2">
                                <div class="md:flex">
                                    <div class="w-full md:w-3/4 md:pr-2">
                                        <x-form-input name="phone_alt" :placeholder="__('Phone')"
                                                      :value="old('phone_alt', $entity->phone_alt)"
                                                      :label="__('Phone')"
                                        />
                                    </div>
                                    <div class="w-full md:w-1/4 md:pl-2">
                                        <x-form-input name="phone_alt_ext"
                                                      :value="old('phone_alt_ext', $entity->phone_alt_ext)"
                                                      :placeholder="__('Ext')" :label="__('Ext')"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </x-box>
                </div>
                <div class="w-full md:w-1/2 md:pl-2">
                    <?php
                    $address = $entity->address;
					?>
                    <x-box>
                        <div class="md:flex md:space-x-4 md:mb-2">
                            <div class="w-full">
                                <x-form-input name="address[address]" :placeholder="__('Address')"
                                              :label="__('Address')"
                                              :value="old('address.address', $address ? $address->address : null)"
                                />
                            </div>
                        </div>
                        <div class="md:flex md:space-x-4 md:mb-2">
                            <div class="w-full md:w-3/4">
                                <x-form-input name="address[city]" :placeholder="__('City')" :label="__('City')"
                                              :value="old('address.city', $address ? $address->city : null)"
                                />
                            </div>
                            <div class="w-full md:w-1/4">
                                <div class=" mt-4 ">
                                    <label class="label font-medium text-gray-700 mb-1 block" for="address[state]">
                                        @lang('State')
                                    </label>
                                    @php($value = old('address.state', $address ? $address->state : null))
                                    <select name="address[state]" class="choice block w-ful">
                                        @foreach(\App\Http\Requests\AddressStoreRequest::getStates() as $abbr => $name)
                                            <option value="{{ $abbr }}"{{ $value == $abbr ? ' selected' : ''  }}>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="w-full md:w-1/4A">
                                <x-form-input name="address[postal_code]" :placeholder="__('Zip Code')"
                                              :value="old('address.postal_code', $address ? $address->postal_code : null)"
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
                @lang('Update')
            </button>

    </div>
    </x-form>
</x-app-layout>