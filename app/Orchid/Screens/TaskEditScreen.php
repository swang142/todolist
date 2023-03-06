<?php

namespace App\Orchid\Screens;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class TaskEditScreen extends Screen
{
    /**
     * @var Task
     */
    public $task;

    public $exists= false;

    /**
     * Query data.
     *
     * @param Task $task
     *
     * @return array    
     */
    public function query(Task $task): array
    {
        $this->exists= $task -> exists;

        if($this -> exists){
            $this->name= 'Edit task';
        }
        return ['task' => $task];

    }

    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return $this->task->exists ? 'Edit task' : 'Creating a new task';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return "Blog tasks";
    }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('Create task')
                ->icon('plus')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove', ['task' => $this->task->id])
                ->canSee($this->exists),
        ];
    }

    /**
     * Views.
     *
     * @return Layout[]
     */
    public function layout(): array
    {
        return [
            Layout::rows([
                Input::make('task.name')
                    ->title('Name')
                    ->placeholder('Attractive but mysterious title')
                    ->help('Specify a short descriptive title for this task.'),

                TextArea::make('task.description')
                    ->title('Description')
                    ->rows(3)
                    ->maxlength(200)
                    ->placeholder('Brief description for preview'),

            ])
        ];
    }

    /**
     * @param Task    $task
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Task $task, Request $request)
    {
        $task->fill($request->get('task'))->save();

        Alert::info('You have successfully created a task.');

        return redirect()->route('platform.task');
    }

    /**
     * @param Task $task
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Task $task)
    {
        $task->delete();

        Alert::info('You have successfully deleted the task.');

        return redirect()->route('platform.task');
    }
}
