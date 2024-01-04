<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Auth;

class ControllerUser extends Controller
{
	public function index(){
		return redirect('user/profil');
	}

	public function profil(){
		$user = Auth::user();

		return view('user.index', compact('user'));
	}

	public function simpan_profil(){
		$this->_validate_profil();

		if (Request()->foto_baru != '') {
			$foto = Request()->foto_baru;
			$new_foto = time() . '.' . $foto->extension();
			$foto->move(public_path('uploads/'),$new_foto);
			$foto_lama = Auth::user()->foto;

			if ($foto_lama != 'default.png') {
				unlink(public_path('uploads/').$foto_lama);
			}

			$data['foto'] = $new_foto;
			User::whereId(Auth::user()->id)->update($data);
		}

		$data = [
			'name' => Request()->nama_user,
			'email' => Request()->email_user
		];

		User::whereId(Auth::user()->id)->update($data);

		echo json_encode(["status" => TRUE]);
	}

	public function password(){
		return view('user.password');
	}

	public function simpan_password(){
		$this->_validate_password();

		$data = [
			'password' => bcrypt(Request()->conf_pass)
		];

		User::whereId(Auth::user()->id)->update($data);

		echo json_encode(["status" => TRUE]);
	}

	private function _validate_profil(){
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if(Request()->nama_user == ''){
			$data['inputerror'][] = 'nama_user';
			$data['error_string'][] = 'Nama tidak boleh kosong';
			$data['status'] = FALSE;
		}

		if(Request()->email_user == ''){
			$data['inputerror'][] = 'email_user';
			$data['error_string'][] = 'Email tidak boleh kosong';
			$data['status'] = FALSE;
		} else {
			if (!filter_var(Request()->email_user, FILTER_VALIDATE_EMAIL)) {
				$data['inputerror'][] = 'email_user';
				$data['error_string'][] = 'Format email salah';
				$data['status'] = FALSE;
			}
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

	private function _validate_password(){
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if(Request()->pass_lama == ''){
			$data['inputerror'][] = 'pass_lama';
			$data['error_string'][] = 'Password lama tidak boleh kosong ';
			$data['status'] = FALSE;
		} else {
			if (!(Hash::check(Request()->pass_lama, Auth::user()->password))) {
				$data['inputerror'][] = 'pass_lama';
				$data['error_string'][] = 'Password lama Salah';
				$data['status'] = FALSE;
			}
		}

		if(Request()->pass_baru == ''){
			$data['inputerror'][] = 'pass_baru';
			$data['error_string'][] = 'Password Baru tidak boleh kosong';
			$data['status'] = FALSE;
		}

		if (Request()->conf_pass == '') {
			$data['inputerror'][] = 'conf_pass';
			$data['error_string'][] = 'Konfirmasi password tidak boleh kosong';
			$data['status'] = FALSE;
		} else {
			if (Request()->conf_pass != Request()->pass_baru) {
				$data['inputerror'][] = 'conf_pass';
				$data['error_string'][] = 'Password tidak sama';
				$data['status'] = FALSE;
			}
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
}
