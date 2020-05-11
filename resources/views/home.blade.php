@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Author</th>
                                <th>books</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($authors as $author)
                                <tr>
                                    <td>
                                        {!! $author->name !!}
                                    </td>
                                    <td>
                                        @foreach($author->books as $book)
                                            {{$book->title}}, {{$book->year}} <br/>
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $authors->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
