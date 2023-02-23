@extends('backend_theme::layouts.two_columns_left')

@push('footer_js')
<script src="{{ asset('congregatebackend/js/app.js') }}"></script>
<script type="text/javascript">
    function fetchNext() {
        const resource = 'online-contacts';
        fetchTableData(resource, 'not_used_yet').then((response) => {
            console.table(response.data);
            const tbody = document.getElementById('dump');
            tbody.innerHTML = JSON.stringify(response);
        }).catch((e) => {
            console.error("we could not get the data", e)
        })
    }
</script>
@endpush

@section('content')
<h1>Backend table example</h1>

<code id="dump"></code>
<p>
    <button>Previous</button> &nbsp; <button onclick="fetchNext()">Next</button>
</p>
@endsection