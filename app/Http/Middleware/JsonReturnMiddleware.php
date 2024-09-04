<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\Response;

class JsonReturnMiddleware
{
    /**
     * The Response Factory our app uses
     *
     * @var ResponseFactory
     */
    protected ResponseFactory $factory;

    /**
     * JsonMiddleware constructor.
     *
     * @param ResponseFactory $factory
     */
    public function __construct(ResponseFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $request->headers->set('Accept', 'application/json');
        $response = $next($request);
        $code = $response->status();
        $ok = floor($code / 100) == 2;
        $data_key = $ok ? 'data' : 'error';
        $err_key = $ok ? 'error' : 'data';
        if (!in_array($response->status(), [401, 403, 404, 422, 501/*500, 503*/])) {
            $response->setStatusCode(200);
        }
        if ($response instanceof JsonResponse) {
            $data = $ok ? $response->getData(true) : ($response->getData(true)['error'] ?? 'Internal Error');
        } else {
            $result = $response->content();
            if (($result instanceof Collection)) {
                $result = $result->toArray();
            }
            if (is_string($result)) {
                $result = ['message' => $result];
            }
            $data = Arr::get($result, 'data');
        }
        if ($meta = Arr::get($data, 'meta')) {
            $meta = [
                'currentPage' => $meta["current_page"],
                'pageCount' => $meta["last_page"],
                'perPage' => $meta["per_page"],
                'totalCount' => $meta["total"],
            ];
            $data = Arr::get($data, 'data');
        }
        if (Arr::get($data, 'links')) {
            $meta = [
                'currentPage' => $data["current_page"],
                'pageCount' => $data["last_page"],
                'perPage' => $data["per_page"],
                'totalCount' => $data["total"],
            ];
            $data = Arr::get($data, 'data');
        }
        $content = [
            'success' => $ok,
            $data_key => $data,
            'meta' => $meta ?? [],
            $err_key => null,
        ];

        return $this->factory->json($content, $response->status(), $response->headers->all());
    }
}
