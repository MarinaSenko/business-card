<div style="margin: 0px 50px 0px 50px;">
    @if($pages)
        <table class="table table-hover table-striped">
            <thead>
            <th>№</th>
            <th>Имя</th>
            <th>Текст</th>
            <th>Дата создания</th>
            <th>Удалить</th>
            </thead>
            <tbody>
            @foreach ($pages as $k => $page)
                <tr>
                    <td>{{ $page->id }}</td>
                    <td>{!! Html::link(route('pagesEdit', ['page' => $page->id]), $page->name, ['alt' => $page->name]) !!}</td>
                    <td>{{ $page->text }}</td>
                    <td>{{ $page->created_at }}</td>
                    <td>

                        {!! Form::open(['url'=>route('pagesEdit',['page'=>$page->id]), 'class'=>'form-horizontal','method' => 'delete']) !!}

                        {{ method_field('DELETE') }}
                        {!! Form::button('Удалить',['class'=>'btn btn-danger','type'=>'submit']) !!}

                        {!! Form::close() !!}

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

    <td>{!! Html::link(route('pagesAdd'), 'Создать страницу') !!}</td>


</div>