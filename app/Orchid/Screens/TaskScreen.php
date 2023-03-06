<?php

namespace App\Orchid\Screens;
use App\Models\Task;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\ModalToggle;  
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
class TaskScreen extends Screen
{
    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return 'Simple To-Do List Application';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return 'Stanley Wang';
    }
        
  /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Create new')-> icon('plus')-> route('platform.task.edit')
        ];
    }

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {

       
        return [
            'tasks' => Task::latest()->get(),
        ];
    }

 


               /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::table('tasks', [
                TD::make('Name')->render(function (Task $task) {
                    return link::make($task -> name) -> route('platform.task.edit', $task); 
                }),

                TD::make('Task Number')-> filter(TD::FILTER_TEXT) -> sort() ->render(function (Task $task) {
                    return $task->id; 
                }),

                TD::make('description') ->render(function (Task $task) { return $task->description;
                }),
                
                    
                TD::make('Edit')
                ->render(function (Task $task) {
                    return Link::make()-> icon('pencil')-> route('platform.task.edit');
                }),
                
            ]),


         
        ];
    }



    
}