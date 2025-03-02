<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/user/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['string', 'email', 'max:255', 'unique:users'],
            'nik_pasien' => ['required', 'string', 'max:16', 'unique:users'],
            'no_bpjs' => ['required', 'string', 'max:16', 'unique:users'],
            'no_hp_pasien' => ['required', 'string', 'max:16', 'unique:users'],
            'jenis_kelamin' => ['required', 'string', 'max:1'],
            'tanggal_lahir' => ['required', 'date'],
            'alamat_pasien' => ['required', 'string', 'max:255'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        DB::beginTransaction();

        try {
            // Format tanggal lahir untuk password
            $tanggalLahir = $data['tanggal_lahir']; // Contoh: 1985-03-10
            $password = substr($tanggalLahir, 8, 2) . substr($tanggalLahir, 5, 2) . substr($tanggalLahir, 2, 2);
            // Hasil password: 100385

            // Buat user baru
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'] ?? null,
                'nik_pasien' => $data['nik_pasien'],
                'no_bpjs' => $data['no_bpjs'],
                'no_hp_pasien' => $data['no_hp_pasien'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'tanggal_lahir' => $data['tanggal_lahir'],
                'alamat_pasien' => $data['alamat_pasien'],
                'password' => Hash::make($password),
            ]);

            DB::commit();

            toast('Pendaftaran berhasil', 'success');
            return $user;
        } catch (\Throwable $th) {
            DB::rollBack();
            toast('Pendaftaran gagal', 'error');
            throw $th;
        }
    }
}
