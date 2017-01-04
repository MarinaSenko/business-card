<div class="wrapper container-fluid">

    {!! Form::open(['url' => route('pagesAdd'), 'class' => 'form-horizontal', 'method' => 'post', 'enctype'=>'multipart/form-data' ]) !!}

    <div class="form-group">
        {!! Form::label('name', 'Название', ['class' => 'col-xs-2 control-label' ]) !!}
        <div class="col-xs-8">
            {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Введите название' ]) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('alias', 'Alias', ['class' => 'col-xs-2 control-label' ]) !!}
        <div class="col-xs-8">
            {!! Form::text('alias', old('alias'), ['class' => 'form-control', 'placeholder' => 'Введите название' ]) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('text', 'Текст', ['class' => 'col-xs-2 control-label' ]) !!}
        <div class="col-xs-8">
            {!! Form::textarea('text', old('text'), ['id' => 'editor','class' => 'form-control', 'placeholder' => 'Введите текст' ]) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('img', 'Изображение', ['class' => 'col-xs-2 control-label' ]) !!}
        <div class="col-xs-8">
            {!! Form::file('img', ['class' => 'filestyle', 'data-buttonText' => 'Загрузите изображение', 'data-buttonName' => 'btn btn-primary', 'data-placeholder' => 'Файла нет' ]) !!}
        </div>
    </div>


    <div class="form-group">
        <div class="col-xs-offset-2 col-xs-10">
            {!! Form::button('Сохранить', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
        </div>
    </div>


    {!! Form::close() !!}

    <script>

        CKEDITOR.replace('editor');

    </script>

</div>