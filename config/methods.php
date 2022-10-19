<?php
return [
    'validate' => function ($request) {
        return $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'shug' => 'nullable|max:255'
        ]);
    },
];