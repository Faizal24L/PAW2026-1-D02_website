
<?php
    function cekKosong($field){
		$cek = trim($field);
		return empty($cek);
	}
    
    # validasi masukan format alfabet untuk username
    function valUsername($err, $field){

    }

    #validasi masukan format numerik untuk nomor telepon
    function valNomor($err, $field){
        $pattern = "/^[0-9]{10,12}$/";
		
		if (cekKosong($field)){
			$errors["nomor"] = "nomor wajib di isi!";
		}elseif(!preg_match($pattern, $field)){
			$errors["nomor"] = "nomor wajib angka, setidaknya 10-12 digit";
		}
    }

    # validasi masukan format password
    function valPassword($err, $field){

    }

    # validsi untuk masukan format tanggal untuk tanggal lahir
    function tanggalLahir($err, $field){

    }

?>