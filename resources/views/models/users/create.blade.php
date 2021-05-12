<x-app-layout>
    
    <x-slot name="header">
        {{ __('Users - create') }}
    </x-slot>

    <x-model-form :action="__('/users')">

        <x-slot name="method">
            <input name="_method" type="hidden" value="POST">
        </x-slot>

        <x-slot name="fields">

            <div class="col-span-2">
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>
            
            <div class="col-span-2">
                <x-label for="email" :value="__('E-mail')" />

                <x-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="col-span-2">
                <x-label for="role_id" :value="__('Role')" />

                <x-select id="role_id" :value="__('id')" :label="__('title')" :options="$roles" class="block mt-1 w-full" name="role_id" required autofocus />
            </div>
            
        </x-slot>
    
    </x-model-form>

</x-app-layout>