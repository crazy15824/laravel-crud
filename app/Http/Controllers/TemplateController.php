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

class TemplateController extends Controller
{
/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templates = Template::latest()->paginate();
        $numberofswipes = Swipe::latest()
                ->select('id', Swipe::raw('count(*) as total'))
                ->groupBy('id')
                ->get();
        $numberoftemplates = Template::latest()
                ->select('id', Template::raw('count(*) as total'))
                ->groupBy('id')
                ->get();   
        $numberoffields = Swipe::latest()
                ->select('id', Swipe::raw('count(*) as total'))
                ->groupBy('id')
                ->get();    
        if(Auth::check()){
            return view('templates.index', compact('templates'))
            ->with('i');
            
        }
        return redirect("login", compact('templates', 'numberofswipes', 'numberoftemplates', 'numberoffields'))->withSuccess('You are not allowed to access');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $templates = Template::latest();
        $numberofswipes = Swipe::latest()
                ->select('id', Swipe::raw('count(*) as total'))
                ->groupBy('id')
                ->get();
        $numberoftemplates = Template::latest()
                ->select('id', Template::raw('count(*) as total'))
                ->groupBy('id')
                ->get();   
        $numberoffields = Swipe::latest()
                ->select('id', Swipe::raw('count(*) as total'))
                ->groupBy('id')
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
            'name' => 'required',
            'description' => 'required',
            'fields' => 'required',
            'campaigns' => 'required'
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
            'name' => 'required',
            'description' => 'required',
            'fields' => 'required',
            'campaigns' => 'required'
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
