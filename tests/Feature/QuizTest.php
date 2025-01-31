<?php

namespace Tests\Feature;

use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class QuizTest extends TestCase
{
    /**
     * A basic feature test example.
     */
public function test_user_can_submit_quiz()
{
    $user = User::factory()->create();
    $quiz = Quiz::factory()->create();
    $question = Question::factory()->create(['quiz_id' => $quiz->id, 'type' => 'multiple_choice']);
    $option = QuestionOption::factory()->create(['question_id' => $question->id, 'is_correct' => true]);

    $response = $this->actingAs($user)->postJson("/quiz/{$quiz->id}/submit", [
        'answers' => [
            $question->id => $option->id
        ]
    ]);

    $response->assertStatus(200);
    $this->assertDatabaseHas('results', [
        'user_id' => $user->id,
        'quiz_id' => $quiz->id,
    ]);
}
}
