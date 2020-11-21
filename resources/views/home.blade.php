@extends('layouts.app')

@section('content')
    <board token="{{$token}}" playercolor="{{$playerColor}}"></board>
@endsection

@push('scripts')
	<script type="text/javascript">
		const app = new Vue({
		    el: '#app',
		});
	</script>
@endpush