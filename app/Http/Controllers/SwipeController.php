<?php

namespace App\Http\Controllers;

use App\Models\Template;
use App\Models\Campaign;
use App\Models\Field;
use App\Models\Lnk_Camp_Templ;
use App\Models\Lnk_Templ_Field;
use App\Models\Swipe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;


class SwipeController extends Controller
{
    /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $templates = Template::latest()->paginate(5);
            $groupprojects = Template::latest()
                    ->select('fields', Template::raw('count(*) as total'))
                    ->groupBy('fields')
                    ->get();
            if(Auth::check()){
                return view('templates.index', compact('templates'))
                ->with('i', (request()->input('page', 1) - 1) * 5);
                
            }
            return redirect("login", compact('templates', 'groupprojects'))->withSuccess('You are not allowed to access');
            
        }
    
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            $templates = Template::latest();
            $groupprojects = Template::latest()
                    ->select('fields', Template::raw('count(*) as total'))
                    ->groupBy('fields')
                    ->get();
            if(Auth::check()){
                return view('templates.create');
               
            }
      
            return redirect("login", compact('templates', 'groupprojects'))->withSuccess('You are not allowed to access');
        }
    
        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
            $request->validate([
                'template_name' => 'required',
                'description' => 'required',
                'fields' => 'required',
            ]);
    
            Template::create($request->all());
    
            return redirect()->route('templates.index')
                ->with('success', 'Project created successfully.');
        }
    
        /**
         * Display the specified resource.
         *
         * @param  \App\Models\Project  $project
         * @return \Illuminate\Http\Response
         */
        public function show(Template $template)
        {
            return view('templates.show', compact('template'));
        }
    
        /**
         * Show the form for editing the specified resource.
         *
         * @param  \App\Models\Project  $project
         * @return \Illuminate\Http\Response
         */
        public function edit(Template $template)
        {
            return view('templates.edit', compact('template'));
        }
        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \App\Models\Project  $project
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, Template $template)
        {
            $request->validate([
                'template_name' => 'required',
                'description' => 'required',
                'fields' => 'required',
            ]);
            $template->update($request->all());
    
            return redirect()->route('templates.index')
                ->with('success', 'Project updated successfully');
        }
        /**
         * Remove the specified resource from storage.
         *
         * @param  \App\Models\Project  $project
         * @return \Illuminate\Http\Response
         */
        public function destroy(Template $template)
        {
            $template->delete();
    
            return redirect()->route('templates.index')
                ->with('success', 'Project deleted successfully');
        }
    }
