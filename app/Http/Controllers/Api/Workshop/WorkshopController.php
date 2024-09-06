<?php

namespace App\Http\Controllers\Api\Workshop;

use App\Models\User;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Resources\DataResource;
use Illuminate\Support\Facades\Hash;

class WorkshopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = Workshop::all();
            return new DataResource(true, 'List Data Workshop', $data);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
           $validate = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'owner_name' => ['required', 'string', 'max:255'],
                'address' => ['required', 'string', 'max:255'],
                'email' => [ 'required', 'string', 'email', 'max:255', Rule::unique(User::class),],
                'password' => ['required','min:8'],
                'workshop_name' => ['required', 'string', 'max:255'],
                'primary_number' => ['required', 'string', 'max:255'],
                'secondary_number' => ['required', 'string', 'max:255'],
                'whatsapp_number' => ['required', 'string', 'max:255'],
            ]);
            
            $user = User::create(array_merge($validate, ['role' => 3]));
            $workshop = Workshop::create([
                'user_id' => $user->id,
                'workshop_name' => $request->workshop_name,
                'owner_name' => $request->owner_name,
                'address' => $request->address,
                'email' => $request->email,
                'primary_number' => $request->primary_number,
                'secondary_number' => $request->secondary_number,
                'whatsapp_number' => $request->whatsapp_number,
            ]);

            return new DataResource(true, 'Data Workshop Berhasilu', $workshop);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $workshop = Workshop::findOrFail($id);
            return new DataResource(true, 'Data Workshop Ditemukan', $workshop);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Data Workshop Tidak Ditemukan'], 404);
        }
    }

    
    /**
     * Display the specified resource by user id.
     */
    public function showByUserId(string $userId)
    {
        try {
            $workshop = Workshop::where('user_id', $userId)->with('user')->firstOrFail();
            return new DataResource(true, 'Data Workshop Ditemukan', $workshop);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Data Workshop Tidak Ditemukan'], 404);
        }
    }
  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validate = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'owner_name' => ['required', 'string', 'max:255'],
                'address' => ['required', 'string', 'max:255'],
                'email' => [ 'required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignore($id, 'id')],
                'password' => ['required','min:8'],
                'workshop_name' => ['required', 'string', 'max:255'],
                'primary_number' => ['required', 'string', 'max:255'],
                'secondary_number' => ['required', 'string', 'max:255'],
                'whatsapp_number' => ['required', 'string', 'max:255'],
            ]);
            
            $workshop = Workshop::findOrFail($id);
            $workshop->update([
                'user_id' => auth()->user()->id,
                'workshop_name' => $request->workshop_name,
                'owner_name' => $request->owner_name,
                'address' => $request->address,
                'email' => $request->email,
                'primary_number' => $request->primary_number,
                'secondary_number' => $request->secondary_number,
                'whatsapp_number' => $request->whatsapp_number,
            ]);

            return new DataResource(true, 'Data Workshop Berhasilu', $workshop);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

    
    /**
     * Update the specified resource by user id in storage.
     */
    public function updateByUserId(Request $request, string $userId)
    {
        try {
            $validate = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'owner_name' => ['required', 'string', 'max:255'],
                'address' => ['required', 'string', 'max:255'],
                'email' => [ 'required', 'string', 'email', 'max:255'],
                'password' => ['nullable','min:8'],
                'workshop_name' => ['required', 'string', 'max:255'],
                'primary_number' => ['required', 'string', 'max:255'],
                'secondary_number' => ['required', 'string', 'max:255'],
                'whatsapp_number' => ['required', 'string', 'max:255'],
            ]);
            
            $user = User::findOrFail($userId);
            $user->update([
                'name' => $validate['name'],
            ]);
            if ($request->password) {
                $user->update([
                    'password' => Hash::make($validate['password']),
                ]);
            }
            
            $workshop = Workshop::where('user_id', $userId)->first();
            if (!$workshop) {
                return response()->json(['error' => 'Data Workshop Tidak Ditemukan'], 404);
            }
            $workshop->update([
                'workshop_name' => $request->workshop_name,
                'owner_name' => $request->owner_name,
                'address' => $request->address,
                'email' => $request->email,
                'primary_number' => $request->primary_number,
                'secondary_number' => $request->secondary_number,
                'whatsapp_number' => $request->whatsapp_number,
            ]);

            return new DataResource(true, 'Data Workshop Berhasilu', $workshop);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $workshop = Workshop::where('id', $id)->first();
            if (!$workshop) {
                return response()->json(['error' => 'Data Workshop Tidak Ditemukan'], 404);
            }
            $workshop->delete();
            return new DataResource(true, 'Data Workshop Berhasil Dihapus', null);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }
}
