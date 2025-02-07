<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class CareersController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $response = Http::get('https://ogienurdiana.com/career/ecc694ce4e7f6e45a5a7912cde9fe131')->json();
        $lines = array_filter(explode("\n", trim($response['DATA'])));
        $headers = explode("|", array_shift($lines));

        $data = collect($lines)->map(function ($line) use ($headers) {
            return array_combine($headers, explode("|", $line));
        });

        foreach ($headers as $key) {
            if ($request->filled($key)) {
                $data = $data->filter(fn($item) => strcasecmp($item[$key], $request->query($key)) === 0);
            }
        }

        $data = $data->values();

        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'data' => $data
        ], 200);
    }
}
