<?php

/******************************************
Asisten Pemrogaman 13
 ******************************************/

class TabelPasien extends DB
{
	function getPasien()
	{
		// Query mysql select data pasien
		$query = "SELECT * FROM pasien";
		// Mengeksekusi query
		return $this->execute($query);
	}

	function getPasienById($pasienId)
	{
		// Query mysql select data pasien
		$query = "SELECT * FROM pasien WHERE id = $pasienId";
		// Mengeksekusi query
		return $this->execute($query);
	}

	public function create($data) {
        $query = "INSERT INTO pasien VALUES (null, '$data[nik]', '$data[nama]', '$data[tempat]', '$data[tl]', '$data[gender]', '$data[email]', '$data[telp]')";
        return $this->execute($query);
    }

    public function update($data, $pasien_id) {
        $query = "UPDATE pasien SET";
        print_r($data);
        foreach($data as $key => $value) {
            if(is_string($value)) $query .= " $key = '$value',";
            else $query .= " $key = $value,";
        }
        $query = substr($query, 0, -1);
        $query .= " WHERE id = $pasien_id";

        echo $query;
        return $this->execute($query);
    }

    public function delete($pasien_id) {
        $query = "DELETE FROM pasien WHERE id = $pasien_id";
        return $this->execute($query);
    }
}
