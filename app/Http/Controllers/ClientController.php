<?php

namespace App\Http\Controllers;

use App\Mail\userCreationMail;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use Illuminate\Support\Facades\Http;


class ClientController extends VoyagerBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        // Validate request data
        $validatedData = $request->validate([
            'name' => 'required|max:50',
            'prenom' => 'required|max:50',
            'email' => ['required', 'email', Rule::unique('clients')->ignore($request->id)],
            'tele' => 'required|max:10|min:10',
            'ville' => 'required|max:255',
            'testDrive' => 'boolean',
        ]);

        // Generate a random password
        $password = Str::random(8);

        // Hash the password
        $hashedPassword = Hash::make($password);

        // Save the user with the hashed password
        $user = Client::create(array_merge($validatedData, ['password'=>$hashedPassword]));

        // Send email with the password
        Mail::to($validatedData['email'])->send(new UserCreationMail($user, $password));

        // Send SMS using the API after Commande creation
        $smsResponse = Http::get('http://plateformesms.itmobility.ma/sms_web/smsenvoi.php', [
            'log' => 'renaultmaroc',
            'mp' => 'apirenault',
            'ndest' => '212' . substr($validatedData['tele'], 1),
            'message' => 'Bonjour ' . $validatedData['name'] . ' ' . $validatedData['prenom'] . ', Félicitations ! Votre compte online store M-AUTOMOTIV a bien été créé, veuillez consulter votre boite mail pour accéder à votre espace client! stopit.ma',
            'shortcode' => 'M-AUTOMOTIV',
        ]);

        // Check if SMS was sent successfully
        if ($smsResponse->successful()) {
            return response()->json(['message' => 'Commande created successfully. SMS sent.', 'user' => $user], 201);
        } else {
            return response()->json(['error' => 'Failed to send SMS. Commande created successfully.', 'user' => $user], 201);
        }

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|min:8',
            'passwordChanged' => 'required',
        ]);

        $client = Client::findOrFail($id);
        $client->password = Hash::make($request->password);
        $client->passwordChanged = $request->passwordChanged;
        $client->save();

        return redirect()->back()->with('success', 'Votre mot de passe a bien été modifié.');

    }

    public function updateAllInfo(Request $request, $id){
        $client = Client::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'ville' => 'nullable|string|max:255',
            'tele' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8',
        ]);
        if ($request->filled('password')) {
            $client->password = Hash::make($request->input('password'));
        }
        $client->update($data);
        return redirect('admin/clients');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

}
