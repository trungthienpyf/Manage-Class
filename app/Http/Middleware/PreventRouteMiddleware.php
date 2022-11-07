<?php

namespace App\Http\Middleware;

use App\Models\ClassSchedule;
use Closure;
use Illuminate\Http\Request;

class PreventRouteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $check=ClassSchedule::query()
            ->whereHas('students',function ($query){
                $query->where('student_id',auth()->user()->id);
            })->get(['id']);

        foreach ($check as $each){

            if($request->route()->parameter('progress')->id ==$each->id){
                return redirect()->route('student');
            }
        }

        return $next($request);
    }
}
