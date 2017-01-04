<div class="wrapper container-fluid">

{!! Form::open(['url' => route('portfolioEdit',['portfolio'=>$data['id']]),'class'=>'form-horizontal','method'=>'POST','enctype'=>'multipart/form-data']) !!}
    <div class="form-group">
	     {!! Form::label('name', 'Название:',['class'=>'col-xs-2 control-label']) !!}
	     <div class="col-xs-8">
		 	{!! Form::text('name', $data['name'], ['class' => 'form-control','placeholder'=>'Введите название работы']) !!}
		 </div>
    </div>
    {!! Form::hidden('id', $data['id']) !!}
    <div class="form-group">
	     {!! Form::label('filter', 'Фильтр:',['class'=>'col-xs-2 control-label']) !!}
	     <div class="col-xs-8">
		 	{!! Form::text('filter', $data['filter'], ['class' => 'form-control','placeholder'=>'Введите ключевое слово']) !!}
		 </div>
    </div>
	
	<div class="form-group">
    	{!! Form::label('old_img', 'Изображение:',['class'=>'col-xs-2 control-label']) !!}
    	<div class="col-xs-offset-2 col-xs-10">
			{!! Html::image('assets/img/'.$data['img'],'',['class'=>'img-responsive','width'=>'150px']) !!}
			{!! Form::hidden('old_img', $data['img']) !!}
    	</div>
    </div>
    
    <div class="form-group">
	     {!! Form::label('img', 'Изображение:',['class'=>'col-xs-2 control-label']) !!}
	     <div class="col-xs-8">
		 	{!! Form::file('img', ['class' => 'filestyle','data-buttonText'=>'Выберите изображение','data-buttonName'=>"btn-primary",'data-placeholder'=>"Файла нет"]) !!}
		 </div>
    </div>
    
      <div class="form-group">
	    <div class="col-xs-offset-2 col-xs-10">
	      {!! Form::button('Сохранить', ['class' => 'btn btn-primary','type'=>'submit']) !!}
	    </div>
	  </div>
    
{!! Form::close() !!}

</div>