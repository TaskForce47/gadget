<html>
	<head>
		<title>TaskForce47 Squad.xml</title>
		{!! Html::Style('squad/style/design.css') !!}
		<link rel="shortcut icon" href="{{url('squad/style/tf47_icon.ico')}}" type="image/x-icon">
	</head>
	<body>
	<table align="center">
		<tr>
		@foreach($teams as $team)
			<td>
				<a href="{{$team->directory}}/squad_de.xml"><img class="logo_alt" src="{{$team->directory}}/{{$team->directory}}_alt.png" alt="TaskForce47 {{$team->title}} Logo"></a>
				<a href="{{$team->directory}}/squad_de.xml"><img class="logo" src="{{$team->directory}}/{{$team->directory}}_de.jpg" alt="TaskForce47 {{$team->title}} Logo"></a>
			</td>
			@if(($loop->index + 1) % 2 == 0 && !$loop->last)
		</tr>
		<tr>
			@elseif($loop->last)
		</tr>
			@endif
		@endforeach
	</table>
	</body>
</html>
