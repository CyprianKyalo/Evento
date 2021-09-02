@if ($crud->hasAccess('update'))
<a href="{{ url($crud->route.'/'.$entry->getKey().'/enable') }}" class="btn btn-sm btn-link"><i class="la la-thumbs-up">Enable</i></a>
{{-- class="btn btn-sm btn-link"><i class="la la-edit --}}
@endif