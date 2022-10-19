<?php
return [
    'validate' => function ($request) {
        return $request->validate([
            'title' => 'required|max:255|min:5',
            'description' => 'required|min:5',
            'shug' => 'max:255'
        ]);
    },
];