@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Редактирование лайнера</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        @if($ship)
                        {{--FORM--}}
                        <form role="form" method="post" action="{{ route('ship.update', ['ship' => $ship->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Название</label>
                                    <input type="text" name="title"
                                           class="form-control @error('title') is-invalid @enderror"
                                           value="{{ $ship->title }}">
                                </div>

                                <div class="form-group">
                                    <label for="title">Спецификация</label>
                                    <table class="table table-bordered table-dark">
                                        <thead>
                                            <tr>
                                                <th>Параметр</th>
                                                <th>Значение</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($ship->spec as $k => $v)
                                            <tr>
                                                <td>
                                                    <input type="text" name="spec[{{ $k }}][name]" class="form-control  @error("spec.$k.name") is-invalid @enderror" value="{{ $v->name }}">
                                                </td>
                                                <td>
                                                    <input type="text" name="spec[{{ $k }}][value]" class="form-control @error("spec.$k.value") is-invalid @enderror" value="{{ $v->value }}">
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="form-group">
                                    <label for="description">Описание</label>
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="7">{{ $ship->description }}</textarea>
                                    {{--<div>{!! $ship->description !!}</div>--}}
                                </div>

                                <div class="form-group">
                                    <label for="ordering">Заказ</label>
                                    <input type="text" name="ordering"
                                           class="form-control @error('ordering') is-invalid @enderror"
                                           value="{{ $ship->ordering }}">
                                </div>

                                <div class="form-group">
                                    <label>Состояние</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="state" value="1" @if($ship->state == 1) checked @endif>
                                        <label class="form-check-label">Блеск</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="state" value="0" @if($ship->state == 0) checked @endif>
                                        <label class="form-check-label">В доке на ремонте</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Галерея</label>
                                    <div class="row mt-2">

                                        @foreach($ship->gallery as $item)
                                        <div class="col-sm-4">
                                            <div class="position-relative">
                                                <img src="{{ $item->url }}" class="img-fluid">
                                                <div class="ribbon-wrapper ribbon-lg" style="right:0;top:89%;width:100%">
                                                    <div class="ribbon bg-success text-lg" style="width:100%;transform:none;-webkit-transform:none;">
                                                        {{ $item->title }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="title">Каюты</label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th>Код</th>
                                                <th>Тип</th>
                                                <th>Редактировать</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($ship->cabin as $item)
                                                <tr>
                                                    <td>{{ $item->vendor_code }}</td>
                                                    <td>{{ $item->title }}</td>
                                                    <td>
                                                        <a href="{{ route('cabin-category.edit', ['cabin_category' => $item->id]) }}"
                                                           class="btn btn-info btn-sm float-left mr-1">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                        </form>

                        @else
                            <p class="p-2"> А нет такого лайнера...</p>
                        @endif
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <script src="{{ asset('assets/admin/ckeditor5/build/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/admin/ckfinder/ckfinder.js') }}"></script>

    <script>
        ClassicEditor
            .create( document.querySelector( '#description' ), {
                ckfinder: {
                    uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
                },
                image: {
                    toolbar: [
                        'imageTextAlternative',
                        'toggleImageCaption',
                        'imageStyle:inline',
                        'imageStyle:block',
                        'imageStyle:side'
                    ],
                    styles: [
                        // Выравнивание изображений - CKEditor просто добавляет классы для img. Конфигурировать эти классы можно/нужно прямо в CSS-стилях
                        // This option is equal to a situation where no style is applied.
                        'full',

                        // This represents an image aligned to the left.
                        'alignLeft',

                        // This represents an image aligned to the right.
                        'alignRight'
                    ]
                },
                toolbar: {
                    items: [
                        'heading',
                        '|',
                        'bold',
                        'italic',
                        'underline',
                        'link',
                        'bulletedList',
                        'numberedList',
                        '|',
                        'outdent',
                        'indent',
                        'alignment',
                        '|',
                        'blockQuote',
                        'insertTable',
                        //'mediaEmbed',
                        'undo',
                        'redo',
                        '|',
                        //'CKFinder',
                        'sourceEditing',
                        //'htmlEmbed'
                    ]
                },
                language: 'ru',
                table: {
                    contentToolbar: [
                        'tableColumn',
                        'tableRow',
                        'mergeTableCells'
                    ]
                }
            } )
            .catch( function( error ) {
                console.error( error );
            } );
    </script>
@endsection

