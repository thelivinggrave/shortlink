<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        return view("index");
    }

    public function redirect_to(Request $request, $code)
    {
        $link = Link::where(["code" => $code])->first();

        if (!$link)
        {
            session()->flash("messages", [
                "warning" => "Данная ссылка не существует!",
            ]);
            return redirect(route("index"));
        }

        $link->save();

        return redirect($link->url);
    }

    public function ajax(Request $request)
    {
        if (!$request->ajax())
            return response("Wrong AJAX request!", 500);

        $link = Link::where(["url" => $request->post("url")])->first();
        if (!$link)
        {
            $link = new Link;
            $link->url = str($request->post("url"));
            $link->save();
        }

        header("Content-type: application/json");

        return json_encode([
            "url" => $link->url,
            "code" => $link->code,
            "clicks" => $link->clicks
        ]);
    }
}
