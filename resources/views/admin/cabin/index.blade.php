@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Каюты</h1>
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
                        <div class="card-header">
                            <h3 class="card-title">Категории кают</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if (count($cabin_categories))
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th style="width: 30px">#</th>
                                            <th>Код</th>
                                            <th>Тип</th>
                                            <th>Лайнер</th>
                                            <th>Редактировать</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($cabin_categories as $cat)
                                            <tr>
                                                <td>{{ $cat->id }}</td>
                                                <td>{{ $cat->vendor_code }}</td>
                                                <td>{{ $cat->title }}</td>
                                                <td>{{ $cat->ship->title }}</td>
                                                <td>
                                                    <a href="{{ route('cabin-category.edit', ['cabin_category' => $cat->id]) }}"
                                                       class="btn btn-info btn-sm float-left mr-1">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="p-2">Каюты? Какие каюты?</p>
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection


