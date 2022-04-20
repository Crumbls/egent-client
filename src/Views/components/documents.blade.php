<div>
    <div class="">
        <div class="hidden">
            <x-document.loop-header />
        </div>
        <div class="dis-bg-white dis-box">
            @if($entities->isEmpty())
                <div class="w-full">
                    <p class="text-center py-4">
                        @lang('No contracts found.')
                    </p>
                </div>
            @else
                <x-document.loop listing="-" userClient="-" :user="$user" :documents="$entities" />
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