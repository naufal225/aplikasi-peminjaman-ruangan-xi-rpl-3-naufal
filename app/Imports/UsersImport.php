<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class UsersImport implements ToCollection
{
    /**
     * @param Collection $collection
     */

    protected $failed_rows = [];
    protected $rows_count = 0;
    protected $created_updatedt_rows = 0;

    public function getFailedRows()
    {
        return $this->failed_rows;
    }
    public function getRowsCount()
    {
        return $this->rows_count;
    }
    public function getCreatedOrUpdatedRowsCount()
    {
        return $this->created_updatedt_rows;
    }

    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            $this->rows_count += 1;

            if (
                empty($orw["id_card"]) ||
                empty($row["username"]) ||
                empty($row["jenis_pengguna"]) ||
                empty($row["nama_lengkap"])
            ) {
                continue;
            }

            $errors = [];

            if (!in_array(strtolower($row['jenis_pengguna']), ['siswa', 'guru'])) {
                $errors[] = "Jenis pengguna tidak valid";
            }

            $existingUser = User::where('id_card', $row['id_card'])->first();

            if ($existingUser) {
                $errors[] = "ID Card '" . $row["id_card"] . "' sudah digunakan";
            }

            $existingUser = User::where('username', $row['username'])->first();

            if ($existingUser) {
                $errors[] = "Username '" . $row["username"] . "' sudah digunakan";
            }

            if (count($errors) > 0) {
                $this->failed_rows = [
                    "row" => $row,
                    "errors" => $errors
                ];
                continue;
            }

            User::updateOrCreate(
                ["id_card" => $row['id_card']],
                [
                    "id_card" => $row["id_card"],
                    "username" => $row["username"],
                    "jenis_pengguna" => strtolower($row["jenis_pengguna"]),
                    "nama_lengkap" => $row["nama_lengkap"],
                    "password" => bcrypt($row["password"]),
                    "role" => "user"
                ]
            );

            $this->created_updatedt_rows++;
        }
    }
}
