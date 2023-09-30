@extends('admin.layouts.layout')

@section('content')
    {{--@dd($category->photos)--}}
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Редактирование категории каюты</h1>
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
                        @if($category)
                        <div class="card-header">
                            <h2 class="card-title">{{ $category->vendor_code }}</h2>
                        </div>
                        <!-- /.card-header -->

                        {{--FORM--}}
                        <form role="form" method="post" action="{{ route('cabin-category.update', ['cabin_category' => $category->id]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Название</label>
                                    <input type="text" name="title"
                                           class="form-control @error('title') is-invalid @enderror"
                                           value="{{ $category->title }}">
                                </div>

                                <div class="form-group col-sm-4 col-md-3 col-lg-2">
                                    <label>Тип</label>
                                    <select name="type" class="form-control @error('type') is-invalid @enderror">
                                        <option value="Inside" @if($category->type == 'Inside') selected @endif>Inside</option>
                                        <option value="Ocean view" @if($category->type == 'Ocean view') selected @endif>Ocean view</option>
                                        <option value="Balcony" @if($category->type == 'Balcony') selected @endif>Balcony</option>
                                        <option value="Suite" @if($category->type == 'Suite') selected @endif>Suite</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="title">Код</label>
                                    <input type="text" name="vendor_code"
                                           class="form-control @error('vendor_code') is-invalid @enderror"
                                           value="{{ $category->vendor_code }}">
                                </div>

                                <div class="form-group">
                                    <label>Лайнер</label>
                                    @foreach($ships as $id => $title)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="ship_id" value="{{ $id }}"
                                               @if($id == $category->ship_id) checked @endif>
                                        <label class="form-check-label">{{ $title }}</label>
                                    </div>
                                    @endforeach
                                </div>

                                <div class="form-group">
                                    <label for="description">Описание</label>
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="7">{{ $category->description }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Фото</label>
                                    @if(empty($category->photos))
                                       <div>Нет фото этой каюты</div>
                                    @else
                                    <div class="row">
                                        @foreach($category->photos as $item)
                                            <div class="col-sm-4">
                                                <div class="position-relative">
                                                    <img src="{{ $item }}" class="img-fluid">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="ordering">Заказ</label>
                                    <input type="text" name="ordering"
                                           class="form-control @error('ordering') is-invalid @enderror"
                                           value="{{ $category->ordering }}">
                                </div>

                                <div class="form-group">
                                    <label>Состояние</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="state" value="1" @if($category->state == 1) checked @endif>
                                        <label class="form-check-label">Блеск</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="state" value="0" @if($category->state == 0) checked @endif>
                                        <label class="form-check-label">Так себе состояние...</label>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                        </form>

                        @else
                            <p class="p-2"> А нет такой каюты...</p>
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

