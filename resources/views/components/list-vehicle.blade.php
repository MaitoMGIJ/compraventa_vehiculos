<div class="grid grid-cols-3 gap-4 mt-8">
    @foreach($vehicles as $vehicle)
    <x-vehicle-card :vehicle="$vehicle"/>
    @endforeach
</div>
