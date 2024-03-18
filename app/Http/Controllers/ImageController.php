<?php



namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ImageController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View{
        return view('imageUpload');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = Auth::user()->nom.'.'.$request->image->extension();
        $request->image->move(public_path('img'), $imageName);
        Participant::query()->where('nom',Auth::user()->nom)->update(['photo'=>$imageName]);

        /*

            Write Code Here for

            Store $imageName name in DATABASE from HERE

        */



        return back()

            ->with('success', 'You have successfully upload image.')
            ->with('image', $imageName);

    }

}
