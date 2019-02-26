<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<main>
    @include('partials.navbar')

    <div class="container my-3">
        <div class="card">
            <div class="card-header">Books</div>
            <div class="card-body">
                @if(isset($books) && count($books) > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>ISBN</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Category</th>
                                <th>Price</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($books as $book)
                                <tr>
                                    <td>{{ $book->isbn }}</td>
                                    <td>{{ $book->title }}</td>
                                    <td>{{ $book->author }}</td>
                                    <td>{{ $book->category }}</td>
                                    <td>{{ $book->price }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>ISBN</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Category</th>
                                <th>Price</th>
                            </tr>
                            </tfoot>
                        </table>

                        {{ $books->links() }}
                    </div>
                @else
                    <p class="mb-0">There are no books to display.</p>
                @endif
            </div>
        </div>
    </div>
</main>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
