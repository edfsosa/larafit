<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\Review;
use App\Models\Routine;
use App\Models\Trainer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = Member::all();
        $trainers = Trainer::all();
        $routines = Routine::all();

        $reviews = [
            [
                'routine_id' => $routines->first()->id,
                'reviewer_id' => $members->first()->user_id,
                'reviewed_id' => $trainers->first()->user_id,
                'rating' => 5,
                'comment' => 'Excelente rutina, muy efectiva!',
            ],
            [
                'routine_id' => $routines->last()->id,
                'reviewer_id' => $members->last()->user_id,
                'reviewed_id' => $trainers->last()->user_id,
                'rating' => 4,
                'comment' => 'Buena rutina, pero podría ser más desafiante.',
            ],
            [
                'routine_id' => $routines->first()->id,
                'reviewer_id' => $members->last()->user_id,
                'reviewed_id' => $trainers->first()->user_id,
                'rating' => 3,
                'comment' => 'La rutina estuvo bien, pero no cumplió todas mis expectativas.',
            ],
        ];

        foreach ($reviews as $review) {
            Review::create($review);
        }
    }
}
