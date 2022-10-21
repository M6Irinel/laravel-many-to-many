<?php
return [
    'validate' => function ($request) {
        return $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'slug' => 'nullable|max:255|unique:posts'
        ]);
    },
];