<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        $this->middleware('adminonly');
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $users = User::query();
    
        if (!empty($search)) {
            $users->where('name', 'LIKE', '%' . $search . '%');
        }
    
        $users = $users->paginate(10);
    
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create'); // You should return a view for creating a new user
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
   {
    $user = User::create($request->all());

    if ($user) {
        // Send email verification notification
        $user->sendEmailVerificationNotification();

        return redirect()->back()->with('success', 'User created successfully');
    }

    return redirect()->back()->with('error', 'User creation failed');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit()
    {
       
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user) {
            $user->delete();
            return redirect()->route('users.index')->with('success', 'User deleted successfully');
        } else {
            return redirect()->route('users.index')->with('error', 'User not found');
        }
    }
}






