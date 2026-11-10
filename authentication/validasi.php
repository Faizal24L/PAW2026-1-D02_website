
<?php
    function cekKosong($field){
		$cek = trim($field);
		return empty($cek);
	}
    
    // validasi masukan format alfabet untuk username
    function valUsername(&$errors, $field){
        $pattern = "/^[a-zA-Z ]+$/";
		
		if (cekKosong($field)){
			$errors["username"] = "Username wajib di isi!";
		}elseif(!preg_match($pattern, $field)){
			$errors["username"] = "username wajib berupa huruf ";
		}
    }

    // validasi masukan format numerik untuk nomor telepon
    function valNomor(&$errors, $field){
        $pattern = "/^[0-9]{10,12}$/";
		
		if (cekKosong($field)){
			$errors["nomor"] = "nomor wajib di isi!";
		}elseif(!preg_match($pattern, $field)){
			$errors["nomor"] = "nomor wajib angka, setidaknya 10-12 digit";
		}
    }

    // validasi masukan format password
    function valPassword(&$errors, $field){
        $pattern = "/^[0-9A-Za-z!@#$%^&*]{8,}$/";

        if (cekKosong($field)){
            $errors["password"] = "password wajib di isi";
        } elseif (!preg_match($pattern, $field)){
            $errors["password"] = "Minimal panjang karakter delapa";
        }
    }

    // validsi untuk masukan format tanggal untuk tanggal lahir
    function tanggalLahir(&$errors, $field){
        $pattern = "/^[0-9]{1,2}-[0-9]{1,2}[1-9]{4}$/";
        
        if (cekKosong($field)){
            $errors["tanggal Lahir"] = "tanggal lahir wajib di isi";
        } elseif(!preg_match($pattern, $field)){
            $errors["tanggal lahir"] = "tanggal lahir wajib angka";
        }
    }

?>