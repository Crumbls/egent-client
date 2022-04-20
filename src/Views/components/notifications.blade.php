<h3 class="text-xl font-extrabold mb-4">@lang('Notifications')</h3>
@if($entities->isEmpty())
    <p>No upcoming notifications found.</p>
@else
    <ul class='marker:text-yellow-400 list-outside list-disc ml-6 text-yellow-400 text-sm'>
    @foreach($entities as $entity)
        <li class="{{ $loop->last ? '' : 'mb-2' }}">
            <div class="text-black">
        <x-notification-display :notification="$entity" />
            </div>
        </li>
    @endforeach
    </ul>
    @if(method_exists($entities, 'links'))
        {{ $entities->links() }}
    @endif
@endif
