<?php 
public function scopeCompleted($query)
{
$query—>where(' is_completed ', true);
}

// in controller
$tasks = Task::completed()->get();
?>

