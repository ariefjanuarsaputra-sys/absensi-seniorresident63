<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property string $nama_kegiatan
 * @property string|null $deskripsi
 * @property string $tanggal
 * @property string $lokasi
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Presensi> $presensis
 * @property-read int|null $presensis_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kegiatan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kegiatan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kegiatan query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kegiatan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kegiatan whereDeskripsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kegiatan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kegiatan whereLokasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kegiatan whereNamaKegiatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kegiatan whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kegiatan whereTanggal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kegiatan whereUpdatedAt($value)
 */
	class Kegiatan extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property string $jenis_izin
 * @property string $tanggal_mulai
 * @property string $tanggal_selesai
 * @property string $alasan
 * @property string|null $bukti_lampiran
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Perizinan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Perizinan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Perizinan query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Perizinan whereAlasan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Perizinan whereBuktiLampiran($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Perizinan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Perizinan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Perizinan whereJenisIzin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Perizinan whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Perizinan whereTanggalMulai($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Perizinan whereTanggalSelesai($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Perizinan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Perizinan whereUserId($value)
 */
	class Perizinan extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int|null $user_id
 * @property int $kegiatan_id
 * @property string $status_kehadiran
 * @property string|null $bukti
 * @property string $status_verifikasi
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Kegiatan $kegiatan
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Presensi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Presensi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Presensi query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Presensi whereBukti($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Presensi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Presensi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Presensi whereKegiatanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Presensi whereStatusKehadiran($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Presensi whereStatusVerifikasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Presensi whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Presensi whereUserId($value)
 */
	class Presensi extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $nim
 * @property string|null $gedung
 * @property string|null $kamar
 * @property string|null $lorong
 * @property string|null $angkatan
 * @property string|null $kontak
 * @property string|null $departemen
 * @property string|null $lini
 * @property string $role
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Presensi> $presensis
 * @property-read int|null $presensis_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereAngkatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereDepartemen($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereGedung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereKamar($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereKontak($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereLini($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereLorong($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereNim($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

