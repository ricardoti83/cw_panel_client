<x-filament::page>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($this->stacks as $stack)


            <x-stack-card
            :name="$stack->name"
            :status="$stack->status"
            :url="$stack->url"
            :activeTime="$stack->active_time"
            :stack="$stack"

            />
        @endforeach
    </div>
</x-filament::page>