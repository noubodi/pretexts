<div class="section">
	<div class="wrapper">

	<h2>Login</h2>

	{{ Form::open(array('action' => 'AdminController@postLogin')) }}

	{{ Form::label('email','Email') }}
	{{ Form::text('email', null) }}

	{{ Form::label('password','Password') }}
	{{ Form::password('password') }}

	{{ Form::submit('login') }}
	
	<div class="submit">
	{{ Form::close() }}
	</div>

	</div>
</div>
