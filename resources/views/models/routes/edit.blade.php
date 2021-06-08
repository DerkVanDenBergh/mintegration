<x-app-layout>
    
    <x-slot name="header">
        {{ __($route->title . ' - edit') }}
    </x-slot>

    <x-subpages.card>
    
        <x-slot name="content">

            <x-forms.model-form :action="__('/routes/') . $route->id">

                <x-slot name="method">
                    <input name="_method" type="hidden" value="PUT">
                </x-slot>

                <x-slot name="fields">

                    <x-forms.components.attribute :span="__(4)" :type="__('text')" :label="__('Name')" :name="__('title')" :value="$route->title" :required="__(true)"/>

                    <x-forms.components.attribute :span="__(4)" :type="__('text')" :label="__('Description')" :name="__('description')" :value="$route->description"/>

                    <x-forms.components.attribute :span="__(1)" :type="__('checkbox')" :label="__('Active')" :name="__('active')" :checked="$route->active"/>
                    
                </x-slot>
            
            </x-forms.model-form>

        </x-slot>

    </x-subpages.card>

</x-app-layout>
