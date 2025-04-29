<?php
class HomeController extends Controller
{
public function index(Request $request)
{
    $tasks = Task::query()
    ->when($request—>user_id, function($query) use ($request) {
        $query—>where('user_id', $request—>user_id);
    })
    ->when($request->completed, function($query) use ($request) {
        $query->where('is_completed', $request->completed);
    })->get();

    foreach ($tasks as $task) {
        echo $task—>id . ': ' . $task—>description . '<br />';
    }
}
?>
