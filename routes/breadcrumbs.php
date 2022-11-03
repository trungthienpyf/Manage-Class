<?php

// Home
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::for('course', function ($trail) {
    $trail->push('Chương trình học', route('student'));
});
Breadcrumbs::for('calendarStudent', function ($trail) {
    $trail->push('Lịch học', route('viewCalendar'));
});
Breadcrumbs::for('calendarTeacher', function ($trail) {
    $trail->push('Lịch dạy', route('teacher.schedule'));
});
Breadcrumbs::for('attendance', function ($trail) {
    $trail->push('Điểm danh', route('teacher.attendance'));
});
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Trang chủ', route('student'));
});
Breadcrumbs::for('classStudent', function ($trail) {
    $trail->push('Lớp học', route('classStudent'));
});
Breadcrumbs::for('classTeacher', function ($trail) {
    $trail->push('Lớp dạy', route('teacher.classTeacher'));
});
Breadcrumbs::for('classAdmin', function ($trail) {
    $trail->push('Lớp Học', route('admin.class.index'));
});
Breadcrumbs::for('classCreate', function ($trail) {
    $trail->parent('classAdmin');
    $trail->push('Thêm lớp', route('admin.class.create'));
});
Breadcrumbs::for('progress', function ($trail) {
    $trail->parent('course');
    $trail->push('Đăng ký', route('student'));
});
Breadcrumbs::for('thank', function ($trail) {
    $trail->parent('course');
    $trail->push('Cảm ơn', route('student'));
});

Breadcrumbs::for('about', function ($trail) {
    $trail->parent('home');
    $trail->push('About', route('admin'));
});
// Home > Blog
Breadcrumbs::for('calendar', function ($trail) {
    $trail->parent('home');
    $trail->push('calendar', route('admin'));
});

// Home > Blog > [Category]
Breadcrumbs::for('category', function ($trail, $category) {
    $trail->parent('blog');
    $trail->push($category->title, route('category', $category->id));
});

// Home > Blog > [Category] > [Post]
Breadcrumbs::for('post', function ($trail, $post) {
    $trail->parent('category', $post->category);
    $trail->push($post->title, route('post', $post->id));
});
