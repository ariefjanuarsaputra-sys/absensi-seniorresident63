<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        // 1. Akun Admin Utama
        User::updateOrCreate(
            ['email' => 'barista63sr@gmail.com'],
            [
                'name'       => 'Admin Barista 63',
                'nim'        => 'ADMIN63',
                'gedung'     => null,
                'kamar'      => null,
                'lorong'     => null,
                'angkatan'   => '63',
                'kontak'     => null,
                'departemen' => null,
                'lini'       => 'Administrator',
                'role'       => 'admin',
                'password'   => Hash::make('ADMIN63', ['rounds' => 4]),
            ]
        );

        // 2. Data Anggota Senior Resident (60 User)
        $users = [
            ['name' => 'Afdrelia Utari Azizah', 'email' => 'afdreliautariazizah@apps.ipb.ac.id', 'nim' => 'E3401231045', 'gedung' => 'A4', 'kamar' => '318', 'lorong' => '3A', 'angkatan' => '60', 'kontak' => '6282383804859', 'departemen' => 'Konservasi Sumberdaya, Hutan dan Ekowisata/FAHUTAN', 'lini' => 'Media Branding', 'role' => 'anggota'],
            ['name' => 'Afif Syarifuddin Senjaya', 'email' => 'afifsyarifuddinsenjaya@apps.ipb.ac.id', 'nim' => 'D3401231043', 'gedung' => 'C1', 'kamar' => '57', 'lorong' => '7', 'angkatan' => '60', 'kontak' => '62895338428436', 'departemen' => 'Teknologi Hasil Ternak/FAPET', 'lini' => 'Manajemen Program', 'role' => 'anggota'],
            ['name' => 'Ahmad Nur Hidayatullah', 'email' => 'nuurhidayatullah@apps.ipb.ac.id', 'nim' => 'E1401241021', 'gedung' => 'C1', 'kamar' => '105', 'lorong' => '4', 'angkatan' => '61', 'kontak' => '62895424628787', 'departemen' => 'Manajemen Hutan/FAHUTAN', 'lini' => 'Gugus Disiplin Asrama', 'role' => 'anggota'],
            ['name' => 'Ahmad Syekhoni', 'email' => 'syekhoniahmad@apps.ipb.ac.id', 'nim' => 'G3401241081', 'gedung' => 'C3', 'kamar' => '336', 'lorong' => '10', 'angkatan' => '61', 'kontak' => '6285774911334', 'departemen' => 'Biologi/FMIPA', 'lini' => 'Club', 'role' => 'pj_gedung'],
            ['name' => 'Ai Siti Robiah', 'email' => 'aisitirobiah@apps.ipb.ac.id', 'nim' => 'A2401231088', 'gedung' => 'A4', 'kamar' => '318', 'lorong' => '3B', 'angkatan' => '60', 'kontak' => '6285793473684', 'departemen' => 'Agronomi dan Hortikultura/FAPERTA', 'lini' => 'Sekretaris/Badan Pengurus Harian', 'role' => 'anggota'],
            ['name' => 'Amalina Qurrotu\'Aini Fajarudin', 'email' => 'ainiamalina@apps.ipb.ac.id', 'nim' => 'G4401241105', 'gedung' => 'A2', 'kamar' => '172', 'lorong' => '1 & 5', 'angkatan' => '61', 'kontak' => '6285157292285', 'departemen' => 'Kimia/FMIPA', 'lini' => 'Mental, Spiritual dan Kesejahteraan', 'role' => 'anggota'],
            ['name' => 'Aqila Puspa Nurhana', 'email' => 'aqilapuspanurhana@apps.ipb.ac.id', 'nim' => 'A1401231072', 'gedung' => 'A2', 'kamar' => 'MU', 'lorong' => '7', 'angkatan' => '60', 'kontak' => '6283846357232', 'departemen' => 'Manajemen Sumberdaya Lahan/FAPERTA', 'lini' => 'Media Branding', 'role' => 'anggota'],
            ['name' => 'Arief Januar Saputra', 'email' => 'ajs_24arief@apps.ipb.ac.id', 'nim' => 'G2401241033', 'gedung' => 'C3', 'kamar' => '244', 'lorong' => '1&2', 'angkatan' => '61', 'kontak' => '6282217742436', 'departemen' => 'Geofisika dan Meteorologi/FMIPA', 'lini' => 'Biro Riset dan Analisis Data', 'role' => 'anggota'],
            ['name' => 'Atikah Nurhasanah', 'email' => 'atikahnurhasanah@apps.ipb.ac.id', 'nim' => 'A1401241058', 'gedung' => 'A2', 'kamar' => '172', 'lorong' => '2 & 3', 'angkatan' => '61', 'kontak' => '6289515408079', 'departemen' => 'Manajemen Sumberdaya Lahan/FAPERTA', 'lini' => 'Club', 'role' => 'anggota'],
            ['name' => 'Ayu Kesuma Ningtyas', 'email' => 'ayukesumaningtyas@apps.ipb.ac.id', 'nim' => 'A2401241095', 'gedung' => 'A3', 'kamar' => '406', 'lorong' => '4', 'angkatan' => '61', 'kontak' => '628559862556', 'departemen' => 'Agronomi dan Hortikultura/FAPERTA', 'lini' => 'Pengembangan Sumber Daya Manusia', 'role' => 'pj_gedung'],
            ['name' => 'Billy Afrirangga Rasco', 'email' => 'billyafrirangga@apps.ipb.ac.id', 'nim' => 'A2401231005', 'gedung' => 'C3', 'kamar' => '311', 'lorong' => '7&8', 'angkatan' => '60', 'kontak' => '6282180330051', 'departemen' => 'Agronomi dan Hortikultura/FAPERTA', 'lini' => 'Pengembangan Sumber Daya Manusia', 'role' => 'anggota'],
            ['name' => 'Bunga Ayu Damayanti Fauziah', 'email' => 'bungaayudamayanti@apps.ipb.ac.id', 'nim' => 'C4401241030', 'gedung' => 'A5', 'kamar' => '220', 'lorong' => '2B', 'angkatan' => '61', 'kontak' => '6285872826548', 'departemen' => 'Pemanfaatan Sumberdaya Perikanan/FPIK', 'lini' => 'Senior Resident Pendamping Ormawa', 'role' => 'pj_gedung'],
            ['name' => 'Cut Khairunnisa', 'email' => 'cutkhairunnisa@apps.ipb.ac.id', 'nim' => 'G3401241068', 'gedung' => 'A5', 'kamar' => '508', 'lorong' => '5A & 5B', 'angkatan' => '61', 'kontak' => '6281387764767', 'departemen' => 'Biologi/FMIPA', 'lini' => 'Mental, Spiritual dan Kesejahteraan', 'role' => 'anggota'],
            ['name' => 'Daffa Faaiz Al-Zakkii', 'email' => 'daffa13faaiz@apps.ipb.ac.id', 'nim' => 'M0401241027', 'gedung' => 'C1', 'kamar' => '20', 'lorong' => '1&2', 'angkatan' => '61', 'kontak' => '6285775509768', 'departemen' => 'Statistika dan Sains Data/SSMI', 'lini' => 'Biro Riset dan Analisis Data', 'role' => 'anggota'],
            ['name' => 'Dagna Bayanaka Atmaja', 'email' => 'dagna123atmaja@apps.ipb.ac.id', 'nim' => 'G4401241083', 'gedung' => 'A5', 'kamar' => '508', 'lorong' => '4B', 'angkatan' => '61', 'kontak' => '62895391757639', 'departemen' => 'Kimia/FMIPA', 'lini' => 'Manajemen Program', 'role' => 'anggota'],
            ['name' => 'Devi Triana Candra', 'email' => 'candradevi@apps.ipb.ac.id', 'nim' => 'D2401241094', 'gedung' => 'A5', 'kamar' => '220', 'lorong' => '2A', 'angkatan' => '61', 'kontak' => '6282118300126', 'departemen' => 'Ilmu Nutrisi dan Teknologi Pakan/FAPET', 'lini' => 'Manajemen Program', 'role' => 'anggota'],
            ['name' => 'Een Dwi Arum Sari', 'email' => 'eendwiarumsari@apps.ipb.ac.id', 'nim' => 'A3401231028', 'gedung' => 'A2', 'kamar' => 'MU', 'lorong' => '6', 'angkatan' => '60', 'kontak' => '6287876159155', 'departemen' => 'Proteksi Tanaman/FAPERTA', 'lini' => 'Manajemen Program', 'role' => 'anggota'],
            ['name' => 'Efqi Putra Hesi Alfasyah', 'email' => 'efqiputra@apps.ipb.ac.id', 'nim' => 'C3401241009', 'gedung' => 'SED2', 'kamar' => '2.19', 'lorong' => '4', 'angkatan' => '61', 'kontak' => '6281291336757', 'departemen' => 'Teknologi Hasil Perairan/FPIK', 'lini' => 'Pengembangan Sumber Daya Manusia', 'role' => 'pj_gedung'],
            ['name' => 'Eirosa Farhah Afifah Amatillah', 'email' => 'eirosafarhah@apps.ipb.ac.id', 'nim' => 'G3401231084', 'gedung' => 'A1', 'kamar' => '128', 'lorong' => '9', 'angkatan' => '60', 'kontak' => '6288211590168', 'departemen' => 'Biologi/FMIPA', 'lini' => 'Mental, Spiritual dan Kesejahteraan', 'role' => 'anggota'],
            ['name' => 'Euris', 'email' => 'garuteuris@apps.ipb.ac.id', 'nim' => 'G8401241045', 'gedung' => 'A1', 'kamar' => '41', 'lorong' => '1 & 6', 'angkatan' => '61', 'kontak' => '6285174357914', 'departemen' => 'Biokimia/FMIPA', 'lini' => 'Senior Resident Pendamping Ormawa', 'role' => 'anggota'],
            ['name' => 'Fabio Desen Putra', 'email' => 'putrafabio@apps.ipb.ac.id', 'nim' => 'G8401231006', 'gedung' => 'SED2', 'kamar' => '2.19', 'lorong' => '2A', 'angkatan' => '60', 'kontak' => '62895348757484', 'departemen' => 'Biokimia/FMIPA', 'lini' => 'Senior Resident Pendamping Ormawa', 'role' => 'anggota'],
            ['name' => 'Fachra Rofi Ariandi', 'email' => 'fachraariandirofi@apps.ipb.ac.id', 'nim' => 'G0401241030', 'gedung' => 'SED1', 'kamar' => '39', 'lorong' => '2B', 'angkatan' => '61', 'kontak' => '6287728021058', 'departemen' => 'Bioinformatika/FMIPA', 'lini' => 'Club', 'role' => 'pj_gedung'],
            ['name' => 'Faiz Habibi Rahman', 'email' => 'faizhabibirahman@apps.ipb.ac.id', 'nim' => 'D1401241041', 'gedung' => 'SED2', 'kamar' => '2.19', 'lorong' => '3', 'angkatan' => '61', 'kontak' => '6282120035150', 'departemen' => 'Ilmu Produksi dan Teknologi Peternakan/FAPET', 'lini' => 'Manajemen Program', 'role' => 'anggota'],
            ['name' => 'Farhana Ginanti Maharani', 'email' => 'frgginanti@apps.ipb.ac.id', 'nim' => 'G5401231008', 'gedung' => 'A3', 'kamar' => 'MU', 'lorong' => '7', 'angkatan' => '60', 'kontak' => '6285861715249', 'departemen' => 'Matematika/SSMI', 'lini' => 'Club', 'role' => 'anggota'],
            ['name' => 'Faridatun Ainun Nisha', 'email' => 'faridaaa99nisha@apps.ipb.ac.id', 'nim' => 'C2401231024', 'gedung' => 'A1', 'kamar' => '128', 'lorong' => '10', 'angkatan' => '60', 'kontak' => '6285795148303', 'departemen' => 'Manajemen Sumberdaya Perairan/FPIK', 'lini' => 'Gugus Disiplin Asrama', 'role' => 'anggota'],
            ['name' => 'Fathan Nurhuda', 'email' => 'fathanurhuda@apps.ipb.ac.id', 'nim' => 'E3401241148', 'gedung' => 'C1', 'kamar' => '105', 'lorong' => '10', 'angkatan' => '61', 'kontak' => '6281211924291', 'departemen' => 'Konservasi Sumberdaya, Hutan dan Ekowisata/FAHUTAN', 'lini' => 'Senior Resident Pendamping Ormawa', 'role' => 'anggota'],
            ['name' => 'Gina Amalia', 'email' => 'giamalia@apps.ipb.ac.id', 'nim' => 'G4401241017', 'gedung' => 'A4', 'kamar' => '508', 'lorong' => '1', 'angkatan' => '61', 'kontak' => '6282130194027', 'departemen' => 'Kimia/FMIPA', 'lini' => 'Senior Resident Pendamping Ormawa', 'role' => 'pj_gedung'],
            ['name' => 'Halimah Nur Khasanah', 'email' => 'rasyifaylanur@apps.ipb.ac.id', 'nim' => 'A3401231004', 'gedung' => 'A5', 'kamar' => '316', 'lorong' => '4A', 'angkatan' => '60', 'kontak' => '6281578190068', 'departemen' => 'Proteksi Tanaman/FAPERTA', 'lini' => 'Club', 'role' => 'anggota'],
            ['name' => 'Indah Siti Halimah', 'email' => 'indahsitihalimah@apps.ipb.ac.id', 'nim' => 'H5401231002', 'gedung' => 'A2', 'kamar' => 'MU', 'lorong' => 'Komandanwati', 'angkatan' => '60', 'kontak' => '6289517773090', 'departemen' => 'Ekonomi Syariah/FEM', 'lini' => 'Komandanwati/Badan Pengurus Harian', 'role' => 'anggota'],
            ['name' => 'Kania Aulia Andita', 'email' => 'kaniaaulia@apps.ipb.ac.id', 'nim' => 'C4401241093', 'gedung' => 'A1', 'kamar' => '62', 'lorong' => '4', 'angkatan' => '61', 'kontak' => '6282282592405', 'departemen' => 'Pemanfaatan Sumberdaya Perikanan/FPIK', 'lini' => 'Pengembangan Sumber Daya Manusia', 'role' => 'pj_gedung'],
            ['name' => 'Khalifatunadifah', 'email' => 'difa_akhalifatunadifah@apps.ipb.ac.id', 'nim' => 'A3401231014', 'gedung' => 'A3', 'kamar' => 'MU', 'lorong' => '6', 'angkatan' => '60', 'kontak' => '6281286182047', 'departemen' => 'Proteksi Tanaman/FAPERTA', 'lini' => 'Senior Resident Pendamping Ormawa', 'role' => 'anggota'],
            ['name' => 'Kusuma Ayu Kinanthi', 'email' => 'kusumaaayu@apps.ipb.ac.id', 'nim' => 'A2401241080', 'gedung' => 'A2', 'kamar' => '271', 'lorong' => '8 & 10', 'angkatan' => '61', 'kontak' => '628994675060', 'departemen' => 'Agronomi dan Hortikultura/FAPERTA', 'lini' => 'Biro Riset dan Analisis Data', 'role' => 'anggota'],
            ['name' => 'Meisya Larasati', 'email' => 'meisya16larasati@apps.ipb.ac.id', 'nim' => 'D1401231037', 'gedung' => 'A5', 'kamar' => '316', 'lorong' => '3A', 'angkatan' => '60', 'kontak' => '6283866042435', 'departemen' => 'Ilmu Produksi dan Teknologi Peternakan', 'lini' => 'Biro Riset dan Analisis Data', 'role' => 'anggota'],
            ['name' => 'Mohammad Farkhan Tsani', 'email' => 'mohammadfarkhan@apps.ipb.ac.id', 'nim' => 'A1401231004', 'gedung' => 'C1', 'kamar' => '57', 'lorong' => 'Komandan', 'angkatan' => '60', 'kontak' => '6285866212110', 'departemen' => 'Manajemen Sumberdaya Lahan/FAPERTA', 'lini' => 'Komandan/Badan Pengurus Harian', 'role' => 'anggota'],
            ['name' => 'Muhamad Farhan Samsuri', 'email' => 'mfarhans20farhan@apps.ipb.ac.id', 'nim' => 'G3401231072', 'gedung' => 'C1', 'kamar' => '87', 'lorong' => '9', 'angkatan' => '60', 'kontak' => '6282115376956', 'departemen' => 'Biologi/FMIPA', 'lini' => 'Biro Riset dan Analisis Data', 'role' => 'anggota'],
            ['name' => 'Muhammad Abdul Aziz', 'email' => 'abdulmuhaziz@apps.ipb.ac.id', 'nim' => 'H5401231044', 'gedung' => 'C1', 'kamar' => '87', 'lorong' => '8', 'angkatan' => '60', 'kontak' => '6287870873490', 'departemen' => 'Ekonomi Syariah/FEM', 'lini' => 'Mental, Spiritual dan Kesejahteraan', 'role' => 'anggota'],
            ['name' => 'Muhammad Adhiel Ilyasa', 'email' => 'ilyasaadhiel@apps.ipb.ac.id', 'nim' => 'D3401231051', 'gedung' => 'C3', 'kamar' => '280', 'lorong' => '5', 'angkatan' => '60', 'kontak' => '6285719080393', 'departemen' => 'Teknologi Hasil Ternak/FAPET', 'lini' => 'Club', 'role' => 'anggota'],
            ['name' => 'Muhammad Musa', 'email' => '77musamuhammad@apps.ipb.ac.id', 'nim' => 'F1401231003', 'gedung' => 'C3', 'kamar' => '280', 'lorong' => '4', 'angkatan' => '60', 'kontak' => '6289629647525', 'departemen' => 'Teknik Mesin dan Biosistem/FTT', 'lini' => 'Media Branding', 'role' => 'anggota'],
            ['name' => 'Naila Tsalisa Maulidia', 'email' => 'nailatsalisamaulidia@apps.ipb.ac.id', 'nim' => 'E1401241085', 'gedung' => 'A3', 'kamar' => '406', 'lorong' => '8 & 10', 'angkatan' => '61', 'kontak' => '6285863927496', 'departemen' => 'Manajemen Hutan/FAHUTAN', 'lini' => 'Media Branding', 'role' => 'anggota'],
            ['name' => 'Najwa Afifah Maulidina', 'email' => '1513najwaafifah@apps.ipb.ac.id', 'nim' => 'A3401231090', 'gedung' => 'A4', 'kamar' => '318', 'lorong' => '2A', 'angkatan' => '60', 'kontak' => '6285651396918', 'departemen' => 'Proteksi Tanaman/FAPERTA', 'lini' => 'Pengembangan Sumber Daya Manusia', 'role' => 'anggota'],
            ['name' => 'Nisrina Fathya', 'email' => 'nisrinafathya@apps.ipb.ac.id', 'nim' => 'C1401231094', 'gedung' => 'A3', 'kamar' => 'MU', 'lorong' => '9', 'angkatan' => '60', 'kontak' => '6285163008105', 'departemen' => 'Budidaya Perairan/FPIK', 'lini' => 'Manajemen Program', 'role' => 'anggota'],
            ['name' => 'Novia Cahya Putri', 'email' => 'nviacptrnovia@apps.ipb.ac.id', 'nim' => 'G8401231040', 'gedung' => 'A5', 'kamar' => '316', 'lorong' => '3B', 'angkatan' => '60', 'kontak' => '628579368888', 'departemen' => 'Biokimia/FMIPA', 'lini' => 'Pengembangan Sumber Daya Manusia', 'role' => 'anggota'],
            ['name' => 'Nur Rokhmah Wati', 'email' => 'nrw755nur@apps.ipb.ac.id', 'nim' => 'G3401241079', 'gedung' => 'A1', 'kamar' => '41', 'lorong' => '2 & 3', 'angkatan' => '61', 'kontak' => '6281212203443', 'departemen' => 'Biologi/FMIPA', 'lini' => 'Club', 'role' => 'anggota'],
            ['name' => 'Putri Andini', 'email' => 'putriandiniputri@apps.ipb.ac.id', 'nim' => 'E3401241025', 'gedung' => 'A2', 'kamar' => '172', 'lorong' => '4', 'angkatan' => '61', 'kontak' => '6281532598419', 'departemen' => 'Konservasi Sumberdaya, Hutan dan Ekowisata/FAHUTAN', 'lini' => 'Pengembangan Sumber Daya Manusia', 'role' => 'pj_gedung'],
            ['name' => 'Putri Juliani Indri', 'email' => 'putrijuliani@apps.ipb.ac.id', 'nim' => 'G8401241024', 'gedung' => 'A4', 'kamar' => '401', 'lorong' => '2B', 'angkatan' => '61', 'kontak' => '6289507048691', 'departemen' => 'Biokimia/FMIPA', 'lini' => 'Manajemen Program', 'role' => 'anggota'],
            ['name' => 'Rifal Mugas Madani', 'email' => 'rifalmadani@apps.ipb.ac.id', 'nim' => 'A2401241102', 'gedung' => 'C1', 'kamar' => '105', 'lorong' => '5&6', 'angkatan' => '61', 'kontak' => '6281374612627', 'departemen' => 'Agronomi dan Hortikultura/FAPERTA', 'lini' => 'Media Branding', 'role' => 'anggota'],
            ['name' => 'Rosi Rodiyatussolihah', 'email' => 'rosirodiyatussolihah@apps.ipb.ac.id', 'nim' => 'A2401241082', 'gedung' => 'A1', 'kamar' => '62', 'lorong' => '5', 'angkatan' => '61', 'kontak' => '6281398261847', 'departemen' => 'Agronomi dan Hortikultura/FAPERTA', 'lini' => 'Manajemen Program', 'role' => 'anggota'],
            ['name' => 'Rosita', 'email' => 'tata1906rosita@apps.ipb.ac.id', 'nim' => 'C2401241074', 'gedung' => 'A4', 'kamar' => '508', 'lorong' => '5A & 5B', 'angkatan' => '61', 'kontak' => '6283862421462', 'departemen' => 'Manajemen Sumberdaya Perairan/FPIK', 'lini' => 'Gugus Disiplin Asrama', 'role' => 'anggota'],
            ['name' => 'Ryan Pebriansyah', 'email' => 'pebriansyahryan@apps.ipb.ac.id', 'nim' => 'G5401231042', 'gedung' => 'C3', 'kamar' => '311', 'lorong' => '9', 'angkatan' => '60', 'kontak' => '6289509867027', 'departemen' => 'Matematika/FMIPA', 'lini' => 'Manajemen Program', 'role' => 'anggota'],
            ['name' => 'Siti Atasyah Putri', 'email' => 'statasyahsiti@apps.ipb.ac.id', 'nim' => 'G8401241062', 'gedung' => 'A2', 'kamar' => '271', 'lorong' => '9', 'angkatan' => '61', 'kontak' => '6282219801308', 'departemen' => 'Biokimia/FMIPA', 'lini' => 'Senior Resident Pendamping Ormawa', 'role' => 'anggota'],
            ['name' => 'Siti Nur Aisyah', 'email' => 'raisya271siti@apps.ipb.ac.id', 'nim' => 'H5401241008', 'gedung' => 'A3', 'kamar' => '297', 'lorong' => '1 & 5', 'angkatan' => '61', 'kontak' => '6288806140242', 'departemen' => 'Ekonomi Syariah/FEM', 'lini' => 'Biro Riset dan Analisis Data', 'role' => 'anggota'],
            ['name' => 'Steven Rizky Marctinus Sitohang', 'email' => 'stevensitohang@apps.ipb.ac.id', 'nim' => 'G4401241023', 'gedung' => 'C3', 'kamar' => '244', 'lorong' => '3', 'angkatan' => '61', 'kontak' => '6281264888173', 'departemen' => 'Kimia/FMIPA', 'lini' => 'Mental, Spiritual dan Kesejahteraan', 'role' => 'anggota'],
            ['name' => 'Surya Muharram Hidayatulloh', 'email' => '31suryamuharram@apps.ipb.ac.id', 'nim' => 'E4401241027', 'gedung' => 'C3', 'kamar' => '336', 'lorong' => '6', 'angkatan' => '61', 'kontak' => '6285261464374', 'departemen' => 'Silvikultur/FAHUTAN', 'lini' => 'Senior Resident Pendamping Ormawa', 'role' => 'anggota'],
            ['name' => 'Syarif Hidayat Nur Ichsan', 'email' => 'hidayatnurichsan@apps.ipb.ac.id', 'nim' => 'F4401231011', 'gedung' => 'SED2', 'kamar' => '2.19', 'lorong' => '1', 'angkatan' => '60', 'kontak' => '6285766688393', 'departemen' => 'Teknik Sipil dan Lingkungan/FTT', 'lini' => 'Gugus Disiplin Asrama', 'role' => 'anggota'],
            ['name' => 'Timoti Sesario Sinaga', 'email' => 'timotisesario@apps.ipb.ac.id', 'nim' => 'G4401231100', 'gedung' => 'SED1', 'kamar' => '1', 'lorong' => '1', 'angkatan' => '60', 'kontak' => '62895332832621', 'departemen' => 'Kimia/FMIPA', 'lini' => 'Pengembangan Sumber Daya Manusia', 'role' => 'anggota'],
            ['name' => 'Tresna Wangina Putra Galuh', 'email' => 'teluriumgaluh@apps.ipb.ac.id', 'nim' => 'G4401231033', 'gedung' => 'SED1', 'kamar' => '1', 'lorong' => 'Wakil Komandan', 'angkatan' => '60', 'kontak' => '6281910602005', 'departemen' => 'Kimia/FMIPA', 'lini' => 'Wakil Komandan/Badan Pengurus Harian', 'role' => 'anggota'],
            ['name' => 'Valencia Sastra W', 'email' => 'valenciasastra@apps.ipb.ac.id', 'nim' => 'H3401241040', 'gedung' => 'A3', 'kamar' => '297', 'lorong' => '2 & 3', 'angkatan' => '61', 'kontak' => '628889723625', 'departemen' => 'Agribisnis/FEM', 'lini' => 'Media Branding', 'role' => 'anggota'],
            ['name' => 'Yafits Mubarak', 'email' => 'kodegenom7yafits@apps.ipb.ac.id', 'nim' => 'G0401241001', 'gedung' => 'C1', 'kamar' => '20', 'lorong' => '3', 'angkatan' => '61', 'kontak' => '6285371192950', 'departemen' => 'Bioinformatika/FMIPA', 'lini' => 'Pengembangan Sumber Daya Manusia', 'role' => 'pj_gedung'],
            ['name' => 'Zahra Maulida Sihaloho', 'email' => 'zahramaulidasihaloho@apps.ipb.ac.id', 'nim' => 'G8401241065', 'gedung' => 'A4', 'kamar' => '401', 'lorong' => '4A & 4B', 'angkatan' => '61', 'kontak' => '6282117497250', 'departemen' => 'Biokimia/FMIPA', 'lini' => 'Club', 'role' => 'anggota'],
            ['name' => 'Zaky Aryo Wibowo', 'email' => 'aryowibowozaky@apps.ipb.ac.id', 'nim' => 'F3401241011', 'gedung' => 'SED1', 'kamar' => '39', 'lorong' => '2A', 'angkatan' => '61', 'kontak' => '6288290713792', 'departemen' => 'Teknologi Industri Pertanian/FTT', 'lini' => 'Manajemen Program', 'role' => 'anggota'],
        ];

        // 3. Konversi array ke format batch dengan hashing NIM ringan (rounds => 4)
        $batchData = [];
        foreach ($users as $user) {
            $batchData[] = [
                'name'       => $user['name'],
                'email'      => $user['email'],
                'nim'        => $user['nim'],
                'gedung'     => $user['gedung'],
                'kamar'      => $user['kamar'],
                'lorong'     => $user['lorong'],
                'angkatan'   => $user['angkatan'],
                'kontak'     => $user['kontak'],
                'departemen' => $user['departemen'],
                'lini'       => $user['lini'],
                'role'       => $user['role'],
                // Hashing NIM dengan cost ringan khusus seeder
                'password'   => Hash::make($user['nim'], ['rounds' => 4]),
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        // 4. Masukkan seluruh data sekaligus dalam 1 query tunggal
        User::upsert(
            $batchData,
            ['email'], // Kolom unik acuan
            ['name', 'nim', 'gedung', 'kamar', 'lorong', 'angkatan', 'kontak', 'departemen', 'lini', 'role', 'password', 'updated_at']
        );
    }
}