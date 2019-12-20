@extends ('layouts.app')<!-- resources/views -->
@section ('content')

<h2 class="mb-3">ToDo作成</h2>
{!! Form::open(['route' => 'todo.store']) !!}
<!-- route:list Name:todo.store -->
	<div class="form-group">
		{!! Form::input('text', 'title', null, ['required', 'class' => 'form-control', 'placeholder' => 'ToDo内容']) !!}
	</div>
	{!! Form::submit('追加', ['class' => 'btn btn-success float-right']) !!}
{!! Form::close() !!}

@endsection

<!-- Form::open()：HTMLフォームを作成する。CSRF対策にtokenが追加されます。 -->
<!-- Form::input()：入力フィールドを作成する -->
<!-- Form::submit()：Submitボタンを作成する -->

