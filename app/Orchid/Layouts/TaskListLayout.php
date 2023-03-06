<?php

namespace App\Orchid\Layouts;

use App\Models\Task;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;

class TaskListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    public $target = 'tasks';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('title', 'Title')
                ->render(function (Task $task) {
                    return Link::make($task->title)
                        ->route('platform.task.edit', $task);
                }),

        ];
    }
}
