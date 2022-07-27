@extends("layouts.layout")

@section("content")
<div class="container">
    <div class="row">
        <div class="messages mt-2 col-12">
            @if(session()->get("messages"))
                @foreach(session()->get("messages") as $message)
                    <div class="alert alert-warning text-center">{{$message}}</div>
                @endforeach
            @endif
        </div>
    </div>

    <div class="col-12 h-100vh mt-5">
        <h1 class="text-center display-1 lead mb-5">SHORTLINKS</h1>
        <form class="row bg-light pt-3 pb-3 text-dark">
            <div class="col-6">
                <label for="url" class="form-label">Ваш URL-адрес</label>
                <input type="url" id="link-url" class="form-control col-7" name="Link[url]" placeholder="shortlink.local ...">
            </div>
            <div class="col-6">
                <label for="short-url" class="form-label">Короткий URL</label>
                <input type="url" id="short-url" class="form-control col-7" name="Link[short]" placeholder="...">
            </div>
            <div class="col-12 mt-2 d-flex justify-content-center">
                <button class="btn btn-primary " type="button" id="submit-button">Создать</button>
            </div>
        </form>
    </div>
</div>

@endsection
