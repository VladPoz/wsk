<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Category;
use App\Models\Poll;
use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->create([
            'name' => 'admin',
            'password' => Hash::make('toor'),
        ]);

        Category::query()->create([
            'name' => 'Привычки использования социальных сетей'
        ]);

        Poll::query()->create([
            'category_id' => 1,
            'title' => 'Как часто вы пользуетесь социальными сетями?',
            'description' => 'Этот опрос направлен на изучение предпочтений в использовании социальных сетей: частоты использования, целей и любимых платформ. Результаты помогут узнать, как современные пользователи взаимодействуют с социальными платформами.',
            'slug' => Str::random(8),
        ]);

        Question::query()->create([
            'poll_id' => 1,
            'type' => 'single',
            'question' => 'Как часто вы заходите в социальные сети?',
        ]);
        Question::query()->create([
            'poll_id' => 1,
            'type' => 'multiple',
            'question' => 'Для чего вы чаще всего используете социальные сети?',
        ]);
        Question::query()->create([
            'poll_id' => 1,
            'type' => 'multiple',
            'question' => 'Какие из социальных сетей вы используете?',
        ]);
        Question::query()->create([
            'poll_id' => 1,
            'type' => 'single',
            'question' => 'Сколько времени в день вы проводите в социальных сетях?',
        ]);
        Question::query()->create([
            'poll_id' => 1,
            'type' => 'single',
            'question' => 'Как вы относитесь к рекламе в социальных сетях?',
        ]);

        Answer::query()->create([
            'question_id' => 1,
            'answer' => 'Ежедневно',
        ]);
        Answer::query()->create([
            'question_id' => 1,
            'answer' => 'Несколько раз в неделю',
        ]);
        Answer::query()->create([
            'question_id' => 1,
            'answer' => 'Раз в неделю',
        ]);
        Answer::query()->create([
            'question_id' => 1,
            'answer' => 'Реже одного раза в неделю',
        ]);
        Answer::query()->create([
            'question_id' => 2,
            'answer' => 'Общение с друзьями и семьей',
        ]);
        Answer::query()->create([
            'question_id' => 2,
            'answer' => 'Чтение новостей',
        ]);
        Answer::query()->create([
            'question_id' => 2,
            'answer' => 'Развлечения',
        ]);
        Answer::query()->create([
            'question_id' => 2,
            'answer' => 'Работа и обучение',
        ]);
        Answer::query()->create([
            'question_id' => 3,
            'answer' => 'Instagram',
        ]);
        Answer::query()->create([
            'question_id' => 3,
            'answer' => 'Facebook',
        ]);
        Answer::query()->create([
            'question_id' => 3,
            'answer' => 'TikTok',
        ]);
        Answer::query()->create([
            'question_id' => 3,
            'answer' => 'Twitter',
        ]);
        Answer::query()->create([
            'question_id' => 4,
            'answer' => 'Менее 1 часа',
        ]);
        Answer::query()->create([
            'question_id' => 4,
            'answer' => '1-2 часа',
        ]);
        Answer::query()->create([
            'question_id' => 4,
            'answer' => '3-5 часов',
        ]);
        Answer::query()->create([
            'question_id' => 4,
            'answer' => 'Более 5 часов',
        ]);
        Answer::query()->create([
            'question_id' => 5,
            'answer' => 'Положительно',
        ]);
        Answer::query()->create([
            'question_id' => 5,
            'answer' => 'Нейтрально',
        ]);
        Answer::query()->create([
            'question_id' => 5,
            'answer' => 'Отрицательно',
        ]);
        Answer::query()->create([
            'question_id' => 5,
            'answer' => 'Не замечаю ее',
        ]);
    }
}
