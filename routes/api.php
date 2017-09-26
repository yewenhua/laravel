<?php

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['namespace' => 'API', 'middleware'=>['cros']], function () {
    Route::post('login', 'AuthController@login');
    Route::delete('logout', 'AuthController@logout');
    Route::post('register', 'AuthController@register');

    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::get('data', function () {
            // Just acting as a ping service.
            return response()->json(['data' => '9999'], 200);
        });
    });
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});




/*
 * add
 * use the jwt.refresh middleware, the token is refreshed on every request.
 * It's returned as a header on the response, so you need to take that header and store the new token on every request.
 * 当token失效之后，访问这个地址，把旧token带上，会得到一个新的token。自己将新token保存，访问api时使用新token。如此反复。
 * token的有效很短，默认是一个小时，刷新时间长达两个星期
 */
/*
Route::post('auth/refresh-token', ['middleware' => 'jwt.refresh', function() {
    try {
        $old_token = JWTAuth::getToken();
        $token = JWTAuth::refresh($old_token);
        JWTAuth::invalidate($old_token);
    } catch (TokenExpiredException $e) {
        throw new AuthException(
            Constants::get('error_code.refresh_token_expired'),
            trans('errors.refresh_token_expired'), $e);
    } catch (JWTException $e) {
        throw new AuthException(
            Constants::get('error_code.token_invalid'),
            trans('errors.token_invalid'), $e);
    }

    return response()->json(compact('token'));
}]);
*/
