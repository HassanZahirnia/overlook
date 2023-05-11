<x-filament-widgets::widget class="filament-versions-widget">
    <x-filament::card>
        <x-slot name="header">
            <x-filament::card.heading>
                {{ __('overlook::versions.widget.title') }}
            </x-filament::card.heading>
        </x-slot>

        <dl class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
            @foreach ($items as $item)
                <div class="text-center">
                    <dt class="text-2xl font-bold text-primary-500">{{ $item['version'] }}</dt>
                    <dl>{{ $item['name'] }}</dl>
                </div>
            @endforeach
        </dl>
    </x-filament::card>
</x-filament-widgets::widget>
