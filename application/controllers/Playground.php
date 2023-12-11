<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Playground extends CI_Controller {
    
	public function index()
	{
		return $this->load->view('welcome_message');
	}

    public function runcode()
    {
        header('Content-Type: text/html');
        try {
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                try {
                    $code = $_POST['code'] ?? 'kosong';
                    $payload = str_replace("eval(","",$code);
                    preg_match('/<\?php(.+?)\?>/s', $payload, $matches);
                    $phpCode = isset($matches[1]) ? $matches[1] : '';
                    if (!empty($phpCode)) {
                        $replcae = str_replace('desaEqualilmu','=',$phpCode);
                        $replcae = str_replace('desaPlusilmu','+',$replcae);
                        try {
                            eval($replcae);
                        } catch (Throwable $t) {
                            echo $t->getMessage();
                        }
                    }else{
                        echo 'Tidak ada blok PHP yang ditemukan';
                    }
                } catch(Throwable $e) {
                    echo 'Syntax kode error';
                }
            }
        } catch (Throwable $th) {
            echo $t->getMessage();
        }
    }
}
