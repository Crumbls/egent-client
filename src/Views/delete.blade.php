<x-app-layout>
    <x-header :title="__('Delete Office Client Relationship')" class="\Egent\Office\Models\OfficeClient::class" />
    <div class="container mx-auto sm:px-6 md:px-0 pt-2 pb-4">
            <x-box>
                <x-form
                    method="POST"
                    action="{{ route('clients.destroy', $entity) }}"
                    class="mt-2a"
                >
                    @method('DELETE')
                    <p class="mb-2 text-red-500">Are you sure that you wish to delete this office-client relationship?</p>
                    @if($entity)
                        <p class="mb-2">{{ $entity->name }} &lt;{{ $entity->email }}&gt;</p>
                    @endif

                    <x-button class="bg-red-500 shadow text-lg" type="submit">
                        @lang('Delete')
                    </x-button>

                </x-form>
            </x-box>
    </div>
</x-app-layout>
