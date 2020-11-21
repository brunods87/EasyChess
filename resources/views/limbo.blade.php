@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-12">
				Waiting for opponent...
			</div>
		</div>
	</div>

	<script type="text/javascript">
		var interval = setInterval(function(){
			$.ajax({
				type: 'POST',
				url: '{{ route('requestGame') }}',
				data: {token: '{{$token}}' },
			}).done(function(response){
				var message = response;
				if (message){
					location.href="{{route('home', ['token' => $token])}}";
				}
			});
		}, 1000);
	</script>
@endsection