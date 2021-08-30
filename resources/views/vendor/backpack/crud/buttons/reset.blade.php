@if ($crud->hasAccess('update'))
<a href="{{ url($crud->route.'/'.$entry->getKey().'/reset') }}" class="btn btn-sm btn-link"><i class="la la-ban">Reset Password</i></a>
{{-- class="btn btn-sm btn-link"><i class="la la-edit --}}
@endif