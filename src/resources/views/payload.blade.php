@if(config('orians.inject.page'))
    <input type="hidden" id="{{ config('orians.page.input_name') }}" value="{{ $oriansPage ?? '' }}">
@endif

@if(config('orians.inject.config'))
    <textarea id="{{ config('orians.page.config_name') }}" hidden>{{ json_encode($oriansConfig ?? []) }}</textarea>
@endif

@if(config('orians.inject.lang'))
    <textarea id="{{ config('orians.page.lang_name') }}" hidden>{{ json_encode($oriansLang ?? []) }}</textarea>
@endif