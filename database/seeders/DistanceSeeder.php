<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('distances')->insert([
            [
                "oripai" => "ES",
                "oricp" => "03110",
                "despai" => "ES",
                "descp" => "46024",
                "tramocp" => "ES03110ES46024",
                "dtpuerto" => "D",
                "orinom" => "03110 Alicante, Spain",
                "desnom" => "46024 Valencia, Spain",
                
                "distkmokay" => 188,
                "distm" => 176418,
                "distkm" => 177,
                "disttimesec" => 6396,
                "font" => "WSE",
                "state" => "OK",
                "datecalc" => "2023-03-14",
                "discharge" => "",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "oripai" => "ES",
                "oricp" => "46190",
                "despai" => "ES",
                "descp" => "08039",
                "tramocp" => "ES08039ES46190",
                "dtpuerto" => "D",
                "orinom" => "46190 Riba-roja de Túria, Valencia, Spain",
                "desnom" => "08039 Barcelona, Spain",
                
                "distkmokay" => 0,
                "distm" => 359580,
                "distkm" => 360,
                "disttimesec" => 13181,
                "font" => "WSE",
                "state" => "OK",
                "datecalc" => "2023-03-14",
                "discharge" => "",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "oripai" => "ES",
                "oricp" => "03660",
                "despai" => "ES",
                "descp" => "12100",
                "tramocp" => "ES03660ES12100",
                "dtpuerto" => "D",
                "orinom" => "03660 Novelda, Alicante, Spain",
                "desnom" => "12100 Castellón de la Plana, Castellón, Spain",
                
                "distkmokay" => 0,
                "distm" => 241995,
                "distkm" => 242,
                "disttimesec" => 8931,
                "font" => "WSE",
                "state" => "OK",
                "datecalc" => "2023-03-14",
                "discharge" => "",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "oripai" => "ES",
                "oricp" => "03600",
                "despai" => "ES",
                "descp" => "12100",
                "tramocp" => "ES03600ES12100",
                "dtpuerto" => "D",
                "orinom" => "03600 Elda, Alicante, Spain",
                "desnom" => "12100 Castellón de la Plana, Castellón, Spain",
                
                "distkmokay" => 0,
                "distm" => 231744,
                "distkm" => 232,
                "disttimesec" => 8971,
                "font" => "WSE",
                "state" => "OK",
                "datecalc" => "2023-03-14",
                "discharge" => "",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "oripai" => "ES",
                "oricp" => "12130",
                "despai" => "ES",
                "descp" => "46024",
                "tramocp" => "ES12130ES46024",
                "dtpuerto" => "D",
                "orinom" => "12130 Sant Joan de Moró, Castellón, Spain",
                "desnom" => "46024 Valencia, Spain",
                
                "distkmokay" => 106,
                "distm" => 86312,
                "distkm" => 87,
                "disttimesec" => 4191,
                "font" => "WSE",
                "state" => "OK",
                "datecalc" => "2023-03-21",
                "discharge" => "",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "oripai" => "ES",
                "oricp" => "28918",
                "despai" => "ES",
                "descp" => "46024",
                "tramocp" => "ES28918ES46024",
                "dtpuerto" => "D",
                "orinom" => "28918 Leganés, Madrid, Spain",
                "desnom" => "46024 Valencia, Spain",
                
                "distkmokay" => 373,
                "distm" => 372341,
                "distkm" => 373,
                "disttimesec" => 12971,
                "font" => "WSE",
                "state" => "OK",
                "datecalc" => "2023-03-22",
                "discharge" => "",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "oripai" => "ES",
                "oricp" => "28918",
                "despai" => "ES",
                "descp" => "08039",
                "tramocp" => "ES08039ES28918",
                "dtpuerto" => "D",
                "orinom" => "28918 Leganés, Madrid, Spain",
                "desnom" => "08039 Barcelona, Spain",
               
                "distkmokay" => 0,
                "distm" => 634454,
                "distkm" => 635,
                "disttimesec" => 22193,
                "font" => "WSE",
                "state" => "OK",
                "datecalc" => "2023-03-22",
                "discharge" => "",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "oripai" => "ES",
                "oricp" => "46970",
                "despai" => "ES",
                "descp" => "46024",
                "tramocp" => "ES46024ES46970",
                "dtpuerto" => "D",
                "orinom" => "46970 Alaquàs, Valencia, Spain",
                "desnom" => "46024 Valencia, Spain",
                
                "distkmokay" => 15,
                "distm" => 19223,
                "distkm" => 20,
                "disttimesec" => 1163,
                "font" => "WSE",
                "state" => "OK",
                "datecalc" => "2023-03-23",
                "discharge" => "",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "oripai" => "ES",
                "oricp" => "46011",
                "despai" => "ES",
                "descp" => "46024",
                "tramocp" => "ES46011ES46024",
                "dtpuerto" => "D",
                "orinom" => "46011 Valencia, Spain",
                "desnom" => "46024 Valencia, Spain",
               
                "distkmokay" => 0,
                "distm" => 3482,
                "distkm" => 4,
                "disttimesec" => 651,
                "font" => "WSE",
                "state" => "OK",
                "datecalc" => "2023-03-27",
                "discharge" => "",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "oripai" => "ES",
                "oricp" => "46134",
                "despai" => "ES",
                "descp" => "46024",
                "tramocp" => "ES46024ES46134",
                "dtpuerto" => "D",
                "orinom" => "46134 Foios, Valencia, Spain",
                "desnom" => "46024 Valencia, Spain",
                
                "distkmokay" => 50,
                "distm" => 17445,
                "distkm" => 18,
                "disttimesec" => 1978,
                "font" => "WSE",
                "state" => "OK",
                "datecalc" => "2023-03-27",
                "discharge" => "",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "oripai" => "ES",
                "oricp" => "46501",
                "despai" => "ES",
                "descp" => "46024",
                "tramocp" => "ES46024ES46501",
                "dtpuerto" => "D",
                "orinom" => "46501 Petrés, Valencia, Spain",
                "desnom" => "46024 Valencia, Spain",
                "distkmokay" => 54,
                "distm" => 34430,
                "distkm" => 35,
                "disttimesec" => 2277,
                "font" => "WSE",
                "state" => "OK",
                "datecalc" => "2023-03-28",
                "discharge" => "",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "oripai" => "ES",
                "oricp" => "11201",
                "despai" => "ES",
                "descp" => "46512",
                "tramocp" => "ES11201ES46512",
                "dtpuerto" => "O",
                "orinom" => "11201 Algeciras, Cádiz, Spain",
                "desnom" => "46512 Faura, Valencia, Spain",
                "distkmokay" => 0,
                "distm" => 795636,
                "distkm" => 796,
                "disttimesec" => 27967,
                "font" => "WSE",
                "state" => "OK",
                "datecalc" => "2023-03-29",
                "discharge" => "",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "oripai" => "ES",
                "oricp" => "46512",
                "despai" => "ES",
                "descp" => "46024",
                "tramocp" => "ES46024ES46512",
                "dtpuerto" => "D",
                "orinom" => "46512 Faura, Valencia, Spain",
                "desnom" => "46024 Valencia, Spain",
                "distkmokay" => 53,
                "distm" => 38980,
                "distkm" => 39,
                "disttimesec" => 2401,
                "font" => "WSE",
                "state" => "OK",
                "datecalc" => "2023-03-29",
                "discharge" => "",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "oripai" => "ES",
                "oricp" => "12590",
                "despai" => "ES",
                "descp" => "46024",
                "tramocp" => "ES12590ES46024",
                "dtpuerto" => "D",
                "orinom" => "12590 Almenara, Castellón, Castellón, Spain",
                "desnom" => "46024 Valencia, Spain",
                "distkmokay" => 57,
                "distm" => 41989,
                "distkm" => 42,
                "disttimesec" => 2518,
                "font" => "WSE",
                "state" => "OK",
                "datecalc" => "2023-03-29",
                "discharge" => "",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "oripai" => "ES",
                "oricp" => "46024",
                "despai" => "ES",
                "descp" => "30500",
                "tramocp" => "ES30500ES46024",
                "dtpuerto" => "O",
                "orinom" => "46024 Valencia, Spain",
                "desnom" => "30500 Molina de Segura, Murcia, Spain",
                "distkmokay" => 240,
                "distm" => 210852,
                "distkm" => 211,
                "disttimesec" => 8338,
                "font" => "WSE",
                "state" => "OK",
                "datecalc" => "2023-03-30",
                "discharge" => "",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "oripai" => "FR",
                "oricp" => "66000",
                "despai" => "ES",
                "descp" => "08039",
                "tramocp" => "ES08039FR66000",
                "dtpuerto" => "D",
                "orinom" => "METRO Perpignan, ZAC Saint-Charles, 550 Av. de Milan, 66000 Perpignan, France",
                "desnom" => "La Gavina, Pça. de Pau Vila, 1, 08039 Palau De Mar, Barcelona, Spain",
                "distkmokay" => 0,
                "distm" => 189992,
                "distkm" => 190,
                "disttimesec" => 7147,
                "font" => "WSE",
                "state" => "OK",
                "datecalc" => "2023-03-31",
                "discharge" => "",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "oripai" => "FR",
                "oricp" => "31120",
                "despai" => "ES",
                "descp" => "46024",
                "tramocp" => "FR31120ES46024",
                "dtpuerto" => "D",
                "orinom" => "31120 Roques, France",
                "desnom" => "46024 Valencia, Spain",
                "distkmokay" => 0,
                "distm" => 746473,
                "distkm" => 747,
                "disttimesec" => 26766,
                "font" => "WSE",
                "state" => "OK",
                "datecalc" => "2023-03-31",
                "discharge" => "",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "oripai" => "FR",
                "oricp" => "31000",
                "despai" => "ES",
                "descp" => "46024",
                "tramocp" => "FR31000ES46024",
                "dtpuerto" => "D",
                "orinom" => "31000 Toulouse, France",
                "desnom" => "46024 Valencia, Spain",
                "distkmokay" => 0,
                "distm" => 736758,
                "distkm" => 737,
                "disttimesec" => 26663,
                "font" => "WSE",
                "state" => "OK",
                "datecalc" => "2023-03-31",
                "discharge" => "",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "oripai" => "DE",
                "oricp" => "50400",
                "despai" => "ES",
                "descp" => "46024",
                "tramocp" => "ES46024DE50400",
                "dtpuerto" => "D",
                "orinom" => "Motoroel100, Milsper Str. 142, 58256 Ennepetal",
                "desnom" => "46024 Valencia, Spain",
                "distkmokay" => 0,
                "distm" => 1761419,
                "distkm" => 1762,
                "disttimesec" => 63975,
                "font" => "WSE",
                "state" => "OK",
                "datecalc" => "2023-04-03",
                "discharge" => "",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "oripai" => "IT",
                "oricp" => "10059",
                "despai" => "ES",
                "descp" => "46024",
                "tramocp" => "IT10059ES46024",
                "dtpuerto" => "D",
                "orinom" => "10059 Metropolitan City of Turin, Italy",
                "desnom" => "46024 Valencia, Spain",
                "distkmokay" => 0,
                "distm" => 1177310,
                "distkm" => 1178,
                "disttimesec" => 43502,
                "font" => "WSE",
                "state" => "OK",
                "datecalc" => "2023-04-03",
                "discharge" => "",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "oripai" => "IT",
                "oricp" => "10050",
                "despai" => "ES",
                "descp" => "46024",
                "tramocp" => "IT10050ES46024",
                "dtpuerto" => "D",
                "orinom" => "10050 Metropolitan City of Turin, Italy",
                "desnom" => "46024 Valencia, Spain",
                "distkmokay" => 0,
                "distm" => 1155555,
                "distkm" => 1156,
                "disttimesec" => 41654,
                "font" => "WSE",
                "state" => "OK",
                "datecalc" => "2023-04-03",
                "discharge" => "",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "oripai" => "FR",
                "oricp" => "66500",
                "despai" => "ES",
                "descp" => "46024",
                "tramocp" => "ES46024FR66500",
                "dtpuerto" => "D",
                "orinom" => "66500 Mosset, France",
                "desnom" => "46024 Valencia, Spain",
                "distkmokay" => 0,
                "distm" => 586481,
                "distkm" => 587,
                "disttimesec" => 23700,
                "font" => "WSE",
                "state" => "OK",
                "datecalc" => "2023-04-03",
                "discharge" => "",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "oripai" => "ES",
                "oricp" => "46024",
                "despai" => "ES",
                "descp" => "08008",
                "tramocp" => "ES08008ES46024",
                "dtpuerto" => "O",
                "orinom" => "46024 Valencia, Spain",
                "desnom" => "08008 Barcelona, Spain",
                "distkmokay" => 378,
                "distm" => 350368,
                "distkm" => 351,
                "disttimesec" => 13975,
                "font" => "WSE",
                "state" => "OK",
                "datecalc" => "2023-04-03",
                "discharge" => "",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "oripai" => "ES",
                "oricp" => "08039",
                "despai" => "ES",
                "descp" => "08008",
                "tramocp" => "ES08008ES08039",
                "dtpuerto" => "O",
                "orinom" => "08039 Barcelona, Spain",
                "desnom" => "08008 Barcelona, Spain",
                "distkmokay" => 0,
                "distm" => 6534,
                "distkm" => 7,
                "disttimesec" => 1336,
                "font" => "WSE",
                "state" => "OK",
                "datecalc" => "2023-04-03",
                "discharge" => "",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "oripai" => "ES",
                "oricp" => "46515",
                "despai" => "ES",
                "descp" => "36207",
                "tramocp" => "ES36207ES46515",
                "dtpuerto" => "D",
                "orinom" => "46515 Quart de les Valls, Valencia, Spain",
                "desnom" => "36207 Vigo, Pontevedra, Spain",
                "distkmokay" => 0,
                "distm" => 983308,
                "distkm" => 984,
                "disttimesec" => 33731,
                "font" => "WSE",
                "state" => "OK",
                "datecalc" => "2023-04-04",
                "discharge" => "",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "oripai" => 'PT',
                "oricp" => '4450-204',
                "despai" => 'ES',
                "descp" => '36400',
                "tramocp" => 'ES36400PT4450-204',
                "dtpuerto" => 'O',
                "orinom" => 'Tasquinha Porto de Leixões, R. Conde São Salvador 42, 4450-206 Matosinhos, Por',
                "desnom" => 'Carracido, 36400, Pontevedra, Spain',
                "distkmokay" => '0',
                "distm" => '140124',
                "distkm" => '141',
                "disttimesec" => '5272',
                "font" => 'WSE',
                "state" => 'OK',
                "datecalc" => '24/07/2023',
                "discharge" => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "oripai" => 'PT',
                "oricp" => '4450-204',
                "despai" => 'ES',
                "descp" => '06010',
                "tramocp" => 'ES06010PT4450-204 ',
                "dtpuerto" => 'O',
                "orinom" => 'Porto de Leixões, Matosinhos, Portugal',
                "desnom" => '08174 Sant Cugat del Vallès, Barcelona, Spain',
                "distkmokay" => '0',
                "distm" => '1056776',
                "distkm" => '1057',
                "disttimesec" => '38787',
                "font" => 'WSE',
                "state" => 'OK',
                "datecalc" => '16/01/2024',
                "discharge" => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "oripai" => 'PT',
                "oricp" => '4450-204',
                "despai" => 'ES',
                "descp" => '12600',
                "tramocp" => 'ES12600PT4450-204',
                "dtpuerto" => 'O',
                "orinom" => 'Leixoes Sport Club, R. Roberto Ivens 528, 4450-277 Matosinhos, Portugal',
                "desnom" => "la Vall d'Uixó, 12600, Castellón, Spain",
                "distkmokay" => '0',
                "distm" => '954362',
                "distkm" => '955',
                "disttimesec" => '33156',
                "font" => 'WSE',
                "state" => 'OK',
                "datecalc" => '07/09/2023',
                "discharge" => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "oripai" => 'PT',
                "oricp" => '4450-204',
                "despai" => 'ES',
                "descp" => '15310',
                "tramocp" => 'PTES15310',
                "dtpuerto" => 'O',
                "orinom" => 'Leixões, Portugal',
                "desnom" => 'Abeledo, 15310, A Coruña, Spain',
                "distkmokay" => '0',
                "distm" => '294417',
                "distkm" => '295',
                "disttimesec" => '11115',
                "font" => 'WSE',
                "state" => 'OK',
                "datecalc" => '14/11/2023',
                "discharge" => '',
                'created_at' => now(),
                'updated_at' => now()
            ],

        ]);
    }
}
