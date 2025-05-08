<?php

namespace App\Http\Controllers\APITokens;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TokenController extends Controller
{
    /**
     * Show the user API token management screen.
     * 
     * @return \Inertia\Response
     * 
     */
    public function index(Request $request)
    {
        return Inertia::render('api-tokens/Index', [
            'tokens' => $request->user()->tokens,
            'availablePermissions' => config('keysmith.available_permissions'),
            'defaultPermissions' => config('keysmith.default_permissions'),
        ]);
    }

    /**
     * Store a new API token for the user.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     * 
     */
    public function store(Request $request)
    {
        $token = $request->user()->createToken($request->name, $request->permissions);

        $request->session()->flash('api_token', $token->plainTextToken);

        return redirect()->back();
    }

    /**
     * Update the given API token's permissions.
     * 
     * @param \Illuminate\Http\Request $request
     * @param string $tokenId
     * @return \Illuminate\Http\RedirectResponse
     * 
     */
    public function update(Request $request, $tokenId)
    {
        $token = $request->user()->tokens()->where('id', $tokenId)->firstOrFail();

        $token->forceFill([
            'abilities' => $request->permissions,
        ])->save();

        return redirect()->back();
    }

    /**
     * Delete the given API token.
     * 
     * @param \Illuminate\Http\Request $request
     * @param string $tokenId
     * @return \Illuminate\Http\RedirectResponse
     * 
     */
    public function destroy(Request $request, $tokenId)
    {
        $request->user()->tokens()->where('id', $tokenId)->delete();

        return redirect()->back();
    }
}
