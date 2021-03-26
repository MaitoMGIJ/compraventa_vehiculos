<div class="grid md:grid-cols-3 sm:grid-cols-1 gap-4 mt-8">
    @foreach($vehicles as $vehicle)
    <livewire:vehicle-card :vehicle="$vehicle"/>
    @endforeach

</div>
<div class="grid grid-cols-1 w-full px-10">
    {{ $vehicles->links() }}
</div>
