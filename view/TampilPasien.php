<?php


include("KontrakView.php");
include("presenter/ProsesPasien.php");

class TampilPasien implements KontrakView
{
	private $prosespasien; //presenter yang dapat berinteraksi langsung dengan view
	private $tpl;
	private $input_html = '<label for="nik">nik :</label>
        <input type="number" name="nik" id="nik" class="form-control" value="__NIK_VALUE__"><br>
		<label for="nama">nama :</label>
        <input type="text" name="nama" id="nama" class="form-control" value="__NAMA_VALUE__"><br>
		<label for="tempat">tempat :</label>
        <input type="text" name="tempat" id="tempat" class="form-control" value="__TEMPAT_VALUE__"><br>
		<label for="tl">tl :</label>
        <input type="date" name="tl" id="tl" class="form-control" value="__TL_VALUE__"><br>
		<label for="gender">gender :</label>
		<select name="gender" id="gender" class="form-control">
          <option value="Laki-laki">Laki-laki</option>
          <option value="Perempuan">Perempuan</option>
        </select><br>
		<label for="email">email :</label>
        <input type="text" name="email" id="email" class="form-control" value="__EMAIL_VALUE__"><br>
		<label for="telp">telp :</label>
        <input type="text" name="telp" id="telp" class="form-control" value="__TELP_VALUE__"><br>';

	function __construct()
	{
		//konstruktor
		$this->prosespasien = new ProsesPasien();
	}

	function tampil()
	{
		$this->prosespasien->prosesDataPasien();
		$data = null;

		//semua terkait tampilan adalah tanggung jawab view
		for ($i = 0; $i < $this->prosespasien->getSize(); $i++) {
			$no = $i + 1;
			$data .= "<tr>
			<td>" . $no . "</td>
			<td>" . $this->prosespasien->getNik($i) . "</td>
			<td>" . $this->prosespasien->getNama($i) . "</td>
			<td>" . $this->prosespasien->getTempat($i) . "</td>
			<td>" . $this->prosespasien->getTl($i) . "</td>
			<td>" . $this->prosespasien->getGender($i) . "</td>
			<td>" . $this->prosespasien->getEmail($i) . "</td>
			<td>" . $this->prosespasien->getTelp($i) . "</td>
			<td>
				<a href='update.php?id=" . $this->prosespasien->getId($i) . "'><button class='btn btn-primary'>Update</button></a>
				<a href='delete.php?id=" . $this->prosespasien->getId($i) . "'><button class='btn btn-danger'>Delete</button></a>
			</td>";
		}
		// Membaca template skin.html
		$this->tpl = new Template("templates/skin.html");

		// Mengganti kode Data_Tabel dengan data yang sudah diproses
		$this->tpl->replace("DATA_TABEL", $data);

		// Menampilkan ke layar
		$this->tpl->write();
	}

	function viewCreate() {
		// Membaca template form.html
		$this->tpl = new Template("templates/form.html");

		$this->tpl->replace("__INPUT_LIST__", $this->input_html);
		$this->tpl->replace("__NIK_VALUE__", "");
		$this->tpl->replace("__NAMA_VALUE__", "");
		$this->tpl->replace("__TEMPAT_VALUE__", "");
		$this->tpl->replace("__TL_VALUE__", "");
		$this->tpl->replace("__EMAIL_VALUE__", "");
		$this->tpl->replace("__TELP_VALUE__", "");

		// Menampilkan ke layar
		$this->tpl->write();
	}

	function viewUpdate($pasienId) {
		$this->prosespasien->prosesById($pasienId);

		// Membaca template form.html
		$this->tpl = new Template("templates/form.html");

		$this->tpl->replace("__INPUT_LIST__", $this->input_html);
		$this->tpl->replace("__NIK_VALUE__", $this->prosespasien->getNik(0));
		$this->tpl->replace("__NAMA_VALUE__", $this->prosespasien->getNama(0));
		$this->tpl->replace("__TEMPAT_VALUE__", $this->prosespasien->getTempat(0));
		$this->tpl->replace("__TL_VALUE__", $this->prosespasien->getTl(0));
		$this->tpl->replace("__EMAIL_VALUE__", $this->prosespasien->getEmail(0));
		$this->tpl->replace("__TELP_VALUE__", $this->prosespasien->getTelp(0));

		// Menampilkan ke layar
		$this->tpl->write();
	}

	function create($data) {
		$data = $this->prosespasien->create($data);
		header('Location: index.php');
		die();
	}
	
	function update($data, $pasienId) {
		$data = $this->prosespasien->update($data, $pasienId);
		header('Location: index.php');
		die();
	}
	
	function delete($pasienId) {
		$data = $this->prosespasien->delete($pasienId);
		header('Location: index.php');
		die();
	}
}
