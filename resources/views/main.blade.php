<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Zimalab_test</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="css/style.css">

     

    </head>
    <body>

        <div class="flex-center">
            <div class="container">
                <div class="title m-b-md">
                    Zimalab
                </div>

                <div class="container mt-4">
                    <form action="/add_url" method="post">
                        @csrf
                        <input type="text" name="url" placeholder="введите url" required="true">
                        <input type="submit" value="ок">
                    </form>
                </div>

                <div class="row flex" id="table_header">
                    <div class="url">url-адрес</div>
                    <div class="link">ссылка</div>                    
                </div>

                @foreach($urls as $url)
                <div class="row flex">
                    <div class="url">{{ $url->link }}</div>
                    <div class="link">
                        <p>
                            <form action="/views_count&{{ $url->id }}" id="views_count&{{ $url->id }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $url->id }}">
                                <a href="" onclick="event.preventDefault(); document.getElementById('views_count&{{ $url->id }}').submit();">{{ $url->short_link }}</a>
                            </form>
                        </p>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </body>
</html>
