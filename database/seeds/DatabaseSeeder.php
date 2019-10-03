<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'role' => 'user',
            'email' => 'sergeikurbako@gmail.com',
            'password' => '$2y$10$RwbcmWFvi35Rn66h612m9uISBLqbj689SArslVGpSfiblaLj2r3vC',
            'status' => 'on',
            'balance' => 100
        ]);

        DB::table('users')->insert([
            'role' => 'admin',
            'email' => 'avior@tut.by',
            'password' => '$2y$10$3qgao79cm53VdrtTke51buliYDCkFZU1OX/33rdJGGVXKrDtgEHBW',
            'status' => 'on'
        ]);

        DB::table('user_infos')->insert([
            'user_id' => 1,
            'first_name' => 'Петр',
            'second_name' => 'Темерязев',
            'patronymic_name' => 'Петрович',
            'gender' => 'man',
            'age' => 20,
            'work_place' => 'avior',
            'ip' => 12312312,
            'phone' => '+375291111111'
        ]);

        DB::table('user_infos')->insert([
            'user_id' => 2,
            'first_name' => 'Петр',
            'second_name' => 'Темерязев',
            'patronymic_name' => 'Петрович',
            'gender' => 'man',
            'age' => 20,
            'work_place' => 'avior',
            'ip' => 12312312,
            'phone' => '+375291111111'
        ]);

        DB::table('lids')->insert([
            'frame_id' => 1,
            'first_name' => 'Петр',
            'second_name' => 'Темерязев',
            'patronymic_name' => 'Петрович',
            'gender' => 'man',
            'age' => 20,
            'email' => 'sergeikurbako@tut.by',
            'work_place' => 'avior',
            'sms_code' => 12312312,
            'phone' => '+375291111111',
            'status' => 'on',
            'price' => 0
        ]);

        DB::table('game_frames')->insert([
            'user_id' => 1,
            'game_id' => 1,
            'game_rule_id' => 1,
            //'ip' => '93.84.119.243',
            'ip' => '127.0.0.1',
            'url' => 'http://localhost',
            'code' => '531523517',
            'price' => 0,
            'status' => 'on',
            'frame_status' => 'on'
        ]);

        DB::table('v2_games')->insert([
            'name' => 'uilson',
            'alias' => 'uilson',
            'type' => 'maze'
        ]);

        DB::table('v2_game_rules')->insert([
            'frame_id' => 1,
            'rules' => '{"stateData":{"botSpeed":64,"cellX":0,"cellY":0,"health":3,"time":34,"speed":500},"logicData":{"decreaseTime":5,"cameraWidth":18,"cameraHeight":18,"mazeWidth":24,"mazeHeight":24,"countOfSpeedBonus":5,"countOfHealthBonus":5,"countOfTimeBonus":5,"speedBonusValue":100,"healthBonusValue":1,"timeBonusValue":5}}'
        ]);

    }
}
