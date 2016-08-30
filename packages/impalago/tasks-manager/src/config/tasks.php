<?php

return [

    'extend_view' => 'layouts.main',

    'priority_task' => ['Обычный', 'Низкий', 'Средний', 'Высокий'],

    'upload_path' => storage_path() . '/app/upload/tasks',

    'status_task' => ['Новая', 'В работе', 'Приостановлена', 'Завершена'],

];